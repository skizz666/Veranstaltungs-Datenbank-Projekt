create table if not exists barrierefreiheit
(
    barrierefreiheit_id int auto_increment
        primary key,
    bezeichnung         varchar(50)  null,
    beschreibung        varchar(255) null
);

create table if not exists kuenstler
(
    kuenstler_id int auto_increment
        primary key,
    bezeichnung  varchar(100) null,
    beschreibung varchar(255) null
);

create table if not exists preiskategorie
(
    preiskategorie_id int auto_increment
        primary key,
    bezeichnung       varchar(50) null,
    beschreibung      varchar(50) null
);

create table if not exists rubrik
(
    rubrik_id    int auto_increment
        primary key,
    bezeichnung  varchar(50)  null,
    beschreibung varchar(255) null
);

create table if not exists stadtteil
(
    stadtteil_id int auto_increment
        primary key,
    bezeichnung  varchar(50) null
);

create table if not exists termin
(
    termin_id        int auto_increment
        primary key,
    datum            date         null,
    startzeit        datetime     null,
    endzeit          datetime     null,
    einlass          datetime     null,
    hinweis          varchar(255) null,
    ausverkauft      tinyint(1)   null,
    abgesagt         tinyint(1)   null,
    veranstaltung_id int          null
);

create table if not exists veranstalter
(
    veranstalter_id int auto_increment
        primary key,
    name            varchar(100)           null,
    strasse         varchar(50)            null,
    plz             varchar(5)             null,
    ort             varchar(50)            null,
    ansprechpartner varchar(50) default '' null,
    telefon         varchar(50)            null,
    email           varchar(100)           null,
    website         varchar(100)           null
);

create table if not exists veranstaltung
(
    veranstaltung_id            int auto_increment
        primary key,
    titel                       varchar(100) null,
    untertitel                  varchar(100) null,
    beschreibung                varchar(255) null,
    buchungsportal              varchar(100) null,
    bild                        varchar(50)  null,
    veranstaltungsort_id        int          null,
    preiskategorie_id           int          null,
    veranstalter_id             int          null,
    veranstaltungsart1_id       int          null,
    veranstaltungskategorie1_id int          null
);

create table if not exists veranstaltung_barrierefreiheit
(
    veranstaltung_barrierefreiheit_id int auto_increment
        primary key,
    veranstaltung_id                  int null,
    barrierefreiheit_id               int null
);

create table if not exists veranstaltung_kuenstler
(
    veranstaltung_kuenstler_id int auto_increment
        primary key,
    veranstaltung_id           int null,
    kuenstler_id               int null
);

create table if not exists veranstaltung_rubrik
(
    veranstaltung_rubrik_id int auto_increment
        primary key,
    veranstaltung_id        int null,
    rubrik_id               int null
);

create table if not exists veranstaltung_zielgruppe
(
    veranstaltung_zielgruppe_id int auto_increment
        primary key,
    veranstaltung_id            int null,
    zielgruppe_id               int null
);

create table if not exists veranstaltungsart1
(
    veranstaltungsart1_id int auto_increment
        primary key,
    bezeichnung           varchar(50) null
);

create table if not exists veranstaltungsart2
(
    veranstaltungsart2_id int auto_increment
        primary key,
    bezeichnung           varchar(50) null,
    veranstaltungsart1_id int         null
);

create table if not exists veranstaltungskategorie1
(
    veranstaltungskategorie1_id int auto_increment
        primary key,
    bezeichnung                 varchar(50) null
);

create table if not exists veranstaltungskategorie2
(
    veranstaltungskategorie2_id int auto_increment
        primary key,
    bezeichnung                 varchar(50) null,
    veranstaltungskategorie1_id int         null
);

create table if not exists veranstaltungsort
(
    veranstaltungsort_id     int auto_increment
        primary key,
    name                     varchar(100) null,
    strasse                  varchar(50)  null,
    plz                      varchar(5)   null,
    ort                      varchar(50)  null,
    telefon                  varchar(50)  null,
    email                    varchar(100) null,
    website                  varchar(100) null,
    gps_lang                 float        null,
    gps_breit                float        null,
    veranstaltungsort_art_id int          null,
    stadtteil_id             int          null
);

create table if not exists veranstaltungsort_art
(
    veranstaltungsort_art_id int auto_increment
        primary key,
    bezeichnung              varchar(50) null
);

create table if not exists zielgruppe
(
    zielgruppe_id int auto_increment
        primary key,
    bezeichnung   varchar(50)  null,
    beschreibung  varchar(255) null
);

