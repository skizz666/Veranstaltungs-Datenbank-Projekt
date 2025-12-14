-- DML-Skript: Testdaten einfügen
-- Wir gehen davon aus, dass die Tabellen frisch und leer sind (Auto-Increment startet bei 1)

USE red_db;

-- 1. Veranstalter anlegen
INSERT INTO veranstalter (name, strasse, plz, ort, email, website) VALUES
                                                                       ('Kulturamt Erlangen', 'Gebbertstraße 1', '91052', 'Erlangen', 'kultur@erlangen.de', 'www.erlangen.de'),
                                                                       ('Franconian Metal e.V.', 'Hauptstr 666', '90443', 'Nürnberg', 'info@franconian-metal.de', 'www.metal-franken.de'),
                                                                       ('TechHub Bayern', 'Witschelstraße 10', '90431', 'Nürnberg', 'hello@techhub.de', 'www.techhub-bayern.de');

-- 2. Veranstaltungsorte anlegen
INSERT INTO veranstaltungsort (name, strasse, plz, ort, veranstaltungsort_art_id, stadtteil_id) VALUES
                                                                                                    ('E-Werk Kulturzentrum', 'Fuchsenwiese 1', '91054', 'Erlangen', 3, 1), -- ID 1 (Eventlocation)
                                                                                                    ('Z-Bau', 'Frankenstraße 200', '90461', 'Nürnberg', 11, 2),        -- ID 2 (Club)
                                                                                                    ('Heinrich-Lades-Halle', 'Rathausplatz 1', '91052', 'Erlangen', 2, 1); -- ID 3 (Tagungszentrum)

-- 3. Künstler anlegen
INSERT INTO kuenstler (bezeichnung, beschreibung) VALUES
                                                      ('Blind Guardian', 'Deutsche Metal-Band aus Krefeld.'),
                                                      ('Prof. Dr. Code', 'Experte für KI und Datenbanken.'),
                                                      ('Salsa-Gruppe Fuego', 'Tanzgruppe aus Kolumbien.');

-- 4. Veranstaltungen anlegen
-- Wir verknüpfen hier Veranstaltungsort (z.B. 1=E-Werk) und Veranstalter (z.B. 2=Metal Verein)
INSERT INTO veranstaltung (titel, untertitel, beschreibung, veranstaltungsort_id, veranstalter_id, preiskategorie_id, veranstaltungsart1_id, veranstaltungskategorie1_id) VALUES
                                                                                                                                                                              ('Winter Storm Festival', 'Das lauteste Event im Winter', 'Ein Abend voller Heavy Metal und Power Metal.', 2, 2, 5, 9, 7),
                                                                                                                                                                              ('KI in der Zukunft', 'Vortragsreihe', 'Wie künstliche Intelligenz unseren Alltag verändert.', 3, 3, 2, 8, 15),
                                                                                                                                                                              ('Latino Night', 'Tanz und Musik', 'Salsa, Bachata und Merengue - ein Stück Kolumbien in Erlangen.', 1, 1, 4, 3, 12);

-- 5. Termine (Wann finden die Events statt?)
-- Veranstaltung 1 (Metal)
INSERT INTO termin (datum, startzeit, endzeit, veranstaltung_id, ausverkauft) VALUES
    ('2025-12-20', '2025-12-20 19:00:00', '2025-12-20 23:30:00', 1, 0);

-- Veranstaltung 2 (KI Vortrag) - Findet zweimal statt
INSERT INTO termin (datum, startzeit, endzeit, veranstaltung_id, ausverkauft) VALUES
                                                                                  ('2025-11-15', '2025-11-15 10:00:00', '2025-11-15 12:00:00', 2, 1), -- Ausverkauft
                                                                                  ('2025-11-22', '2025-11-22 10:00:00', '2025-11-22 12:00:00', 2, 0);

-- Veranstaltung 3 (Latino Night)
INSERT INTO termin (datum, startzeit, endzeit, veranstaltung_id, ausverkauft) VALUES
    ('2025-11-18', '2025-11-18 20:00:00', '2025-11-18 02:00:00', 3, 0);

-- 6. Verknüpfungen (Wer tritt wo auf?)
-- Metal Band beim Metal Festival
INSERT INTO veranstaltung_kuenstler (veranstaltung_id, kuenstler_id) VALUES (1, 1);
-- Prof Code beim KI Vortrag
INSERT INTO veranstaltung_kuenstler (veranstaltung_id, kuenstler_id) VALUES (2, 2);
-- Salsa Gruppe bei Latino Night
INSERT INTO veranstaltung_kuenstler (veranstaltung_id, kuenstler_id) VALUES (3, 3);

-- 7. Zielgruppen zuweisen
-- Metal Festival -> Jugendliche (2), Erwachsene (5)
INSERT INTO veranstaltung_zielgruppe (veranstaltung_id, zielgruppe_id) VALUES (1, 2), (1, 5);
-- KI Vortrag -> Erwachsene (5), Studenten/Sonstige (6)
INSERT INTO veranstaltung_zielgruppe (veranstaltung_id, zielgruppe_id) VALUES (2, 5), (2, 6);
-- Latino Night -> Familien (3), Erwachsene (5)
INSERT INTO veranstaltung_zielgruppe (veranstaltung_id, zielgruppe_id) VALUES (3, 3), (3, 5);