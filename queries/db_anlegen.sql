-- DDL-Skript für DB-Projekt: IT202501
-- Version: 1.0
-- Datum: 12.12.2025

-- Tabellen
-- ========
-- veranstaltung
-- veranstalter
-- veranstaltungsort
-- veranstaltungsort_art
-- stadtteil
-- termin
-- preiskategorie
-- zielgruppe
-- veranstaltung_zielgruppe
-- rubrik
-- veranstaltung_rubrik
-- veranstaltungsart1
-- veranstaltungsart2
-- veranstaltungskategorie1
-- veranstaltungskategorie2
-- barrierefreiheit
-- veranstaltung_barrierefreiheit
-- kuenstler
-- verstaltung_kuenstler

create database if not exists red_db;
use red_db;

create table veranstaltung (
                               veranstaltung_id int auto_increment primary key,
                               titel varchar(100),
                               untertitel varchar(100),
                               beschreibung varchar(255),
                               buchungsportal varchar(100),
                               bild varchar(50),
                               veranstaltungsort_id int,
                               preiskategorie_id int,
                               veranstalter_id int,
                               veranstaltungsart1_id int,
                               veranstaltungskategorie1_id int
);


create table veranstalter (
                              veranstalter_id int auto_increment primary key,
                              name varchar(100),
                              strasse varchar(50),
                              plz varchar(5),
                              ort varchar(50),
                              ansprechpartner varchar(50) DEFAULT '',
                              telefon varchar(50),
                              email varchar(100),
                              website varchar(100)
);


create table veranstaltungsort (
                                   veranstaltungsort_id int auto_increment primary key,
                                   name varchar(100),
                                   strasse varchar(50),
                                   plz varchar(5),
                                   ort varchar(50),
                                   telefon varchar(50),
                                   email varchar(100),
                                   website varchar(100),
                                   gps_lang float,
                                   gps_breit float,
                                   veranstaltungsort_art_id int,
                                   stadtteil_id int
);


create table veranstaltungsort_art (
                                       veranstaltungsort_art_id  int auto_increment primary key,
                                       bezeichnung varchar(50)
);


create table stadtteil (
                           stadtteil_id  int auto_increment primary key,
                           bezeichnung varchar(50)
);

create table termin (
                        termin_id  int auto_increment primary key,
                        datum date,
                        startzeit datetime,
                        endzeit datetime,
                        einlass datetime,
                        hinweis varchar(255),
                        ausverkauft boolean,
                        abgesagt boolean,
                        veranstaltung_id int
);

create table preiskategorie (
                                preiskategorie_id  int auto_increment primary key,
                                bezeichnung varchar(50),
                                beschreibung varchar(50)
);


create table zielgruppe (
                            zielgruppe_id int auto_increment primary key,
                            bezeichnung varchar(50),
                            beschreibung varchar(255)
);


create table veranstaltung_zielgruppe (
                                          veranstaltung_zielgruppe_id int auto_increment primary key,
                                          veranstaltung_id int,
                                          zielgruppe_id int
);

create table rubrik (
                        rubrik_id int auto_increment primary key,
                        bezeichnung varchar(50),
                        beschreibung varchar(255)
);

create table veranstaltung_rubrik (
                                      veranstaltung_rubrik_id int auto_increment primary key,
                                      veranstaltung_id int,
                                      rubrik_id int
);

create table veranstaltungsart1 (
                                    veranstaltungsart1_id  int auto_increment primary key,
                                    bezeichnung varchar(50)
);

create table veranstaltungsart2 (
                                    veranstaltungsart2_id  int auto_increment primary key,
                                    bezeichnung varchar(50),
                                    veranstaltungsart1_id int
);


create table veranstaltungskategorie1 (
                                          veranstaltungskategorie1_id  int auto_increment primary key,
                                          bezeichnung varchar(50)
);

create table veranstaltungskategorie2 (
                                          veranstaltungskategorie2_id  int auto_increment primary key,
                                          bezeichnung varchar(50),
                                          veranstaltungskategorie1_id int
);

create table barrierefreiheit (
                                  barrierefreiheit_id int auto_increment primary key,
                                  bezeichnung varchar(50),
                                  beschreibung varchar(255)
);

create table veranstaltung_barrierefreiheit (
                                                veranstaltung_barrierefreiheit_id int auto_increment primary key,
                                                veranstaltung_id int,
                                                barrierefreiheit_id int
);

create table kuenstler (
                           kuenstler_id int auto_increment primary key,
                           bezeichnung varchar(100),
                           beschreibung varchar(255)
);

create table veranstaltung_kuenstler (
                                         veranstaltung_kuenstler_id int auto_increment primary key,
                                         veranstaltung_id int,
                                         kuenstler_id int
);




insert into veranstaltungsort_art (bezeichnung) values
                                                    ('Hotel'),
                                                    ('Tagungszentrum'),
                                                    ('Eventlocation'),
                                                    ('Bühne'),
                                                    ('Konzertsaal'),
                                                    ('Theater'),
                                                    ('Museum'),
                                                    ('Galerie'),
                                                    ('Park'),
                                                    ('Gastronomie'),
                                                    ('Club'),
                                                    ('Bar'),
                                                    ('Schloss'),
                                                    ('Stadium'),
                                                    ('Sporthalle'),
                                                    ('Sonstiges');




insert into veranstaltungskategorie1 (bezeichnung) values
                                                       ('Bildende Kunst'),
                                                       ('Film/Multimedia'),
                                                       ('Freizeit'),
                                                       ('Gesundheit'),
                                                       ('Kabarett/Kleinkunst'),
                                                       ('Literatur/Wort'),
                                                       ('Musik'),
                                                       ('Musiktheater'),
                                                       ('Netzwerken'),
                                                       ('Poliisches Leben'),
                                                       ('Sport'),
                                                       ('Tanz'),
                                                       ('Theater'),
                                                       ('Wirtschaft'),
                                                       ('Wissenschaft/Bildung'),
                                                       ('Sonstiges');



insert into veranstaltungskategorie2 (bezeichnung) values
                                                       ('Kinderkino'),
                                                       ('Stummfilm'),
                                                       ('Multimediavortrag'),
                                                       ('Rock/Pop'),
                                                       ('Soul/Blues'),
                                                       ('Weltmusik/Folk'),
                                                       ('Jazz'),
                                                       ('Klassik'),
                                                       ('Alternativ'),
                                                       ('Elektro'),
                                                       ('Schlager'),
                                                       ('Easy Listening'),
                                                       ('Oper'),
                                                       ('Operette'),
                                                       ('Musical'),
                                                       ('Stadtrat'),
                                                       ('Bürgerbeteiligung'),
                                                       ('Bürgerversammlung'),
                                                       ('Bürgerinitiative'),
                                                       ('Wahl'),
                                                       ('Fußball'),
                                                       ('Handball'),
                                                       ('Eishockey'),
                                                       ('Basketball'),
                                                       ('Leichtathletik'),
                                                       ('Volleyball'),
                                                       ('Ballett'),
                                                       ('Tanztheater'),
                                                       ('Figurentheater'),
                                                       ('Kindertheater'),
                                                       ('Performance'),
                                                       ('Forschung und Entwicklung'),
                                                       ('Exitenzgründung'),
                                                       ('Finanzierung und Förderung'),
                                                       ('Naturwissenschaften und Technik'),
                                                       ('Wirtschaft und Gesellschaft'),
                                                       ('Kunst und Kultur'),
                                                       ('Medizin'),
                                                       ('Sonstiges');



insert into veranstaltungsart1 (bezeichnung) values
                                                 ('Aufführung'),
                                                 ('Ausstellung'),
                                                 ('Disco/Party'),
                                                 ('Exkursion/Wanderung'),
                                                 ('Fest'),
                                                 ('Festival'),
                                                 ('Führung'),
                                                 ('Gespräch/Diskussion/Vortrag'),
                                                 ('Konzert'),
                                                 ('Kundgebung'),
                                                 ('Lesung'),
                                                 ('Performance'),
                                                 ('Tagung/Markt'),
                                                 ('Wettkampf'),
                                                 ('Workshop'),
                                                 ('Sonstiges');



insert into veranstaltungsart2 (bezeichnung) values
                                                 ('Derniere'),
                                                 ('Premiere'),
                                                 ('Finissage'),
                                                 ('Vernissage'),
                                                 ('Geselliges'),
                                                 ('Kirchweih'),
                                                 ('Spiel'),
                                                 ('Stadtteilfest'),
                                                 ('Tag der offenen Tür'),
                                                 ('Kongress'),
                                                 ('Markt'),
                                                 ('Messe'),
                                                 ('Symposium'),
                                                 ('Wettkampf zu Teilnehmen'),
                                                 ('Wettkampf zum Zuschauen'),
                                                 ('Sonstiges');




insert into preiskategorie (bezeichnung, beschreibung) values
                                                           ('Kategorie 1', 'kostenlos'),
                                                           ('Kategorie 2', 'bis 5 EUR'),
                                                           ('Kategorie 3', 'bis 10 EUR'),
                                                           ('Kategorie 4', 'bis 20 EUR'),
                                                           ('Kategorie 5', 'bis 30 EUR'),
                                                           ('Kategorie 6', 'bis 40 EUR'),
                                                           ('Kategorie 7', 'bis 50 EUR');



insert into barrierefreiheit (bezeichnung) values
                                               ('fremdsprachig'),
                                               ('mehrsprachig'),
                                               ('Gebärdensprache'),
                                               ('ohne Sprache'),
                                               ('induktive Hörverstärkung'),
                                               ('barrierefreier Zugang'),
                                               ('barrierefreie Toilette'),
                                               ('Audiodeskription');





insert into zielgruppe (bezeichnung) values
                                         ('Kinder'),
                                         ('Jugendliche'),
                                         ('Familien'),
                                         ('Senioren'),
                                         ('Erwachsene'),
                                         ('Sonstige');



