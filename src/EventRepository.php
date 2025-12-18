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
    $sql = "SELECT v.*, 
                vo.name AS orts_name, 
                vk.bezeichnung AS kategorie_name, 
                va.bezeichnung AS art_name
            FROM veranstaltung v
            LEFT JOIN veranstaltungsort vo ON v.veranstaltungsort_id = vo.veranstaltungsort_id
            LEFT JOIN veranstaltungskategorie1 vk ON v.veranstaltungskategorie1_id = vk.veranstaltungskategorie1_id
            LEFT JOIN veranstaltungsart1 va ON v.veranstaltungsart1_id = va.veranstaltungsart1_id";

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


/**
 * -----------------------------------------------------------------------------------------
 * holt alle Einträge aus erlaubter Tabelle.
 * @param mysqli $link → Datenbankverbindung
 * @param string $tabellenName → Tabellenname (muss auf whitelist stehen)
 * @return array → Array mit den gefundenen Daten
 */
function holeDatenAusTabelle($link, $tabellenName){
    //Whitelist
    $erlaubteTabellen = [
        'veranstaltung',
        'veranstaltungsort',
        'veranstaltungsart1',
        'veranstaltungskategorie1',
        'zielgruppe'
    ];

    // Prüfen ob Tabelle erlaubt
    if (!in_array($tabellenName, $erlaubteTabellen)) {
        // wenn nicht erlaubt, leere Tabelle senden
        return [];
    }
    else{
    // SQL-Befehl sicher bauen
    $sql = "SELECT * FROM ". $tabellenName;

    //Anfrage senden
    $result = mysqli_query($link, $sql);

    $daten = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $daten[] = $row;
        }
    }
    }
    return $daten;
}

function sucheErweitert($link, $freitext, $rubrik ,$kategorie, $art, $ort, $stadtteil) {
    $sql = "SELECT DISTINCT v.*,
                vo.name AS orts_name, 
                vk.bezeichnung AS kategorie_name, 
                va.bezeichnung AS art_name
    FROM veranstaltung v
    LEFT JOIN veranstaltungsort vo ON v.veranstaltungsort_id = vo.veranstaltungsort_id
    LEFT JOIN stadtteil s ON vo.stadtteil_id = s.stadtteil_id
    LEFT JOIN veranstaltungskategorie1 vk ON v.veranstaltungskategorie1_id = vk.veranstaltungskategorie1_id
    LEFT JOIN veranstaltungsart1 va ON v.veranstaltungsart1_id = va.veranstaltungsart1_id
    LEFT JOIN veranstaltung_rubrik vr ON v.veranstaltung_id = vr.veranstaltung_id
    LEFT JOIN rubrik r ON vr.rubrik_id = r.rubrik_id
    WHERE 1=1";
    // WHERE 1=1 ist ein Trick, da es immer wahr ist, können wir alle folgebedingungen mit 'AND' anhängen

    $types = "";
    $params = [];

    //rubriksuche
    if (!empty($rubrik)) {
        $sql .= " AND r.bezeichnung LIKE ?";
        $types .= "s";
        $params[] = $rubrik;
    }

    //Freitext sucht in jeder Tabelle
    if (!empty($freitext)) {
        $sql .= " AND (
        v.titel LIKE ?
        OR v.beschreibung LIKE ?
        OR vo.name LIKE ?
        OR s.bezeichnung LIKE ?
        OR vk.bezeichnung LIKE ?
        OR va.bezeichnung LIKE ?
        )";
        // 6 mal ? = 6 strings = ssssss
        $types .= "ssssss";

        $suchTerm = "%" .$freitext . "%";

        // uschterm 6 Mal hinzufügen

        for($i = 0; $i < 6; $i++) {
            $params[] = $suchTerm;
        }
    }

    // Filter

    //Kategorie
    if (!empty($kategorie)) {
        $sql .= " AND vk.bezeichnung LIKE ?";
        $types .= "s";
        $params[] = "%" . $kategorie . "%";
    }

    //Art
    if (!empty($art)) {
        $sql .= " AND va.bezeichnung LIKE ?";
        $types .= "s";
        $params[] = "%" . $art . "%";
    }

    //Ort
    if (!empty($ort)) {
        $sql .= " AND vo.name LIKE ?";
        $types .= "s";
        $params[] = "%" . $ort . "%";
    }

    //Stadtteil
    if (!empty($stadtteil)) {
        $sql .= " AND s.bezeichnung LIKE ?";
        $types .= "s";
        $params[] = "%" . $stadtteil . "%";
    }

    // Anfrage vorbereiten und starten
    $stmt = mysqli_prepare($link, $sql);

    // Parameter nur binden wenn mind. ein Suchfeld bestückt
    if(!empty($params)) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $daten = [];
    while ($row =mysqli_fetch_assoc($result)) {
        $daten[] = $row;
    }
    return $daten;
}
//für das dropdown rubriken suchen wir erst einmal alle rubriken aus der Datenbank
function holeAlleRubriken($link){
    $sql = "SELECT * FROM rubrik";
    $result = mysqli_query($link, $sql);
    $daten = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $daten[] = $row;
        }
        }
    return $daten;
}
?>
