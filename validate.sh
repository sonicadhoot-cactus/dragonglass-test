#!/bin/bash

reset=$(tput sgr0)

red=$(tput setaf 1)
green=$(tput setaf 76)
tan=$(tput setaf 3)

export module="$1"
export env_name=$(basename $(dirname "$PWD"))

validate() {
    if validateEnvFile; then
        verifyEnvName
        echo $(validateAppPrefix)
        echo $(validateSitePrefix)
    fi
}
validateEnvFile() {
    if [[ -f "$PWD/$module"/.env ]]; then
        env_data = "$PWD/$module"/.env | tr -d "[:blank:]"
        source "$PWD/$module"/.env
        true
    else
        error "env file does not exist in $module"
        false
    fi
}
validateAppPrefix() {
    if [[ -z "${APP_PREFIX}" ]]; then
        error "APP_PREFIX not found"
        info "Adding APP_PREFIX..." $(addPrefix "APP_PREFIX=$env_name")
        success "APP_PREIFX added"
    elif [[ "$APP_PREFIX" != "$env_name" ]]; then
        info "Updating APP_PREFIX..." $(updatePrefix "APP_PREFIX" "$env_name")
        success "APP_PREFIX updated"
    else
        success "APP_PREFIX is $APP_PREFIX"
    fi
}
validateSitePrefix() {
    if [[ -z "${SITE_PREFIX}" ]]; then
        error "SITE_PREFIX not found"
        info "Adding SITE_PREFIX" $(addPrefix "APP_PREFIX=$env_name")
        success "SITE_PREIFX added"
    elif [[ "$SITE_PREFIX" != "$env_name" ]]; then
        info "Updating SITE_PREFIX" $(updatePrefix "SITE_PREFIX" "$env_name")
        success "SITE_PREFIX updated"
    else
        success "SITE_PREFIX is $SITE_PREFIX"
    fi
}
addPrefix() {
    printf "\n$1" >> "$PWD/$module"/.env
}
updatePrefix() {
    sed -i "s/$1=.*/$1=$2/g" "$PWD/$module"/.env
}
verifyEnvName() {
    if [[ "$env_name" = "www" ]]; then
        env_name="local"
    fi
}
success() {
    printf "${green}✔ %s${reset}\n" "$@"
}
error() {
    printf "${red}✖ %s${reset}\n" "$@"
}
info() {
    printf "${tan}➜ %s${reset}\n" "$@"
}

validate