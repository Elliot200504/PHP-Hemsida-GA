# SOCIALSITE (Gymnasiearbete, PHP)

Litet socialt nätverk i PHP med SQLite: registrering, inloggning, profiler,
inlägg och kommentarer. Ursprungligen byggt på Replit, nu körbart lokalt.

## Krav

* PHP 8.x
* PHP-tillägget `sqlite3`

```sh
sudo apt install php-sqlite3     # Debian/Ubuntu
```

## Kör lokalt

```sh
./run.sh
```

...eller direkt:

```sh
php -S localhost:8000 -t . server.php
```

Öppna sedan <http://localhost:8000>.
