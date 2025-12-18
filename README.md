# Veranstaltungskalender

Eine PHP-Webanwendung zur Verwaltung und Suche von Veranstaltungen. Das Projekt nutzt eine MySQL-Datenbank und verzichtet bewusst auf JavaScript für die Kernfunktionalität.

## Funktionen

*   **Veranstaltungsliste:** Übersicht aller Events mit Titel, Ort, Kategorie und Vorschaubild.
*   **Erweiterte Suche:**
    *   Freitextsuche über alle Felder (Titel, Beschreibung, Ort, etc.).
    *   Filter nach Rubrik (Dropdown), Kategorie, Art, Ort und Stadtteil.
*   **Kategorien-Filter:** Schnellzugriff auf Listen für Veranstaltungsarten, Orte und Zielgruppen.
*   **Bild-Vorschau:** CSS-basierter Zoom-Effekt beim Hovern über eine Tabellenzeile.

## Technologie-Stack

*   **Backend:** PHP (ohne Frameworks)
*   **Datenbank:** MySQL / MariaDB
*   **Frontend:** HTML5, CSS3 (Grid & Flexbox)
*   **Besonderheit:** Funktioniert vollständig ohne JavaScript.

## Installation

1.  Repository klonen.
2.  Datenbank importieren (`database/db_dump.sql`).
3.  Datenbank-Konfiguration anpassen (`config/db.php`).
4.  Webserver auf das `public`-Verzeichnis richten.
