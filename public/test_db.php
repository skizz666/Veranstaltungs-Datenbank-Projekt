<?php
// Konfiguration lesen
require_once '../config/db.php';

// wenn das hier kommt passt alles:
if($pdo) {
    echo "<h1>Verbindung zur Datenbank erfolgreich!</h1>";
}