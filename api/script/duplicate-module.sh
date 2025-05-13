#!/bin/bash

# Usage: ./duplicate-module.sh OldName NewName [--dry-run|--force]

set -euo pipefail

# Colors
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
CYAN='\033[0;36m'
NC='\033[0m' # No Color

# Arguments
OLD_NAME=$1
NEW_NAME=$2
OPTION=${3:-""}

if [ -z "$OLD_NAME" ] || [ -z "$NEW_NAME" ]; then
    echo -e "${RED}❌ Usage: ./duplicate-module.sh OldName NewName [--dry-run|--force]${NC}"
    exit 1
fi

DRY_RUN=false
FORCE=false

if [ "$OPTION" == "--dry-run" ]; then
    DRY_RUN=true
elif [ "$OPTION" == "--force" ]; then
    FORCE=true
elif [ -n "$OPTION" ]; then
    echo -e "${RED}❌ Unknown option: $OPTION${NC}"
    exit 1
fi

# Naming conventions
OLD_LOWER=$(echo "$OLD_NAME" | awk '{print tolower($0)}')
NEW_LOWER=$(echo "$NEW_NAME" | awk '{print tolower($0)}')

OLD_SNAKE=$(echo "$OLD_NAME" | sed 's/\([A-Z]\)/_\L\1/g' | sed 's/^_//')
NEW_SNAKE=$(echo "$NEW_NAME" | sed 's/\([A-Z]\)/_\L\1/g' | sed 's/^_//')

OLD_KEBAB=$(echo "$OLD_SNAKE" | tr '_' '-')
NEW_KEBAB=$(echo "$NEW_SNAKE" | tr '_' '-')

SRC_DIR="src/Module/$OLD_NAME"
DST_DIR="src/Module/$NEW_NAME"

# Check source exists
if [ ! -d "$SRC_DIR" ]; then
    echo -e "${RED}❌ Source module '$SRC_DIR' does not exist.${NC}"
    exit 1
fi

# Handle destination
if [ -d "$DST_DIR" ]; then
    if [ "$FORCE" = false ]; then
        echo -e "${YELLOW}⚠️  Destination module '$DST_DIR' already exists.${NC}"
        read -p "❓ Do you want to overwrite it? (y/n): " confirm
        if [ "$confirm" != "y" ]; then
            echo -e "${RED}❌ Aborted.${NC}"
            exit 1
        fi
    fi
    echo -e "${CYAN}🗑️  Removing existing destination...${NC}"
    rm -rf "$DST_DIR"
fi

echo -e "${GREEN}🚀 Duplicating $OLD_NAME → $NEW_NAME...${NC}"

# Step 1: Copy directory
cp -r "$SRC_DIR" "$DST_DIR"

# Step 2: Replace content
echo -e "${CYAN}🔄 Replacing content in files...${NC}"
REPLACEMENTS=(
    "$OLD_NAME:$NEW_NAME"
    "$OLD_LOWER:$NEW_LOWER"
    "$OLD_SNAKE:$NEW_SNAKE"
    "$OLD_KEBAB:$NEW_KEBAB"
)

for file in $(find "$DST_DIR" -type f); do
    for replacement in "${REPLACEMENTS[@]}"; do
        OLD_PART=$(echo "$replacement" | cut -d':' -f1)
        NEW_PART=$(echo "$replacement" | cut -d':' -f2)
        if [ "$DRY_RUN" = true ]; then
            grep -q "$OLD_PART" "$file" && echo "🔎 Would replace '$OLD_PART' → '$NEW_PART' in $file"
        else
            sed -i "s/$OLD_PART/$NEW_PART/g" "$file"
        fi
    done
done

# Step 3: Rename files/folders
echo -e "${CYAN}📝 Renaming files and folders...${NC}"
for pattern in "$OLD_NAME" "$OLD_LOWER" "$OLD_SNAKE" "$OLD_KEBAB"; do
    find "$DST_DIR" -depth -name "*$pattern*" | while read -r path; do
        new_path=$(echo "$path" | sed "s/$pattern/${pattern/$OLD_NAME/$NEW_NAME}/g")
        if [ "$DRY_RUN" = true ]; then
            echo "🔁 Would rename: $path → $new_path"
        else
            mv "$path" "$new_path"
        fi
    done
done

# Step 4: Optional cleanup
echo -e "${CYAN}🧼 Cleaning .gitkeep files...${NC}"
if [ "$DRY_RUN" = false ]; then
    find "$DST_DIR" -type f -name ".gitkeep" -delete
fi

# Step 5: Validate PHP namespace
if grep -qr "namespace App\\Module\\$OLD_NAME" "$DST_DIR"; then
    if grep -qr "namespace App\\Module\\$NEW_NAME" "$DST_DIR"; then
        echo -e "${GREEN}✅ Namespace App\\Module\\$NEW_NAME correctly set.${NC}"
    else
        echo -e "${YELLOW}⚠️  Warning: some namespaces may still reference $OLD_NAME.${NC}"
    fi
fi

# Step 6: Fix variable names to snake_case
echo -e "${CYAN}🧠 Fixing variable names to snake_case...${NC}"
find "$DST_DIR" -type f -name "*.php" | while read -r file; do
    echo -e "📄 Fichier en cours : $file"
    
    matches=$(grep -P "([a-zA-Z0-9_\\\\]+) +\\$[a-zA-Z_][a-zA-Z0-9_]*" "$file" | grep "$NEW_NAME" || true)

    if [ -z "$matches" ]; then
        continue
    fi

    while IFS= read -r line; do
        class_name=$(echo "$line" | grep -oP "$NEW_NAME[A-Za-zA-Z0-9_]*" || true)
        var_name=$(echo "$line" | grep -oP "\\$[a-zA-Z_][a-zA-Z0-9_]*" | head -n 1 || true)

        # Skip if variables are empty
        if [ -z "$class_name" ] || [ -z "$var_name" ]; then
            continue
        fi

        # Remove $ from variable name before conversion
        clean_var_name="${var_name:1}"

        snake_case_var=$(echo "$class_name" | sed -r 's/([A-Z])/_\L\1/g' | sed 's/^_//')
        echo "🔁 Remplace: $class_name $var_name → $class_name \$$snake_case_var"

        sed -i "s/$class_name $var_name/$class_name \$$snake_case_var/g" "$file"
    done <<< "$matches"
done

# Step 6b: Fix variables in camelCase (without type hint)
echo -e "${CYAN}🧠 Fixing untyped variable names to snake_case...${NC}"
find "$DST_DIR" -type f -name "*.php" | while read -r file; do
    grep -oP '\$[a-z]+[A-Z][a-zA-Z0-9_]*' "$file" | sort -u | while read -r var || [[ -n "$var" ]]; do
        if [ -n "$var" ]; then
            clean_var="${var:1}"
            snake_case=$(echo "$clean_var" | sed -r 's/([a-z])([A-Z])/\1_\L\2/g')

            if [ "$clean_var" != "$snake_case" ]; then
                echo "🐍 Converting: \$$clean_var → \$$snake_case in $file"
                sed -i "s/\$$clean_var/\$$snake_case/g" "$file"
            fi
        fi
    done
done

echo -e "${GREEN}✅ Module duplicated successfully at: $DST_DIR${NC}"