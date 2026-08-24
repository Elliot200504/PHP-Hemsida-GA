### DOKUMENTATION GYMMNASIEARBETE

## Lektion 1

Här börjar jag med grunderna för att lära mig php, tittade på guider om hur man strukturerar php kod och vanlig databas användning. 

Tänkte på olika databaser jag kunde använt, fick tips utav fredric att mySQL hade kunnat vara något litet att jobba med eftersom php var redan ganska invecklat.

Hittade att replit använder sig av sin egna SQLlite och tänkte att det kunde passa som något litet att hjälpa mig. 


### index.php
````php
<?php
// Filnamn för databasfilen
$databaseFile = 'databas.db';

// Skapar en SQLite-anslutning
$conn = new SQLite3($databaseFile);
?>

<?php
// Inkluderar filer som skapar tabellen och lägger till data
require_once 'user_tabell.php';
require_once 'insert_users.php';

// Hämtar alla användare från tabellen
$query = "SELECT * FROM users";
$result = $conn->query($query);
?>

````

## Lektion 2

Denna dag började jag tänka på vad min sida ska göra, komm inte på mycket så tänkte börja med att göra att man kunde regristrera sig och se användare som är regristrerade.

### Skapar user_tabell.php
````php
<?php
$databaseFile = 'SQL/databas.db';
// Kontakta databasen
$conn = new SQLite3($databaseFile);

// $_SERVER kollar om formuläret skickar
// Skickas till $_POST som checkar ifall det är register eller login. Samt funkar den som req.body och gör det till de olika delarna av user

        // Registrering
        $username = "Elliot";
        $email = "Elliot.astrand@hotmail.com";
        $password = password_hash('lösernod'), PASSWORD_DEFAULT);

        // SQL-fråga för att lägga till en användare i tabellen
        // INSERT INTO skickar in data i databasen till (platser)
       // VALUES = Det som ska skickas in
        $query = "INSERT INTO users (username, user_email, user_password)
        VALUES ('$username', '$email', '$password')";

      // Kör all user information in i databasen
      $conn->exec($query);

    }
     //Fixa inloggning men först skapa regristrering
}

?>

````


### Skapar insert_users.php
````php

<?php
$databaseFile = 'SQL/databas.db';
$conn = new SQLite3($databaseFile);

// SQL-förfrågan att skapa en tabell
// IF NOT EXISTS: Stoppar skapandet ifall det redan finns
// ID: Skapar ett slumpmässigt unikt nummer för varje användare
// TEXT: Formaterar till text sträng

$query = "CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT,
    user_email TEXT,
    user_password TEXT,
    user_auth TEXT
)";

// SQL-Förfråggan för att skapa listan i Index
$conn->exec($query);

````
###  tillägg i index.php
````php

<html>
<head>
    <title>PHP Test</title>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
</head>
<body>

<h1>List of users:</h1>

<?php
// Loopar igenom resultatet och skriver ut användarinformation
while ($row = $result->fetchArray()) {
    echo "<p>User ID: {$row['id']}</p>";
    echo "<p>Username: {$row['username']}</p>";
    echo "<p>Email: {$row['user_email']}</p>";
    echo "<hr>";
}
?>

// 

</body>
</html>



````

## Lektion 3/4

Här börjar idéer om vad jag ska skapa komma fram. Bestämmer mig för att göra en hemsida där personer kan regristrera sig och logga in, sedan skapa en profil. Man ska sedan kunna komma åt andras profiler och både kommentera och gilla andras profiler. Kanske skapar att man kan lägga ut saker också

I koden börjar man se ändringar där denna iden skapas.

### index.php
```php
<?php
session_start();
// Filnamn för databasfilen
$databaseFile = 'SQL/databas.db';
// Skapar en SQLite-anslutning
$conn = new SQLite3($databaseFile);
// Inkluderar filer som skapar tabellen och lägger till data
require_once 'users/user_tabell.php';
require_once 'users/insert_users.php';
require_once 'action/delete.php';

// Hämtar alla användare från tabellen
  // users skapas i user_tabell
  // samt skapas $result vilket är en array med användarinfon.

$query = "SELECT * FROM users";
$result = $conn->query($query);

  // Ska fixa när man loggar ut stängs data basen ner
  // $conn->close();  

include("views/start.php");



if($_SERVER['REQUEST_URI'] == "/Login") {
    include("views/login_form.html");
}
if($_SERVER['REQUEST_URI'] == "/Register") {
    include("views/registration_form.html");
}
if($_SERVER['REQUEST_URI'] == "/viewprofile") {
    include("views/profile.html");
}




  if($_SERVER['REQUEST_URI'] == "/Users") {
      echo 

        '
        <h1 class="userlist">Lista över användare:</h1>

      <div class="lista">';
      while ($row = $result->fetchArray()) {
          echo "<p>Användar-ID: {$row['id']}</p>";
          echo "<p>Användarnamn: {$row['username']}</p>";
          echo "<p>E-post: {$row['user_email']}</p>";
          echo "<p>Authentication: {$row['user_auth']}</p>";
          echo "  <a href='/viewprofile'>View profile</a> - <a href='/action/delete.php?id={$row['id']}'>Delete</a>";
          echo "<hr>";
      }
      echo '</div>';
  }






?>

```

Har nu skapat en delete.php där man kan tabort användare baserat på deras "id"

### STORA ÄNDRINGAR:

Här slutar min dokumentation om hur jag påbörjat mitt projekt och nu börjar jag dokumentera stora förändringar.

### Router-php (rekommenderat av fredric)


Denna kod är gjord för att kunna enkelt använda sig av routes, GET och POST. Istället för att använda mig utav ($_SERVER['REQUEST_METHOD'] för att göra en route. Router php är ett typ av routing biblotek som använder sig utav ($_SERVER['REQUEST_METHOD'] att hjälpa dig enkelt använda "GET" och "POST" Som i node.js. 

Så istället för att skriva: 
```php
<?php
if($_SERVER['REQUEST_URI'] == "/Login") {
    include("views/login_form.html");
}
?>
```
Kan jag istället skriva:
```php
<?php
get('/Login', function(){
    include("views/login_form.html");    
});

post('/Login', "Auth::Login");
?>
```
Koden blir mer likt koden i node.js samt mer lässbart och enklare att integrera funktioner och min nya views.

### Klasser
---

## Avslut

Avslutar min dokumentation här med fokus i att klara av min matte-kurs.
