-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Lis 26, 2026 at 08:14 AM
-- Wersja serwera: 10.11.16-MariaDB
-- Wersja PHP: 8.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `moja_strona`
--

-- --------------------------------------------------------

--
-- Zrzut danych tabeli `page_list`
--

INSERT INTO `page_list` (`id`, `alias`, `page_title`, `page_content`, `status`) VALUES
(1, 'glowna', 'Strona glowna', '<section class=\"demo-animacje\">\r\n    <h2>Demonstracja jQuery</h2>\r\n    <p role=\"status\">Licznik kroków C: <span id=\"licznik-c\">0</span></p>\r\n\r\n    <div class=\"kontener-przyciskow\">\r\n        <button type=\"button\" class=\"btn-anim\" id=\"anim-a\" aria-pressed=\"false\">Animacja A</button>\r\n        <button type=\"button\" class=\"btn-anim\" id=\"anim-b\">Animacja B</button>\r\n        <button type=\"button\" class=\"btn-anim\" id=\"anim-c\">Animacja C</button>\r\n        <button type=\"button\" id=\"btn-sprawdz\">Sprawdź serwer</button>\r\n        <p role=\"status\" id=\"obszar-wyniku\"></p>\r\n    </div>\r\n\r\n    <button type=\"button\" id=\"btn-reset\">Resetuj A i C</button>\r\n    <p role=\"status\" id=\"ajax-status\"></p>\r\n</section>', 1),
(2, 'kontakt', 'Kontakt', '        <section class=\"formularz\">\r\n            <section id=\"sekcja_podsumowanie\">\r\n                <h2>Podsumowanie zapytania</h2>\r\n                <p id=\"wynik-ceny\">Wybierz produkt i ilość</p>\r\n                <p id=\"wynik-podsumowania\"></p>\r\n            </section>\r\n            <p>Formularz demonstracyjny. Dane pojawią się na w adresie strony, zapytanie nie zostanie zapisane ani wysłane emailem.</p>\r\n            <form method=\"get\" action=\"kontakt.html\">\r\n                <label for=\"emailKlienta\">Wpisz swój email:</label>\r\n                    <input type=\"email\" id=\"emailKlienta\" name=\"email\" required>\r\n                <label for=\"wyborProduktu\">Wybierz produkt (wymagane):</label>\r\n                <select id=\"wyborProduktu\" name=\"produkt\" required>\r\n                    <option value=\"\">Wybierz produkt</option>\r\n                    <option value=\"Uchwyty\">Uchwyty do pompek</option>\r\n                    <option value=\"Bieżnia\">Bieżnia LIGHT</option>\r\n                    <option value=\"drazek\">Drążek do podciagania</option>\r\n                    </select>\r\n                <label for=\"wyborIlosci\">Wprowadź ilość:</label>\r\n                    <input type=\"number\" id=\"wyborIlosci\" name=\"ilosc\" required min=\"1\" max=\"5\" step=\"1\">\r\n                <label for=\"wiadomoscKlienta\">Wiadomość (od 10 do 500 znaków:)</label>\r\n                    <textarea name=\"wiadomosc\" id=\"wiadomoscKlienta\" required minlength=\"10\" maxlength=\"500\"></textarea>\r\n                <button type=\"submit\">Sprawdz zapytanie</button>\r\n            </form>\r\n        \r\n        </section>', 1),
(3, 'produkt', 'Szczegóły produktów', '<article>\r\n    <h2>Uchwyty do pompek</h2>\r\n    <img src=\"img/uchwyty_do_pompek.webp\" alt=\"Czarne uchwyty do pomek\" width=\"1600\" height=\"1600\">\r\n    <p>Zastanawiasz się, jak możesz urozmaicić ćwiczenia, by były bardziej efektywne? Postaw na stalowe paraletki, dzięki którym wprowadzisz do swojego planu treningowego nowe elementy. Plank na uchwytach, L-sit, a może V-sit? Dzięki nowym ćwiczeniom jeszcze szybciej poprawisz swoją formę, wzmocnisz mięśnie i zwiększysz sprawność organizmu.\r\n        Nie musisz być profesjonalnym sportowcem czy uprawiać kalistenistykę, by w pełni skorzystać z zalet, jakie zapewnia trening z uchwytami do pompek. Sprawdzą się one również w przypadku osób, które ćwiczą amatorsko i za cel postawiły sobie wzmocnienie mięśni całego ciała.</p>\r\n    <p>Cena=<strong>28,99zł</strong></p>\r\n    <ul>\r\n        <li>\r\n            Paraletki zapewnią fizjologiczne ustawienie nadgarstków, dzięki czemu pomagają uniknąć przeciążeń i minimalizują ryzyko kontuzji. \r\n        </li>\r\n        <li>\r\n            Podczas wykonywania ćwiczeń na paraletkach mięśnie wykonują pełniejsze ruchy, dzięki czemu szybciej się wzmacniają.\r\n        </li>\r\n        <li>\r\n            Uchwyty do pompek pomagają zachować stabilną i prawidłową postawę.\r\n        </li>\r\n    </ul>\r\n    <table>\r\n        <caption>\r\n            Parametry techniczne\r\n        </caption>\r\n        <thead>\r\n            <tr>\r\n                <th scope=\"col\">Parametr</th>\r\n                <th scope=\"col\">Wartość</th>\r\n            </tr>\r\n        </thead>\r\n        <tbody>\r\n            <tr>\r\n                <td>Materiał:</td>\r\n                <td>Stal</td>\r\n            </tr>\r\n            <tr>\r\n                <td>Średnica części chwytnej:</td>\r\n                <td>32 mm</td>\r\n            </tr>\r\n            <tr>\r\n                <td>Udźwig paraletki:</td>\r\n                <td>200kg</td>\r\n            </tr>\r\n        </tbody>\r\n    </table>\r\n    <a href=\"index.php?idp=kontakt\">Zapytaj o produkt</a>\r\n</article>', 1),
(4, 'filmy', 'Filmy', '<section class=\"sekcja-filmy\">\r\n    <h2>Materiały wideo i instruktaże treningowe</h2>\r\n    <p>Przykładowe ćwiczenia z wykorzystaniem sprzętu z naszego katalogu.</p>\r\n\r\n    <article class=\"karta-filmu\">\r\n        <h3>1. Trening na paraletkach i uchwytach do pompek</h3>\r\n        <div class=\"kontener-wideo\">\r\n            <iframe\r\n                src=\"https://www.youtube.com/embed/IODxDxX7oi4\"\r\n                title=\"Instruktaż prawidłowego wykonywania pompek i ćwiczeń na uchwytach\"\r\n                loading=\"lazy\"\r\n                allow=\"accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\"\r\n                referrerpolicy=\"strict-origin-when-cross-origin\"\r\n                allowfullscreen>\r\n            </iframe>\r\n        </div>\r\n        <p><a href=\"https://www.youtube.com/watch?v=IODxDxX7oi4\" target=\"_blank\" rel=\"noopener noreferrer\">Otwórz film „Instruktaż prawidłowego wykonywania pompek” w serwisie YouTube</a></p>\r\n    </article>\r\n\r\n    <article class=\"karta-filmu\">\r\n        <h3>2. Prawidłowa technika podciągania na drążku</h3>\r\n        <div class=\"kontener-wideo\">\r\n            <iframe\r\n                src=\"https://www.youtube.com/embed/eGo4IYlbE5g\"\r\n                title=\"Poradnik poprawnej techniki podciągania na drążku naściennym\"\r\n                loading=\"lazy\"\r\n                allow=\"accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\"\r\n                referrerpolicy=\"strict-origin-when-cross-origin\"\r\n                allowfullscreen>\r\n            </iframe>\r\n        </div>\r\n        <p><a href=\"https://www.youtube.com/watch?v=eGo4IYlbE5g\" target=\"_blank\" rel=\"noopener noreferrer\">Otwórz film „Poradnik podciągania na drążku” w serwisie YouTube</a></p>\r\n    </article>\r\n\r\n    <article class=\"karta-filmu\">\r\n        <h3>3. Rozgrzewka i trening cardio na bieżni domowej</h3>\r\n        <div class=\"kontener-wideo\">\r\n            <iframe\r\n                src=\"https://www.youtube.com/embed/ml6cT4AZdqI\"\r\n                title=\"Trening cardio i rozgrzewka przed bieganiem w domu\"\r\n                loading=\"lazy\"\r\n                allow=\"accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\"\r\n                referrerpolicy=\"strict-origin-when-cross-origin\"\r\n                allowfullscreen>\r\n            </iframe>\r\n        </div>\r\n        <p><a href=\"https://www.youtube.com/watch?v=ml6cT4AZdqI\" target=\"_blank\" rel=\"noopener noreferrer\">Otwórz film „Trening cardio i rozgrzewka” w serwisie YouTube</a></p>\r\n    </article>\r\n</section>', 1),
(5, 'Regulamin', 'Regulamin strony', '<section><h2>Regulamin</h2><p>Strona robocza w przygotowaniu.</p></section>', 0);





/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
