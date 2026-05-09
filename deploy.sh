#!/bin/bash
set -e   # opreste imediat daca o comanda esueaza
cd ~/domains/clickmusic.ro/public_html

# Curata asseturile Filament publicate orfane care ar bloca pull-ul.
# Limitat strict la directoarele de assets — nu atinge altceva.
git clean -fd \
  public/js/filament \
  public/css/filament \
  public/fonts/filament \
  public/vendor/filament 2>/dev/null || true

git pull origin main

/opt/alt/php84/usr/bin/php composer.phar install --no-dev --optimize-autoloader
/opt/alt/php84/usr/bin/php artisan migrate --force
/opt/alt/php84/usr/bin/php artisan config:cache
/opt/alt/php84/usr/bin/php artisan route:cache
/opt/alt/php84/usr/bin/php artisan view:cache
