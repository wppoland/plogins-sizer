=== Plogins Sizer - Size Guide for WooCommerce ===
Contributors: motylanogha
Tags: woocommerce, size guide, size chart, product, fashion
Requires at least: 6.5
Tested up to: 7.0
Requires PHP: 8.1
Stable tag: 1.0.2
Requires Plugins: woocommerce
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Dodawaj przewodniki i tabele rozmiarów do produktów WooCommerce w dostępnym oknie modalnym.

== Description ==

Sizer dodaje przycisk „Przewodnik po rozmiarach” do stron produktów WooCommerce. Kupujący klikają go, a tabela rozmiarów otwiera się w oknie modalnym, dzięki czemu mogą sprawdzić wymiary bez opuszczania strony produktu.

Każdą tabelę tworzysz raz w panelu administracyjnym (opisana tabela z kolumnami i wierszami oraz opcjonalny podpis) i przypisujesz ją do produktów, których dotyczy. Przycisk jest wstawiany zaraz za przyciskiem dodawania do koszyka. Jeśli produkt nie ma przypisanej tabeli, nic nie jest dodawane do strony.

Kod źródłowy i zgłoszenia błędów znajdziesz na GitHubie: https://github.com/wppoland/plogins-sizer

<strong>Co potrafi</strong>

* Buduj tabele rozmiarów jako opisane tabele i używaj tej samej tabeli w wielu produktach.
* Wybierz tabelę dla każdego produktu w zakładce Dane produktu → Przewodnik po rozmiarach.
* Otwiera się w natywnym elemencie `<dialog>` z oznaczonym nagłówkiem, przyciskiem zamykania i obsługą klawiatury.
* Ustaw tekst przycisku i nagłówek okna modalnego na jednym ekranie ustawień.
* Arkusz stylów korzysta z niestandardowych właściwości CSS (kolor akcentu, promień, kolory okna dialogowego) i zawiera wariant dla trybu ciemnego oraz ograniczonego ruchu.
* Brak żądań zewnętrznych i brak śledzenia; tabele są przechowywane w Twojej własnej bazie danych.

== Installation ==

1. Wgraj wtyczkę do `/wp-content/plugins/plogins-sizer` lub zainstaluj przez Wtyczki → Dodaj nową.
2. Włącz ją. WooCommerce musi być aktywne.
3. Przejdź do WooCommerce → Przewodniki po rozmiarach, aby utworzyć tabelę i ustawić etykietę przycisku.
4. Przypisz tabelę do produktu (Dane produktu → Przewodnik po rozmiarach).

== Frequently Asked Questions ==

= Documentation and links =

* <strong>Dokumentacja</strong> - https://plogins.com/pl/plogins-sizer/docs/
* <strong>Strona wtyczki</strong> - https://plogins.com/pl/plogins-sizer/
* <strong>Kod źródłowy</strong> - https://github.com/wppoland/plogins-sizer
* <strong>Zgłoszenia błędów i propozycje funkcji</strong> - https://github.com/wppoland/plogins-sizer/issues


= Does it require WooCommerce? =

Tak. Sizer rozszerza strony pojedynczych produktów WooCommerce.

= Where does the size guide appear? =

Na stronie pojedynczego produktu, jako przycisk wyświetlany po przycisku dodawania do koszyka. Przycisk otwiera tabelę w dostępnym oknie modalnym.

= Can I override the styling? =

Tak. Szablony można nadpisać w motywie w katalogu `sizer/`, a CSS sklepu udostępnia niestandardowe właściwości, które możesz dostosować do motywu.

= Is the size-guide modal accessible? =

Tak. Korzysta z natywnego elementu `<dialog>` z oznaczonym nagłówkiem, przyciskiem zamykania i obsługą klawiatury oraz respektuje `prefers-reduced-motion`.

= Can one chart apply to many products? =

Tak. Utwórz tabelę raz w WooCommerce → Przewodniki po rozmiarach, a następnie przypisz ją w zakładce Przewodnik po rozmiarach każdego produktu.


= Does this plugin work on WordPress Multisite? =

Tak. Ta wtyczka jest zgodna z WordPress Multisite. Włącz ją dla całej sieci lub w pojedynczych witrynach; każda witryna zachowuje własne ustawienia i dane.

== Screenshots ==

1. Okno modalne przewodnika po rozmiarach na stronie produktu.
2. Tworzenie tabeli rozmiarów wielokrotnego użytku w panelu administracyjnym.

== External Services ==

Sizer nie łączy się z żadnymi usługami zewnętrznymi. Nie wykonuje żadnych wywołań API i nie ładuje zdalnych skryptów, czcionek ani arkuszy stylów. Twoje tabele rozmiarów oraz ustawienia przycisku/nagłówka są przechowywane w Twojej własnej bazie danych WordPress (opcje `sizer_charts` i `sizer_settings`), a tabela przypisana do każdego produktu jest zapisywana w meta wpisu `_sizer_chart_id` tego produktu. Żadne dane nie opuszczają Twojej witryny i nic nie jest śledzone.

== Translations ==

Plogins Sizer zawiera polskie, niemieckie i hiszpańskie tłumaczenia interfejsu wtyczki. Domena tekstowa to `plogins-sizer`, dzięki czemu paczki językowe z WordPress.org mogą również nadpisywać lub rozszerzać dołączone tłumaczenia.

== Changelog ==

= 1.0.2 =
* Dodano dołączone polskie, niemieckie i hiszpańskie tłumaczenia interfejsu wtyczki.

= 1.0.1 =
* Pierwsza stabilna wersja.

= 0.1.3 =
* Zmieniono nazwę na Plogins Sizer for WooCommerce, aby uzyskać bardziej charakterystyczną nazwę wtyczki.

= 0.1.2 =
* Filtr `sizer/match_size` i usługa `SizeMatcher` do dopasowywania wymiarów kupującego do wierszy tabeli.
* Filtr `sizer/chart` na rozwiązanych danych tabeli przed renderowaniem.

= 0.1.1 =
* Filtr `sizer/chart_units` i akcja `sizer/chart_controls` do przełączania jednostek PRO na wyrenderowanych tabelach.

= 0.1.0 =
* Pierwsze wydanie: tabele rozmiarów wielokrotnego użytku, przypisanie do poszczególnych produktów oraz dostępne okno modalne wyświetlane po przycisku dodawania do koszyka.
