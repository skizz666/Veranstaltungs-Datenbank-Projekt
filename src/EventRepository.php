<?php
// Datenbankverbindung aufbauen

// pfad:
require_once '../config/db.php';

/**
 * -----------------------------------------------------------------------------------------
 * alle Veranstaltungen holen (aus DB)
 * * @param mysqli $link → Datenbankverbindung
 * * @return array → Array mit allen Veranstaltungen
 */

function holeAlleVeranstaltungen($link) {
    $sql = "SELECT * FROM veranstaltung";

    //Anfrage senden
    $result = mysqli_query($link, $sql);

    $daten = [];

    //Ergebnisse einsammeln - PYTHON: Wir machen ein dict aus dem Datensatz
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $daten[] = $row;
        }
    }
    return $daten;
}

/**
 * -----------------------------------------------------------------------------------------
 * sucht Veranstaltungen basierend auf Suchbegriff
 * * @param mysqli $link → Datenbankverbindung
 * * @param string $suchbegriff → Suchbegriff
 * * @return array → Array mit den gefundenen Veranstaltungen
 */

function sucheVeranstaltungen($link, $suchbegriff) {
    // Das Suchgerüst
    $sql = "SELECT * FROM veranstaltung WHERE titel LIKE ? OR beschreibung LIKE ?";

    // Die Suche vorbereiten
    $stmt = mysqli_prepare($link, $sql);

    // Suchbegriff einpacken
    $suchterm = "%" . $suchbegriff . "%";

    // Platzhalter füllen (ss = 2strings = die 2 ? im Suchgerüst
    mysqli_stmt_bind_param($stmt, "ss", $suchterm, $suchterm);

    // Feuer!
    mysqli_stmt_execute($stmt);

    // Ergebnis holen
    $result = mysqli_stmt_get_result($stmt);

    $daten = [];
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $daten[] = $row;
    }
    return $daten;
}
?>

