<?php

// Verbindung holen
require_once '../config/db.php';

// Repository (Bibliothekar) anrufen
require_once '../src/EventRepository.php';

/** @var mysqli $link */ // damit IDE weiß, dass $link eine mysqli-Verbindung ist

// checken ob Suche geschickt wurde
// $GET['suche'] entspricht "name"-Attribut im HTML Formular
if (isset($_GET['suche']) && !empty($_GET['suche'])) {

    $suchbegriff = $_GET['suche'];
    $daten = sucheVeranstaltungen($link, $suchbegriff);

} else {
    $daten = holeAlleVeranstaltungen($link);
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veranstaltungskalender</title>
    <link rel="stylesheet" href="../public/css/styles.css">
</head>

<body>
    <?php
    include '../templates/veranstaltungsliste.php';
    // Aufräumen
    mysqli_close($link);
    ?>

</body>
</html>


