#!/bin/bash

# Usage: ./duplicate-module.sh OldName NewName

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

# Step 1: Copy the directory
cp -r "$SRC_DIR" "$DST_DIR"

# Step 2: Replace all content inside files
echo "🔄 Replacing contents in files..."
find "$DST_DIR" -type f -exec sed -i \
    -e "s/$OLD_NAME/$NEW_NAME/g" \
    -e "s/$OLD_LOWER/$NEW_LOWER/g" \
    {} +

# Step 3: Rename all files and folders recursively
echo "🔄 Renaming files and folders..."
find "$DST_DIR" -depth -name "*$OLD_NAME*" | while read path; do
    new_path=$(echo "$path" | sed "s/$OLD_NAME/$NEW_NAME/g")
    mv "$path" "$new_path"
done

find "$DST_DIR" -depth -name "*$OLD_LOWER*" | while read path; do
    new_path=$(echo "$path" | sed "s/$OLD_LOWER/$NEW_LOWER/g")
    mv "$path" "$new_path"
done

echo "✅ Module duplicated successfully at: $DST_DIR"