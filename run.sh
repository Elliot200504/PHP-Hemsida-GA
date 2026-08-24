#!/usr/bin/env sh
# Startar sidan lokalt på http://localhost:8000
set -e
cd "$(dirname "$0")"
php -m | grep -qi '^sqlite3$' || {
  echo "Saknar PHP-tillägget sqlite3. Installera med:"
  echo "  sudo apt install php-sqlite3"
  exit 1
}
exec php -S localhost:8000 -t . server.php
