<?php
session_start();

$produkty = [
    ['id' => 1, 'nazwa' => 'Piraci z Karaibów', 'kategoria' => 'Książki', 'stan' => 7],
    ['id' => 2, 'nazwa' => 'Człowiek Nietoperz', 'kategoria' => 'Książki', 'stan' => 14],
    ['id' => 3, 'nazwa' => 'Notatnik', 'kategoria' => 'Akcesoria','stan' => 0],
    ['id' => 4, 'nazwa' => 'Zestaw ołówków', 'kategoria' => 'Akcesoria', 'stan' => 1]
];

$id_grupy = "Grupa XNL-5";
$tytul = "Katalog php - " . $id_grupy;
?>
<?php
$komunikat_post = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['produkt']) && isset($_POST['ilosc'])) {
        $id_wybrane = filter_var($_POST['produkt'], FILTER_VALIDATE_INT);
        $ilosc_wybrana = filter_var($_POST['ilosc'], FILTER_VALIDATE_INT);

        if ($id_wybrane !== false && $ilosc_wybrana !== false) {
            $znaleziony_produkt = null;
            reset($produkty);
            foreach ($produkty as $p) {
                if ($p['id'] === $id_wybrane) {
                    $znaleziony_produkt = $p;
                    break;
                }
            }
            if ($znaleziony_produkt !== null && $ilosc_wybrana >= 1 && $ilosc_wybrana <= 5 && $ilosc_wybrana <= $znaleziony_produkt['stan']) {
                
                
                $_SESSION['ostatni_wybor'] = [
                    'id' => $znaleziony_produkt['id'],
                    'nazwa' => $znaleziony_produkt['nazwa'],
                    'ilosc' => $ilosc_wybrana
                ];

               
                header("HTTP/1.1 303 See Other");
                header("Location: lab4.php");
                exit; 
            } else {
                http_response_code(400); 
                $komunikat_post = "<p style='color:red;'>Błąd: Nieprawidłowa ilość lub wybrany produkt jest niedostępny.</p>";
            }
        } else {
            http_response_code(400);
            $komunikat_post = "<p style='color:red;'>Błąd: Przekazane dane mają nieprawidłowy format.</p>";
        }
    } else {
        http_response_code(400);
        $komunikat_post = "<p style='color:red;'>Błąd: Brak wymaganych danych w formularzu.</p>";
    }
}
?>



<?php include __DIR__ . '/includes/naglowek.php'; ?>

<main class="katalog">
    <h1><?php echo $tytul; ?></h1>
    <a href="index.html">Powrót do strony głównej</a>

    <?php
    if ($komunikat_post != ""){
        echo $komunikat_post;
    }

    if (isset($_SESSION['ostatni_wybor'])){
        $wybor = $_SESSION['ostatni_wybor'];
        echo "<p style='color:blue; font-weight:bold;'>Zapisano: ".
            htmlspecialchars($wybor['nazwa']) . " (szt: " . htmlspecialchars($wybor['ilosc']) . ")</p>";
    } else {
        echo "<p>Brak zapisanego wyboru.</p>";
    }
    ?>

    <section class="produkty-php">
        <?php
        $wybrana_kategoria = 'wszystkie';
        $komunikat_filtra = '';

        if (isset($_GET['kategoria'])) {
            if ($_GET['kategoria'] === 'ksiazki' || $_GET['kategoria'] === 'akcesoria') {
                $wybrana_kategoria = $_GET['kategoria'];
            } elseif ($_GET['kategoria'] !== 'wszystkie') {
                $komunikat_filtra = "<p style='color:red; font-weight:bold;'>Nieznana kategoria. Wyświetlono pełną listę.</p>";
            }
        }
        
        
        echo $komunikat_filtra;

        reset($produkty);
        $ilosc_produktow = count($produkty);
        $i = 0;

        while ($i < $ilosc_produktow) {
            $produkt = $produkty[$i];
            $wyswietlaj = true;
            if ($wybrana_kategoria !== 'wszystkie') {
                $kat_baza = strtolower($produkt['kategoria']);
                if ($kat_baza !== $wybrana_kategoria && $kat_baza !== 'książki') {
                    $wyswietlaj = false;
                }
            }

           
            if ($wyswietlaj):

                switch(strtolower($produkt['kategoria'])) {
                    case 'książki':
                    case 'ksiazki':
                        $etykieta_kategorii = "Dział wydawniczy";
                        break;
                    case 'akcesoria':
                        $etykieta_kategorii = "Artykuły biurowe";
                        break;
                    default:
                        $etykieta_kategorii = "Inne";
                }

                if ($produkt['stan'] == 0) {
                    $stan_napis = "Niedostępny";
                } elseif ($produkt['stan'] >= 1 && $produkt['stan'] <= 5) {
                    $stan_napis = "Niski stan";
                } else {
                    $stan_napis = "Dostępny";
                }
                ?>

                <article class="karta">
                    <h2><?php echo htmlspecialchars($produkt['nazwa']); ?></h2>
                    <p>Kategoria: <?php echo htmlspecialchars($etykieta_kategorii); ?></p>
                    <p>Status: <strong><?php echo $stan_napis; ?></strong></p>

                    <?php if ($produkt['stan'] > 0): ?>
                        <form method="post" action="lab4.php">
                            <input type="hidden" name="produkt" value="<?php echo $produkt['id']; ?>">
                            <label for="ilosc_<?php echo $produkt['id']; ?>">Ilość:</label>
                            <select name="ilosc" id="ilosc_<?php echo $produkt['id']; ?>">
                                <?php
                                $max_opcji = min(5, $produkt['stan']);
                                for ($j = 1; $j <= $max_opcji; $j++) {
                                    echo "<option value=\"$j\">$j</option>";
                                }
                                ?>
                            </select>
                            <button type="submit">Zapisz</button>
                        </form>
                    <?php endif; ?>
                </article>

            <?php
            endif;
            
            $i++;
        } 
        ?>
    </section>
    <section class="narzedzia-wyszukiwania">
    <label for="Wyszukiwarka">Wyszukiwanie produktów</label>
    <input type="search" id="Wyszukiwarka" placeholder="Wpisz nazwe produktu">
    <p aria-live="polite">Znaleziono produktów: <span id="licznik">4</span></p>
</section>
</main>
</body>
</html>