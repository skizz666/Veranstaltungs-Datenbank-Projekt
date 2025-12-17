<div class="container">
    <h1>Aktuelle Veranstaltungen</h1>

    <div class="aufgabe2">
        <form action="index.php" method="POST">
            <button type="submit" class="kat-btn" name="ueberkategorie" value="veranstaltungen">Veranstaltungen</button>
            <button type="submit" class="kat-btn" name="ueberkategorie" value="veranstaltungsort">Veranstaltungsorte</button>
            <button type="submit" class="kat-btn" name="ueberkategorie" value="veranstaltungsart1">Veranstaltungsarten1</button>
            <button type="submit" class="kat-btn" name="ueberkategorie" value="veranstaltungskategorie">Veranstaltungskategorien</button>
            <button type="submit" class="kat-btn" name="ueberkategorie" value="zielgruppe">Zielgruppe</button>
        </form>
    </div>

    <div class="advanced-search">
        <h3>Suche</h3>
        <form action="index.php" method="POST">
            <div class="form-group">
                <label for="suche_freitext">Freitext:</label>
                <input type="text" id="suche_freitext" name="suche_freitext" placeholder="z.B. Konzert">
            </div>
            <div class="form-group">
                <label for="suche_kategorie">Kategorie:</label>
                <input type="text" id="suche_kategorie" name="suche_kategorie" placeholder="z.B. Konzert">
            </div>
            <div class="form-group">
                <label for="suche_art">Art:</label>
                <input type="text" id="suche_art" name="suche_art" placeholder="z.B. Open Air">
            </div>
            <div class="form-group">
                <label for="suche_ort">Ort:</label>
                <input type="text" id="suche_ort" name="suche_ort" placeholder="z.B. Kunstlabor Gostenhof">
            </div>
            <div class="form-group">
                <label for="suche_stadtteil">Stadtteil:</label>
                <input type="text" id="suche_stadtteil" name="suche_stadtteil" placeholder="z.B. Altstadt">
            </div>
            <button type="submit" class="search-btn" name="adv-search-btn">Suchen</button>
        </form>
    </div>

    <?php if (empty($daten)): ?>
        <p>Keine Veranstaltungen gefunden.</p>
    <?php else: ?>

        <table class="event-table">
            <thead>
            <tr>
                <th>Bild</th>
                <th>Titel</th>
                <th>Untertitel</th>
                <th>Beschreibung</th>
                <th>Kategorie</th>
                <th>Art</th>
                <th>Ort</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($daten as $eintrag): ?>
                <tr>
                    <td>
                        <div class="event-image-wrapper">
                            <?php
                            $bildDatei = !empty($eintrag['bild']) ? $eintrag['bild'] : 'standart_bildjpg';
                            ?>
                            <img src="../public/images/<?php echo htmlspecialchars($bildDatei); ?>" alt="Vorschau">
                        </div>
                    </td>
                    <td>
                        <strong><?php echo htmlspecialchars($eintrag['titel']); ?></strong>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($eintrag['untertitel']); ?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($eintrag['beschreibung']); ?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($eintrag['kategorie_name']); ?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($eintrag['art_name']); ?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($eintrag['orts_name']); ?>
                    </td>

                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

<!--
        <list class="aufgabe2-liste">
            <ul>
            <?php foreach ($daten as $eintrag): ?>
                <li>
                    <?php
                    if (isset($eintrag['titel'])) {
                        echo "<strong>" . htmlspecialchars($eintrag['titel']) . "</strong>";
                        echo " (". htmlspecialchars($eintrag['beschreibung']) . ")";
                    }
                    elseif (isset($eintrag['bezeichnung'])) {
                        echo htmlspecialchars($eintrag['bezeichnung']);
                    }
                    elseif (isset($eintrag['name'])) {
                        echo htmlspecialchars($eintrag['name']);
                    }
                    ?>
                </li>
                <?php endforeach; ?>
            </ul>
        </list>
-->
    <?php endif; ?>
</div>