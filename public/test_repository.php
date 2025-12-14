<?php
// Verbindung holen
require_once '../config/db.php';

// Repository (Bibliothekar) anrufen
require_once '../src/EventRepository.php';

echo "<h1>Repo Test</h1>";

// Funktion aufrufen ($link aus db.php übergeben)
$veranstaltungen = holeAlleVeranstaltungen($link);

// Ergebnis anzeigen
echo "<pre>"; // <pre> macht lesbar
print_r($veranstaltungen); //print_r zeigt Array lesbar an
echo "</pre>";
?>

