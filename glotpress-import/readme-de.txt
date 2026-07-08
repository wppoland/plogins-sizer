=== Plogins Sizer - Size Guide for WooCommerce ===
Contributors: motylanogha
Tags: woocommerce, size guide, size chart, product, fashion
Requires at least: 6.5
Tested up to: 7.0
Requires PHP: 8.1
Stable tag: 1.0.1
Erfordert Plugins: woocommerce
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Füge deinen WooCommerce-Produkten über ein zugängliches Modal Größenleitfäden und Größentabellen hinzu.

== Description ==

Sizer fügt deinen WooCommerce-Produktseiten eine Schaltfläche „Größenübersicht“ hinzu. Käufer klicken darauf und eine Größentabelle wird in einem Modal geöffnet, sodass sie die Maße überprüfen können, ohne das Produkt zu verlassen.

Du erstellen jedes Diagramm einmal im Admin (eine beschriftete Tabelle mit Spalten und Zeilen sowie einer optionalen Beschriftung) und weisen es den Produkten zu, für die es gilt. Die Schaltfläche wird direkt nach der Schaltfläche „In den Warenkorb“ eingefügt. Wenn einem Produkt kein Diagramm zugewiesen ist, wird der Seite nichts hinzugefügt.

Quell- und Fehlerberichte live auf GitHub: https://github.com/wppoland/plogins-sizer

<strong>Was es tut</strong>

* Erstelle Größentabellen als beschriftete Tabellen und verwende dieselbe Tabelle für viele Produkte wieder.
* Wähle auf der Registerkarte Produktdaten → Größentabelle eine Tabelle pro Produkt aus.
* Öffnet in einem nativen „<dialog>“-Element mit einer beschrifteten Überschrift, einer Schaltfläche zum Schließen und Tastaturunterstützung.
* Lege den Schaltflächentext und die modale Überschrift auf einem Einstellungsbildschirm fest.
* Das Stylesheet verwendet benutzerdefinierte CSS-Eigenschaften (Akzentfarbe, Radius, Dialogfarben) und enthält eine Variante mit dunklem Schema und reduzierter Bewegung.
* Keine externen Anfragen und kein Tracking; Diagramme werden in deiner eigenen Datenbank gespeichert.

== Installation ==

1. Lade das Plugin nach „/wp-content/plugins/plogins-sizer“ hoch oder installiere es über Plugins → Neu hinzufügen.
2. Aktiviere es. WooCommerce muss aktiv sein.
3. Gehe zu WooCommerce → Größenrichtlinien, um ein Diagramm zu erstellen und die Schaltflächenbeschriftung festzulegen.
4. Weise einem Produkt ein Diagramm zu (Produktdaten → Größentabelle).

== Frequently Asked Questions ==

= Documentation and links =

* <strong>Dokumentation</strong> - https://plogins.com/de/plogins-sizer/docs/
* <strong>Plugin-Seite</strong> - https://plogins.com/de/plogins-sizer/
* <strong>Quellcode</strong> – https://github.com/wppoland/plogins-sizer
* <strong>Fehlerberichte und Funktionsanfragen</strong> – https://github.com/wppoland/plogins-sizer/issues


= Does it require WooCommerce? =

Ja. Sizer erweitert WooCommerce einzelne Produktseiten.

= Where does the size guide appear? =

Auf der einzelnen Produktseite als Schaltfläche, die nach der Schaltfläche „In den Warenkorb“ angezeigt wird. Die Schaltfläche öffnet das Diagramm in einem zugänglichen Modalformat.

= Can I override the styling? =

Ja. Vorlagen können in deinem Theme im Ordner „sizer/“ überschrieben werden, und das Storefront-CSS stellt benutzerdefinierte Eigenschaften bereit, die du neu thematisieren können.

= Is the size-guide modal accessible? =

Ja. Es verwendet ein natives „<dialog>“ mit einer beschrifteten Überschrift, einer Schaltfläche zum Schließen, Tastaturunterstützung und berücksichtigt „prefers-reduced-motion“.

= Can one chart apply to many products? =

Ja. Erstelle einmal unter WooCommerce → Größentabellen ein Diagramm und weise es dann auf der Registerkarte „Größentabelle“ jedes Produkts zu.


= Does this plugin work on WordPress Multisite? =

Ja. Dieses Plugin ist mit WordPress Multisite kompatibel. Aktiviere es im Netzwerk oder auf einzelnen Websites. Jede Site behält ihre eigenen Einstellungen und Daten.

== Screenshots ==

1. Das Größenleitfaden-Modal auf einer Produktseite.
2. Erstellen einer wiederverwendbaren Größentabelle im Admin.

== External Services ==

Sizer stellt keine Verbindung zu externen Diensten her. Es führt keine API-Aufrufe durch und lädt keine Remote-Skripte, Schriftarten oder Stylesheets. deine Größentabellen und Schaltflächen-/Überschrifteneinstellungen werden in deiner eigenen WordPress-Datenbank gespeichert (die Optionen „sizer_charts“ und „sizer_settings“), und die jedem Produkt zugewiesene Tabelle wird im Post-Meta „_sizer_chart_id“ dieses Produkts gespeichert. Keine Daten verlassen deine Website und nichts wird verfolgt.

== Changelog ==

= 1.0.1 =
* Erste stabile Version.

= 0.1.3 =
* Für einen eindeutigeren Plugin-Namen in Plogins Sizer für WooCommerce umbenannt.

= 0.1.2 =
* „Sizer/Match_Size“-Filter und „SizeMatcher“-Dienst zum Abgleichen von Käufermaßen mit Diagrammzeilen.
* „Sizer/Chart“-Filter für aufgelöste Diagrammdaten vor dem Rendern.

= 0.1.1 =
* „sizer/chart_units“-Filter und „sizer/chart_controls“-Aktion für die PRO-Einheitenumschaltung bei gerenderten Diagrammen.

= 0.1.0 =
* Erstveröffentlichung: wiederverwendbare Größentabellen, Zuordnung pro Produkt und ein zugängliches Modal, das nach der Schaltfläche „In den Warenkorb“ angezeigt wird.
