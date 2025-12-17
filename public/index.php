<?php

// Verbindung holen
require_once '../config/db.php';

// Repository (Bibliothekar) anrufen
require_once '../src/EventRepository.php';

/** @var mysqli $link */ // damit IDE weiß, dass $link eine mysqli-Verbindung ist

// checken ob Suche geschickt wurde
// $GET['suche'] entspricht "name"-Attribut im HTML Formular
// if (isset($_GET['suche']) && !empty($_GET['suche'])) {

//    $suchbegriff = $_GET['suche'];
//    $daten = sucheVeranstaltungen($link, $suchbegriff);

// Wurde Kategorie per POST geklickt?
if (isset($_POST['ueberkategorie'])) {
    $gewaehlteKategorie = $_POST['ueberkategorie'];
    $daten = holeDatenAusTabelle($link, $gewaehlteKategorie);
}
// Wurde Suche per POST abgeschickt?
elseif (isset($_POST['suche_freitext'])) {
    $freitext = trim($_POST['suche_freitext']);
    $kategorie = trim($_POST['suche_kategorie']);
    $art = trim($_POST['suche_art']);
    $ort = trim($_POST['suche_ort']);
    $stadtteil = trim($_POST['suche_stadtteil']);
    $daten = sucheErweitert($link, $freitext, $kategorie, $art, $ort, $stadtteil);
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


