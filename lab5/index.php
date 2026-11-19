<?php

$id_projektu = "sklep-demo-lab5";


$strony = [
    'glowna' => [
        'tytul' => 'Strona główna',
        'plik'  => 'html/glowna.html'
    ],
    'kontakt' => [
        'tytul' => 'Kontakt',
        'plik'  => 'html/kontakt.html'
    ],
    'produkt' => [
        'tytul' => 'Szczegóły produktów',
        'plik'  => 'html/produkt.html'
    ],
    'filmy' => [
        'tytul' => 'Filmy',
        'plik'  => 'html/filmy.html'
    ]
];

$wybrany_klucz = null;
$blad_kod = 0;
$sciezka_pliku = '';
$tytul_strony = 'Sklep sportowy';

if (!isset($_GET['idp']) || $_GET['idp'] === '') {
    $wybrany_klucz = 'glowna';
} else {
    $idp = $_GET['idp'];
    if (!is_string($idp) || !array_key_exists($idp, $strony)) {
        $blad_kod = 404;
        http_response_code(404);
        $tytul_strony = '404 - Nie znaleziono podstrony';
    } else {
        $wybrany_klucz = $idp;
    }
}

if ($blad_kod === 0) {
    $tytul_strony = $strony[$wybrany_klucz]['tytul'];
    $sciezka_pliku = __DIR__ . '/' . $strony[$wybrany_klucz]['plik'];

    if (!is_file($sciezka_pliku) || !is_readable($sciezka_pliku)) {
        $blad_kod = 500;
        http_response_code(500);
        $tytul_strony = '500 - Błąd serwera';
    }
}
?>
<!doctype html>
<html lang="pl">
    <head>
        <script src="vendor/jquery-4.0.0.min.js" defer></script>
        <script src="js/main.js" defer></script>
        <script src="js/lab3.js" defer></script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo htmlspecialchars($tytul_strony, ENT_QUOTES, 'UTF-8'); ?></title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <section class="narzedzia">
            <nav>
                <?php foreach ($strony as $klucz => $dane): ?>
                    <?php
                        $href = ($klucz === 'glowna') ? 'index.php' : 'index.php?idp=' . urlencode($klucz);
                        $czy_aktywny = ($blad_kod === 0 && $wybrany_klucz === $klucz);
                    ?>
                    <a href="<?php echo $href; ?>"<?php if ($czy_aktywny) echo ' aria-current="page"'; ?>>
                        <?php echo htmlspecialchars($dane['tytul'], ENT_QUOTES, 'UTF-8'); ?>
                    </a>
                <?php endforeach; ?>
                <a href="lab4.php">Katalog</a>
            </nav>

            <button id="wygladowo" type="button">Zmień kolor na ciemny</button>
            <button id="btn-start" type="button">Start zegara</button>
            <button id="btn-stop" type="button">Stop zegara</button>
        </section>

        <header>
            <h1><?php echo htmlspecialchars($tytul_strony, ENT_QUOTES, 'UTF-8'); ?></h1>
            <p id="wyswietlanie_czasu"></p>
        </header>

        <main>
            <?php if ($blad_kod === 404): ?>
                <section>
                    <h2>Nie znaleziono podstrony (404)</h2>
                    <p>Podany adres nie istnieje lub jest nieprawidłowy.</p>
                    <p><a href="index.php">Powrót na stronę główną</a></p>
                </section>
            <?php elseif ($blad_kod === 500): ?>
                <section>
                    <h2>Błąd serwera (500)</h2>
                    <p>Nie udało się wczytać zawartości podstrony.</p>
                    <p><a href="index.php">Powrót na stronę główną</a></p>
                </section>
            <?php else: ?>
                <?php include $sciezka_pliku; ?>
            <?php endif; ?>
        </main>

        <footer>
            <p>Projekt: <?php echo htmlspecialchars($id_projektu, ENT_QUOTES, 'UTF-8'); ?></p>
        </footer>
    </body>
</html>