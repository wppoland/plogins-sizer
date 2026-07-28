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

Füge deinen WooCommerce-Produkten über ein barrierefreies Modal Größenleitfäden und Größentabellen hinzu.

== Description ==

Sizer fügt deinen WooCommerce-Produktseiten einen Button „Größentabelle“ hinzu. Käufer klicken darauf, und eine Größentabelle öffnet sich in einem Modal, sodass sie die Maße prüfen können, ohne das Produkt zu verlassen.

Du erstellst jede Tabelle einmal im Adminbereich (eine beschriftete Tabelle aus Spalten und Zeilen sowie einer optionalen Beschriftung) und weist sie den Produkten zu, für die sie gilt. Der Button wird direkt nach dem „In den Warenkorb“-Button eingefügt. Ist einem Produkt keine Tabelle zugewiesen, wird der Seite nichts hinzugefügt.

Quellcode und Fehlerberichte findest du auf GitHub: https://github.com/wppoland/plogins-sizer

<strong>Was es kann</strong>

* Baue Größentabellen als beschriftete Tabellen und verwende dieselbe Tabelle für viele Produkte wieder.
* Wähle pro Produkt eine Tabelle auf dem Tab Produktdaten → Größentabelle.
* Öffnet in einem nativen `<dialog>`-Element mit beschrifteter Überschrift, einem Schließen-Button und Tastaturunterstützung.
* Lege den Button-Text und die Modal-Überschrift auf einem einzigen Einstellungsbildschirm fest.
* Das Stylesheet nutzt CSS-Custom-Properties (Akzentfarbe, Radius, Dialogfarben) und enthält eine Variante für dunkles Schema und reduzierte Bewegung.
* Keine externen Anfragen und kein Tracking; Tabellen werden in deiner eigenen Datenbank gespeichert.

== Installation ==

1. Lade das Plugin nach `/wp-content/plugins/plogins-sizer` hoch oder installiere es über Plugins → Installieren.
2. Aktiviere es. WooCommerce muss aktiv sein.
3. Gehe zu WooCommerce → Größentabellen, um eine Tabelle zu erstellen und die Button-Beschriftung festzulegen.
4. Weise einem Produkt eine Tabelle zu (Produktdaten → Größentabelle).

== Frequently Asked Questions ==

= Documentation and links =

* <strong>Dokumentation</strong> - https://plogins.com/de/plogins-sizer/docs/
* <strong>Plugin-Seite</strong> - https://plogins.com/de/plogins-sizer/
* <strong>Quellcode</strong> - https://github.com/wppoland/plogins-sizer
* <strong>Fehlerberichte und Funktionswünsche</strong> - https://github.com/wppoland/plogins-sizer/issues


= Does it require WooCommerce? =

Ja. Sizer erweitert die einzelnen Produktseiten von WooCommerce.

= Where does the size guide appear? =

Auf der einzelnen Produktseite, als Button, der nach dem „In den Warenkorb“-Button angezeigt wird. Der Button öffnet die Tabelle in einem barrierefreien Modal.

= Can I override the styling? =

Ja. Vorlagen lassen sich in deinem Theme in einem Ordner `sizer/` überschreiben, und das Shop-CSS stellt Custom Properties bereit, die du an dein Theme anpassen kannst.

= Is the size-guide modal accessible? =

Ja. Es verwendet ein natives `<dialog>` mit beschrifteter Überschrift, Schließen-Button und Tastaturunterstützung und berücksichtigt `prefers-reduced-motion`.

= Can one chart apply to many products? =

Ja. Erstelle eine Tabelle einmal unter WooCommerce → Größentabellen und weise sie dann auf dem Größentabelle-Tab jedes Produkts zu.


= Does this plugin work on WordPress Multisite? =

Ja. Dieses Plugin ist mit WordPress Multisite kompatibel. Aktiviere es netzwerkweit oder auf einzelnen Websites; jede Website behält ihre eigenen Einstellungen und Daten.

== Screenshots ==

1. Das Größentabellen-Modal auf einer Produktseite.
2. Erstellen einer wiederverwendbaren Größentabelle im Adminbereich.

== External Services ==

Sizer verbindet sich mit keinen externen Diensten. Es macht keine API-Aufrufe und lädt keine entfernten Skripte, Schriftarten oder Stylesheets. Deine Größentabellen und Button-/Überschrifteneinstellungen werden in deiner eigenen WordPress-Datenbank gespeichert (die Optionen `sizer_charts` und `sizer_settings`), und die jedem Produkt zugewiesene Tabelle liegt im Beitrags-Meta `_sizer_chart_id` dieses Produkts. Keine Daten verlassen deine Website, und nichts wird getrackt.

== Translations ==

Plogins Sizer enthält polnische, deutsche und spanische Übersetzungen für die Plugin-Oberfläche. Die Textdomain ist `plogins-sizer`, sodass Sprachpakete von WordPress.org diese mitgelieferten Übersetzungen ebenfalls überschreiben oder erweitern können.

== Changelog ==

= 1.0.2 =
* Mitgelieferte polnische, deutsche und spanische Übersetzungen für die Plugin-Oberfläche hinzugefügt.

= 1.0.1 =
* Erste stabile Version.

= 0.1.3 =
* Umbenannt in Plogins Sizer for WooCommerce für einen unverwechselbareren Plugin-Namen.

= 0.1.2 =
* Filter `sizer/match_size` und Dienst `SizeMatcher`, um Käufermaße mit Tabellenzeilen abzugleichen.
* Filter `sizer/chart` auf den aufgelösten Tabellendaten vor dem Rendern.

= 0.1.1 =
* Filter `sizer/chart_units` und Aktion `sizer/chart_controls` für das PRO-Einheitenumschalten auf gerenderten Tabellen.

= 0.1.0 =
* Erstveröffentlichung: wiederverwendbare Größentabellen, Zuweisung pro Produkt und ein barrierefreies Modal, das nach dem „In den Warenkorb“-Button angezeigt wird.
