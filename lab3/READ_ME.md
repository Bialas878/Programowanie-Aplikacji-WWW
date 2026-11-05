Laboratorium 3

#Adresy zdjęć:
https://www.urbogym.pl/wp-content/uploads/2025/02/UG_light_1.webp [Uchwyty do pompek]
https://thornfit.pl/532-large_default/nascienny-drazek-do-podciagania.jpg [Drążek]
https://www.urbogym.pl/wp-content/uploads/2025/02/UG_light_1-990x990.webp [Bieżnia LIGHT]

# Sposób 1: Przy użyciu języka Python
1. Pobierz to repozytorium na swój komputer.
2. Otwórz terminal (wiersz poleceń) i przejdź do folderu `lab1/`.
3. Uruchom lokalny serwer wpisując polecenie: 
   `python -m http.server 8000` 
   *(lub `python3 -m http.server 8000` na systemach macOS/Linux).*
4. Otwórz przeglądarkę internetową i wejdź pod adres: `http://localhost:8000/`.

# Sposób 2: Przy użyciu Visual Studio Code (Live Server)
1. Otwórz folder `lab1/` w edytorze Visual Studio Code.
2. Upewnij się, że masz zainstalowane rozszerzenie Live Server.
3. Kliknij prawym przyciskiem myszy na plik `index.html` i wybierz opcję **"Open with Live Server"**. Przeglądarka otworzy się automatycznie.

1. Instrukcja uruchomienia


1. Upewnij się, że posiadasz zainstalowane oprogramowanie lokalnego serwera XAMPP.
2. Włącz panel `XAMPP Control Panel` i uruchom usługę Apache (przycisk Start, moduł podświetlony na zielono).
3. Skopiuj cały folder z projektem (nazwany `lab3`) do publicznego katalogu serwera, czyli najczęściej: `C:\xampp\htdocs\lab3\`. 
4. Otwórz dowolną przeglądarkę internetową.
5. W pasku adresu wpisz: `http://localhost/lab3/`
   *(Jeżeli podczas konfiguracji Apache w plikach konfiguracyjnych zmieniony został domyślny port 80 na inny, np. na 8080, użyj adresu: `http://localhost:8080/lab3/`)*.
6. Aplikacja pobiera z serwera dokument `index.html`. Sprawdzanie komunikacji serwerowej wymaga również obecności pliku `status.php` obok pliku głównego.



2. Użyte zasoby techniczne i biblioteka



W projekcie wykorzystano lokalną kopię biblioteki jQuery pobraną bezpośrednio w pliku na dysk, unikając połączeń sieciowych z serwerami CDN.
Wersja: Wymagana pełna biblioteka zminifikowana, wersja 4.0.0 (Core).
Lokalizacja: `/vendor/jquery-4.0.0.min.js`.

Wywołanie HTML: Plik jest osadzony w `<head>` atrybutem `defer` dokładnie przed wywołaniem pliku własnego `lab3.js` oraz plików ze skryptami aplikacji.




Raport z testów - Lab 3 v2 (Animacje i AJAX)

**Animacja A - Problem z szybkimi kliknięciami**
Po wielu bardzo szybkich kliknięciach przycisk nie zapisuje zaległych operacji na stertę (nie ma efektu "pulsowania" z opóźnieniem). Animacja prawidłowo wygasa i od razu wraca do bazowych wymiarów dzięki metodzie blokującej `.stop(true, false)`. 

**Animacja B - Ruch kursora po powiększanym obszarze**
Przy najeżdżaniu kursor powoduje poprawny przyrost rozmiaru pudełka. Trzymanie myszy na obszarze podczas jego wzrostu, jak i na krawędziach, nie powoduje gwałtownego migotania i zmniejszania. Utrata fokusowania poprawnie zwraca przycisk do stanu zero. Zmienne `isHovered` oraz `isFocused` sterują tym bezbłędnie.

**Animacja C - Weryfikacja licznika skoków**
Zgodnie z wbudowaną blokadą pięć pierwszych kroków daje wzrost (każdorazowe rozszerzanie) i zwiększa licznik do 5. Kliknięcia ponad tę barierę są poprawnie blokowane i przycisk dalej się nie powiększa. Reset poprawnie cofa obiekt do punktu zerowego.

**Próba klawiatury i usunięcie płynności przy animacjach**
Wymuszenie wbudowanego `prefers-reduced-motion` natychmiast wycisza płynność interwału ze względu na opcję `$.fx.off = true` (wymóg u osób z ryzykiem epilepsji). Przemieszczanie za pomocą TAB oraz interakcja Enter/Spacja działają poprawnie dla każdego elementu bez użycia myszy.

**Test sieci i ochrony - Serwer PHP / AJAX**
Przy włączonym prawidłowym łączu żądanie nie odświeża strony i pobiera dane wyświetlając "PHP działa". Dwuklik wyłącza przycisk podczas operacji zapobiegając błędowi nadpisania. Po spowolnieniu łącza do 3 sekund polecenia `.text()` wpisały widoczne `Ładowanie...`. Z kolei przy braku odpowiedniego pliku `status.php` (kod 404), wywołano poprawny blok funkcji awaryjnej i tekst `Wystąpił błąd komunikacji z serwerem.`.