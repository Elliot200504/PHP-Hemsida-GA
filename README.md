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

`server.php` är ett router-script för PHP:s inbyggda webbserver. Det behövs
eftersom alla rutter (`/Login`, `/viewProfile/3`, ...) hanteras av `index.php`
och inte motsvarar några filer på disk. Riktiga filer (bilder m.m.) serveras
som vanligt.

## Struktur

| Sökväg              | Innehåll                                              |
| ------------------- | ----------------------------------------------------- |
| `index.php`         | Alla rutter (front controller)                        |
| `router.php`        | Mini-router: `get()`, `post()`, `out()`               |
| `server.php`        | Router-script för `php -S`                            |
| `klasser/`          | `Sql`, `Auth`, `User`, `Post`, `Render`                |
| `users/user_tabell.php` | Skapar tabellerna `users` och `posts` vid start    |
| `views/`            | Sidmallar                                             |
| `SQL/databas.db`    | SQLite-databasen                                      |
| `bakgrundsbild/`    | Bakgrundsbilder                                       |
| `ga.md`             | Dokumentation av arbetet                              |

## Kända brister

Koden är ett skolarbete och ska inte köras publikt:

* SQL-injektion i `Auth::Login`, `Auth::Register`, `User::deleteUser`,
  `User::editProfilePicture` och `Post::getPostsByUserId` (variabler
  interpoleras rakt in i frågorna).
* Utdata escapas inte (`echo $post['title']` m.fl.) — XSS är möjligt.
* `Post::deletePost` kollar bara att man är inloggad, inte att inlägget
  tillhör en själv.
* CSRF-funktionerna i `router.php` används inte av formulären.
