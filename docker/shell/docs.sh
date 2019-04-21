#!/bin/bash

## check composer dependencies are installed
if [ ! -d "$(pwd)/vendor" ]; then
    echo "Composer dependencies missing. Please run composer install."
    exit 0
fi

# if [[ $(composer show 2>&1) == *"No dependencies installed"* ]]; then
#     echo "Composer dependencies missing. Please run composer install."
#     exit 0
# fi

YAML_TARGETDIR=$(dirname "$SWAGGER_TARGET")  
if [ ! -d $YAML_TARGETDIR ]; then
    mkdir -p $YAML_TARGETDIR
    chmod 777 $YAML_TARGETDIR
fi

echo "Generating open api file..."
vendor/bin/openapi --output $SWAGGER_TARGET $SWAGGER_PATH