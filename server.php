<?php
// Router-script för PHP:s inbyggda webbserver.
// Startas med: php -S localhost:8000 server.php
//
// Alla rutter i index.php är "snygga" URL:er (/Login, /viewProfile/3 ...) och
// motsvarar inga filer på disk, så allt måste skickas till index.php.
// Riktiga filer (bilder, css) serveras direkt av servern.

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$file = __DIR__ . urldecode($path);

if ($path !== '/' && !preg_match('/\.php$/i', $path) && is_file($file)) {
    return false; // låt inbyggda servern serva filen
}

require __DIR__ . '/index.php';
