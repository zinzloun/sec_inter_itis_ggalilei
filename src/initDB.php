<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Creazione del database SQLite e della tabella utenti
$db = new SQLite3('vulnerable.db');

// Creazione della tabella utenti (se non esiste già)
$db->exec('CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY,
    username TEXT,
    password TEXT
)');

// Inserimento di alcuni dati di esempio
$db->exec("INSERT INTO users (username, password) VALUES ('admin', 'password123')");
$db->exec("INSERT INTO users (username, password) VALUES ('user', 'userpassword')");

echo "Done";

?>
