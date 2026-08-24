<?php

require_once __DIR__ . '/../klasser/Sql.php';
  $conn = Sql::connect();

// SQL-förfrågan att skapa en tabell
// IF NOT EXISTS: Stoppar skapandet ifall det redan finns
// ID: Skapar ett slumpmässigt unikt nummer för varje användare
// TEXT: Formaterar till text sträng

$query = "CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT,
    user_email TEXT,
    user_password TEXT,
    user_picture TEXT
)";

$postquery = "CREATE TABLE IF NOT EXISTS posts (
    post_id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT,
    description TEXT,
    image TEXT,
    user_id INTEGER,
    comment TEXT
)";

$conn->exec($query);
$conn->exec($postquery);
?>