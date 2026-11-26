<?php
$wersjaProjektu = 'v1.5';

require_once __DIR__ . '/showpage.php';

$wybranyAlias = null;
$bladKod = 0;
$strona = null;
$menuPozycje = [];
$tytulStrony = 'Sklep sportowy';

try {
    require_once __DIR__ . '/cfg.php';

    // 1. Walidacja parametru ?idp= przed wykonaniem zapytania
    if (!isset($_GET['idp']) || $_GET['idp'] === '') {
        $wybranyAlias = 'glowna';
    } else {
        $idp = $_GET['idp'];
        if (!is_string($idp) || preg_match('/^[a-z0-9-]{1,20}$/', $idp) !== 1) {
            $bladKod = 404;
            http_response_code(404);
            $tytulStrony = '404 - Nie znaleziono podstrony';
        } else {
            $wybranyAlias = $idp;
        }
    }

    // 2. Pobranie wybranej podstrony z bazy
    if ($bladKod === 0) {
        $strona = PokazPodstrone($pdo, $wybranyAlias);
        if ($strona === null) {
            $bladKod = 404;
            http_response_code(404);
            $tytulStrony = '404 - Nie znaleziono podstrony';
        } else {
            $tytulStrony = $strona['page_title'];
        }
    }

    // 3. Osobne zapytanie budujące menu wyłącznie z opublikowanych rekordów
    $stmtMenu = $pdo->query('SELECT alias, page_title FROM page_list WHERE status = 1 ORDER BY id');
    $menuPozycje = $stmtMenu->fetchAll();

} catch (Throwable $e) {
    error_log('Błąd bazy danych w index.php: ' . $e->getMessage());
    $bladKod = 500;
    http_response_code(500);
    $tytulStrony = '500 - Błąd serwera';
    $menuPozycje = [];
}
?>
<!doctype html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo htmlspecialchars($tytulStrony, ENT_QUOTES, 'UTF-8'); ?></title>
        <link rel="stylesheet" href="css/style.css">
        <script src="vendor/jquery-4.0.0.min.js" defer></script>
        <script src="js/main.js" defer></script>
        <script src="js/lab3.js" defer></script>
    </head>
    <body>
        <section class="narzedzia">
            <nav>
                <?php foreach ($menuPozycje as $pozycja): ?>
                    <?php
                        $aliasMenu = $pozycja['alias'];
                        $href = ($aliasMenu === 'glowna') ? 'index.php' : 'index.php?idp=' . urlencode($aliasMenu);
                        $czyAktywny = ($bladKod === 0 && $wybranyAlias === $aliasMenu);
                    ?>
                    <a href="<?php echo $href; ?>"<?php if ($czyAktywny) echo ' aria-current="page"'; ?>>
                        <?php echo htmlspecialchars($pozycja['page_title'], ENT_QUOTES, 'UTF-8'); ?>
                    </a>
                <?php endforeach; ?>
                <a href="lab4.php">Katalog</a>
                <a href="admin/admin.php">Panel CMS</a>
            </nav>

            <button id="wygladowo" type="button">Zmień kolor na ciemny</button>
            <button id="btn-start" type="button">Start zegara</button>
            <button id="btn-stop" type="button">Stop zegara</button>
        </section>

        <header>
            <h1><?php echo htmlspecialchars($tytulStrony, ENT_QUOTES, 'UTF-8'); ?></h1>
            <p id="wyswietlanie_czasu"></p>
        </header>

        <main>
            <?php if ($bladKod === 404): ?>
                <section>
                    <h2>Nie znaleziono podstrony (404)</h2>
                    <p>Podany adres nie istnieje lub strona jest nieopublikowana.</p>
                    <p><a href="index.php">Powrót na stronę główną</a></p>
                </section>
            <?php elseif ($bladKod === 500): ?>
                <section>
                    <h2>Błąd serwera (500)</h2>
                    <p>Nie udało się połączyć z bazą danych. Spróbuj ponownie później.</p>
                </section>
            <?php else: ?>
                <?php echo $strona['page_content']; ?>
            <?php endif; ?>
        </main>

        <footer>
            <p>Wersja projektu: <?php echo htmlspecialchars($wersjaProjektu, ENT_QUOTES, 'UTF-8'); ?></p>
        </footer>
    </body>
</html>