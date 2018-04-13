# Export product data from XLSX to JSON, YAML, YML files
# set colors in terminal
red=`tput setaf 1`
green=`tput setaf 2`
yellow=`tput setaf 3`
blue=`tput setaf 4`
magenta=`tput setaf 5`

reset=`tput sgr0`

clear
echo -e "${green}Exporting product data from ${yellow}products.xlsx${green} to JSON, YAML, YML files...${reset}"

cd "/Volumes/assets/My documents/works/me tryng to start working/интернет магазин/export products"

php -f export-all.php

cp -v products.json "/Users/therealman_/domains/avonang.dev/www/user/pages/01.home/02.tovary/products.json"
cp -v frontmatter.yaml "/Users/therealman_/domains/avonang.dev/www/user/pages/01.home/02.tovary/frontmatter.yaml"
cp -v products.yml "/Users/therealman_/domains/avonang.dev/www/user/pages/01.home/02.tovary/products.yml"
cp -v products.yml "/Users/therealman_/domains/avonang.dev/www/products.yml"

zip -ruq export-all.zip *
cp -v export-all.zip "/Users/therealman_/domains/avonang.dev/www/user/pages/01.home/02.tovary/export-all.zip"