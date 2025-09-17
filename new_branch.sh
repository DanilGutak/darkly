#!/bin/bash

if [ ! -n "$1" ]; then
    echo "Breache name is not provided"
    exit 1
fi

mkdir -p $1
mkdir -p $1/Resources
echo "<put your flag here>" > $1/flag
echo "### $1" > $1/Resources/README.md
