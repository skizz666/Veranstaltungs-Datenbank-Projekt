<?php

// Fehlerberichterstattung
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Zugangsdaten für die Datenbankverbindung
// $host = '127.0.0.1';
// $db   = 'red_db';
// $user = 'db_admin';
// $pwd = "";
// $port = 3307; //<== wegen ssh-Tunnel

$host = "localhost";
$user = "root";
$pwd = "";
$db = "red_db";

try {
    //Verbindung herstellen
    $link = mysqli_connect($host, $user, $pwd, $db);
    //Zeichensatz festlegen (wegen umlaute)
    mysqli_set_charset($link, 'utf8mb4');

} catch (mysqli_sql_exception $ex) {
// Fehler abfangen und zeigen
    die("Datenbankfehler: " . $ex->getMessage());
}
?>