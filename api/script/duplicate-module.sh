#!/bin/bash

# Usage: ./duplicate-module.sh User Societe

OLD_NAME=$1
NEW_NAME=$2

if [ -z "$OLD_NAME" ] || [ -z "$NEW_NAME" ]; then
    echo "❌ Usage: ./duplicate-module.sh OldName NewName"
    exit 1
fi

OLD_LOWER=$(echo "$OLD_NAME" | awk '{print tolower($0)}')
NEW_LOWER=$(echo "$NEW_NAME" | awk '{print tolower($0)}')

SRC_DIR="src/Module/$OLD_NAME"
DST_DIR="src/Module/$NEW_NAME"

if [ ! -d "$SRC_DIR" ]; then
    echo "❌ Directory $SRC_DIR does not exist"
    exit 1
fi

echo "✅ Duplicating $OLD_NAME → $NEW_NAME..."

# Step 1: Copy directory
cp -r "$SRC_DIR" "$DST_DIR"

# Step 2: Replace content inside files
find "$DST_DIR" -type f -exec sed -i \
    -e "s/\b$OLD_NAME\b/$NEW_NAME/g" \
    -e "s/\b$OLD_LOWER\b/$NEW_LOWER/g" \
    -e "s/${OLD_NAME}/${NEW_NAME}/g" \
    -e "s/${OLD_LOWER}/${NEW_LOWER}/g" \
    {} +

# Step 3: Rename files that contain the old name
find "$DST_DIR" -depth -name "*$OLD_NAME*" | while read file; do
    newfile=$(echo "$file" | sed "s/$OLD_NAME/$NEW_NAME/g")
    mv "$file" "$newfile"
done

echo "✅ Module duplicated: $DST_DIR"