=== Plogins Sizer - Size Guide for WooCommerce ===
Contributors: motylanogha
Tags: woocommerce, size guide, size chart, product, fashion
Requires at least: 6.5
Tested up to: 7.0
Requires PHP: 8.1
Stable tag: 1.0.1
Wymaga wtyczek: woocommerce
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Dodaj przewodniki po rozmiarach i tabele rozmiarów do swoich produktów WooCommerce za pomocą dostępnego modalu.

== Description ==

Sizer dodaje przycisk „Przewodnik po rozmiarach” do stron produktów WooCommerce. Kupujący klikają go, a tabela rozmiarów otwiera się w trybie modalnym, dzięki czemu mogą sprawdzić wymiary bez opuszczania produktu.

Każdy wykres tworzysz raz w panelu administracyjnym (opisana tabela kolumn i wierszy oraz opcjonalny podpis) i przypisujesz go do dowolnych produktów, których dotyczy. Przycisk jest wstawiany zaraz po przycisku dodaj do koszyka. Jeśli produkt nie ma przypisanego wykresu, nic nie jest dodawane do strony.

Raporty o źródłach i błędach dostępne na GitHubie: https://github.com/wppoland/plogins-sizer

<strong>Co to robi</strong>

* Twórz tabele rozmiarów jako tabele z etykietami i używaj tej samej tabeli w wielu produktach.
* Wybierz tabelę poszczególnych produktów z zakładki Dane produktu → Przewodnik po rozmiarach.
* Otwiera się w natywnym elemencie `<dialog>` z oznaczonym nagłówkiem, przyciskiem zamykania i obsługą klawiatury.
* Ustaw tekst przycisku i nagłówek modalny na jednym ekranie ustawień.
* Arkusz stylów wykorzystuje niestandardowe właściwości CSS (kolor akcentu, promień, kolory okien dialogowych) i zawiera wariant ciemnego schematu i ograniczonego ruchu.
* Brak żądań zewnętrznych i brak śledzenia; wykresy są przechowywane w Twojej własnej bazie danych.

== Installation ==

1. Prześlij wtyczkę do `/wp-content/plugins/plogins-sizer` lub zainstaluj poprzez Wtyczki → Dodaj nową.
2. Aktywuj. WooCommerce musi być aktywny.
3. Przejdź do WooCommerce → Przewodniki po rozmiarach, aby utworzyć wykres i ustawić etykietę przycisku.
4. Przypisz tabelę do produktu (Dane produktu → Przewodnik po rozmiarach).

== Frequently Asked Questions ==

= Documentation and links =

* <strong>Dokumentacja</strong> - https://plogins.com/pl/plogins-sizer/docs/
* <strong>Strona wtyczki</strong> - https://plogins.com/pl/plogins-sizer/
* <strong>Kod źródłowy</strong> - https://github.com/wppoland/plogins-sizer
* <strong>Raporty o błędach i prośby o nowe funkcje</strong> - https://github.com/wppoland/plogins-sizer/issues


= Does it require WooCommerce? =

Tak. Sizer rozszerza strony pojedynczych produktów WooCommerce.

= Where does the size guide appear? =

Na stronie pojedynczego produktu, jako przycisk widoczny po przycisku Dodaj do koszyka. Przycisk otwiera wykres w dostępnym trybie.

= Can I override the styling? =

Tak. Szablony można zastąpić z motywu w folderze `sizer/`, a CSS witryny sklepowej udostępnia niestandardowe właściwości, których motyw można zmienić.

= Is the size-guide modal accessible? =

Tak. Używa natywnego „<dialogu>” z oznaczonym nagłówkiem, przyciskiem zamykania, obsługą klawiatury i respektuje opcję „preferuje ograniczony ruch”.

= Can one chart apply to many products? =

Tak. Utwórz raz wykres w WooCommerce → Przewodniki po rozmiarach, a następnie przypisz go na karcie Przewodnik po rozmiarach każdego produktu.


= Does this plugin work on WordPress Multisite? =

Tak. Ta wtyczka jest kompatybilna z WordPress Multisite. Aktywuj go w sieci lub aktywuj na poszczególnych stronach; każda witryna przechowuje własne ustawienia i dane.

== Screenshots ==

1. Modalny przewodnik po rozmiarach na stronie produktu.
2. Budowanie tabeli rozmiarów wielokrotnego użytku w panelu administracyjnym.

== External Services ==

Sizer nie łączy się z żadnymi usługami zewnętrznymi. Nie wykonuje żadnych wywołań API i nie ładuje zdalnych skryptów, czcionek ani arkuszy stylów. Twoje tabele rozmiarów i ustawienia przycisków/nagłówków są przechowywane w Twojej własnej bazie danych WordPress (opcje `sizer_charts` i `sizer_settings`), a tabela przypisana do każdego produktu jest przechowywana w meta postu `_sizer_chart_id` tego produktu. Żadne dane nie opuszczają Twojej witryny i nic nie jest śledzone.

== Changelog ==

= 1.0.1 =
* Pierwsza stabilna wersja.

= 0.1.3 =
* Zmieniono nazwę na Plogins Sizer dla WooCommerce, aby uzyskać bardziej charakterystyczną nazwę wtyczki.

= 0.1.2 =
* Filtr `sizer/match_size` i usługa `SizeMatcher` do dopasowywania wymiarów kupującego do wierszy wykresu.
* Filtr „rozmiar/wykres” na rozwiązanych danych wykresu przed renderowaniem.

= 0.1.1 =
* Filtr `sizer/chart_units` i akcja `sizer/chart_controls` dla przełączania jednostek PRO na renderowanych wykresach.

= 0.1.0 =
* Wersja pierwsza: tabele rozmiarów wielokrotnego użytku, przypisanie do poszczególnych produktów i dostępny moduł wyświetlany po przycisku „Dodaj do koszyka”.
