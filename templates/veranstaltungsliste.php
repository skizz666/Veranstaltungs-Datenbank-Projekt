<div class="container">
    <h1>Aktuelle Veranstaltungen</h1>

    <div class="search-container">
        <form action="index.php" method="GET">
            <input type="text"
                   name="suche"
                   class="search-input"
                   placeholder="Suchen nach..."
                   value="<?php echo isset($_GET['suche']) ? htmlspecialchars($_GET['suche']) : ''; ?>">

            <button type="submit" class="search-btn">
                Suchen
            </button>

            <?php if (isset($_GET['suche']) && $_GET['suche'] !== ''): ?>
                <a href="index.php" class="reset-link">(Filter löschen)</a>
            <?php endif; ?>
        </form>
    </div>

    <?php if (empty($daten)): ?>
        <p>Keine Veranstaltungen gefunden.</p>
    <?php else: ?>

        <table class="event-table">
            <thead>
            <tr>
                <th>Titel</th>
                <th>Untertitel</th>
                <th>Beschreibung</th>
                <th>Ort-ID</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($daten as $eintrag): ?>
                <tr>
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
                        <?php echo $eintrag['veranstaltungsort_id']; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    <?php endif; ?>
</div>