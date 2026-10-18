Struktura:
Pliki index.html,kontakt.html,produkt.html nie miały błędów według Nu HTML Checker.

Widoki:
Po sprawdzeniu różnych widoki, jak jest szerokosc ekranu 767px to jest jedno zdjecie na ekranie, gdy zwiekszy się o 1 pojawiaja sie 3 zdjecia koło siebie

Klawiatura:
Przejścia tabem oraz powrót shift+tab działają oraz można włączyć każde pole w formularzu

Walidacja:
Błędny email skutkuje informacją na ekranie, liczby 0 i 6 pokazują że są za małe/duże
Po uzupełnieniu formularza końcówka adresu wygląda tak: email=kgrzybowinski3%40wp.pl&produkt=Uchwyty&ilosc=3&wiadomosc=Dla+testu+wpisuję+tekst

Eksperyment:
Po usunięciu name="email" końcówka adresu URL pokazuje:
produkt=Uchwyty&ilosc=3&wiadomosc=Tekst+w+ramach+testu
Oraz nie podpowiada emaile które można wpisać

Dzieje się tak ze względu na brak zapisu klucza. Name służy jako klucze (klucz=wartość) więc bez tego nie zapisze informacji w adresie URL

Usunięcie name sprawia, że dane nie są doklejane do adresu URL przy wysyłaniu, pokazała to metoda GET
