Instrukcja uruchomienia:


1. Uruchom **XAMPP Control Panel** i włącz usługę **Apache** (status zielony).
2. Umieść cały katalog `lab5` w folderze publicznym serwera: `C:\xampp\htdocs\lab5\`[cite: 1].
3. Otwórz przeglądarkę internetową i przejdź pod adres: `http://localhost/lab5/index.php`.

Główne adresy aplikacji:


- `http://localhost/lab5/index.php` – główny szablon (front controller) obsługujący podstrony przez parametr `GET idp`:
  - `index.php` lub `index.php?idp=glowna` – strona główna (demonstracja jQuery i AJAX)[cite: 1, 3]
  - `index.php?idp=kontakt` – formularz kontaktowy[cite: 1]
  - `index.php?idp=produkt` – szczegóły produktu[cite: 1]
  - `index.php?idp=filmy` – podstrona z materiałami wideo[cite: 2]
- `http://localhost/lab5/lab4.php` – katalog produktów w PHP z filtrowaniem (`?kategoria=...`) oraz zapisem wyboru w sesji (`$_SESSION`)[cite: 1, 3].
- `http://localhost/lab5/status.php` – skrypt zwracający status serwera dla żądań AJAX ze strony głównej[cite: 1, 3].

Testy:

1. Po sprawdzeniu index.php oraz index.php?idp=, obydwie próby pokazują się jako strona oraz odnośniki otwierają się właściwie z poprawnym tytułem jak i treścią
2.Błąd 404 pokazuje się przy ?idp=nieznana i ?idp[]=filmy, jest także działający odnośnik powrotny
3.Błąd 404 przy ?idp=..%2Fstatus.php oraz nie zostaje dołączona zawartość status.php
5.Przy zmianie nazwy html/filmy.html. Adres ?idp=filmy zwraca HTTP 500 bez ujawnienia ścieżki systemowej
6.Na stronie głównej działają style, grafiki i animacje. W panelu Sieć
widać udane żądanie do status.php, a na stronie jego wynik.
8. Po wlaczeniu katalogu z menu i uzyciu filtra pojawia sięw NETWORK POST 303 oraz GET 200
9.Filmy można uruchomić, odnośniki działają a przy szerokości 360 strona nie przewija się w poziomie