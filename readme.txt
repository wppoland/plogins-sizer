=== Plogins Sizer - Size Guide for WooCommerce ===
Contributors: motylanogha
Tags: woocommerce, size guide, size chart, product, fashion
Requires at least: 6.5
Tested up to: 7.1
Requires PHP: 8.1
Stable tag: 1.0.13
Requires Plugins: woocommerce
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Add size guides and size charts to your WooCommerce products via an accessible modal.

== Description ==

Sizer adds a "Size guide" button to your WooCommerce product pages. Shoppers click it and a size chart opens in a modal, so they can check measurements without leaving the product.

You build each chart once in the admin (a labelled table of columns and rows, plus an optional caption) and assign it to whichever products it applies to. The button is injected right after the add-to-cart button. If a product has no chart assigned, nothing is added to the page.

Source and bug reports live on GitHub: [github.com/wppoland/plogins-sizer](https://github.com/wppoland/plogins-sizer)

**What it does**

* Build size charts as labelled tables and reuse the same chart across many products.
* Pick a chart per product from the Product data > Size guide tab.
* Opens in a native `<dialog>` element with a labelled heading, a close button, and keyboard support.
* Set the button text and the modal heading from one settings screen.
* Stylesheet uses CSS custom properties (accent colour, radius, dialog colours) and includes a dark-scheme and reduced-motion variant.
* No external requests and no tracking; charts are stored in your own database.

== Installation ==

1. Upload the plugin to `/wp-content/plugins/plogins-sizer`, or install via Plugins > Add New.
2. Activate it. WooCommerce must be active.
3. Go to WooCommerce > Size Guides to create a chart and set the button label.
4. Assign a chart on a product (Product data > Size guide).

== Frequently Asked Questions ==

= Documentation and links =

* **Documentation**: [plogins.com/plogins-sizer/docs/](https://plogins.com/plogins-sizer/docs/)
* **Plugin page**: [plogins.com/plogins-sizer/](https://plogins.com/plogins-sizer/)
* **Source code**: [github.com/wppoland/plogins-sizer](https://github.com/wppoland/plogins-sizer)
* **Bug reports and feature requests**: [github.com/wppoland/plogins-sizer/issues](https://github.com/wppoland/plogins-sizer/issues)


= Does it require WooCommerce? =

Yes. Sizer extends WooCommerce single product pages.

= Where does the size guide appear? =

On the single product page, as a button shown after the add-to-cart button. The button opens the chart in an accessible modal.

= Can I override the styling? =

Yes. Templates can be overridden from your theme under a `sizer/` folder, and the storefront CSS exposes custom properties you can re-theme.

= Is the size-guide modal accessible? =

Yes. It uses a native `<dialog>` with a labelled heading, close button, keyboard support and respects `prefers-reduced-motion`.

= Can one chart apply to many products? =

Yes. Build a chart once under WooCommerce > Size Guides, then assign it on each product's Size guide tab.


= Does this plugin work on WordPress Multisite? =

Yes. This plugin is compatible with WordPress Multisite. Network activate it or activate it on individual sites; each site keeps its own settings and data.

== Screenshots ==

1. The size guide modal on a product page.
2. Building a reusable size chart in the admin.

== External Services ==

Sizer does not connect to any external services. It makes no API calls and loads no remote scripts, fonts, or stylesheets. Your size charts and button/heading settings are stored in your own WordPress database (the `sizer_charts` and `sizer_settings` options), and each product's assigned chart is kept in that product's `_sizer_chart_id` post meta. No data leaves your site, and nothing is tracked.

== Translations ==

Plogins Sizer is fully translatable and ships the `plogins-sizer.pot` template. Translations are delivered by WordPress.org language packs from translate.wordpress.org, which is where Polish, German and Spanish are being contributed; the package itself carries no compiled translation files.

== Changelog ==

= 1.0.13 =
* Fixed: the PRO upgrade promo kept selling to people who had already bought the paid edition. Only the banner could be dismissed, so the sidebar promo and the locked feature cards followed a paying customer around for good. The promo now checks whether the paid edition is active and steps aside when it is.
* Fixed: arrow glyphs in the admin menu paths, and in the strings handed to translators. An arrow inside a translatable string makes the glyph every translator's problem and changes the layout in any locale that drops it.

= 1.0.12 =
* Fixed: deleting the plugin left the per-user "dismiss" flag from the PRO notice in the database. Uninstall now removes it for every user, not just the one who dismissed it.

= 1.0.11 =
* Fixed: the PRO notice described the store-wide default chart as a fallback for products with no per-product or per-category assignment. There is no per-category assignment in either edition, so the sentence pointed at a screen that does not exist.

= 1.0.10 =
* Fixed the size guide showing English on a translated shop. The link wording ("Size guide") and the pop-up heading were shipped as plain text in a config file and written into the database when the plugin was activated, so they were never part of the translation files and no language pack could reach them. Both now default to a translatable string, so they follow the site language as soon as a translation exists. Translations are delivered by WordPress.org language packs rather than bundled here, so the wording stays English until a pack is published. If you never changed the wording, the old English value is cleared on update and the translated one takes over; wording you typed yourself, in any language, is left exactly as it is.

= 1.0.9 =
* Renamed to Plogins Sizer - Size Guide for WooCommerce so the name leads with the brand rather than a generic word, which is what the WordPress.org plugin review team asks for. The plugin slug is unchanged.

= 1.0.8 =
* Removed the "Tested up to" header from the main PHP file. It belongs in readme.txt only, where it is already declared; present in both, the header can override the readme and show a compatibility version that was never intended.

= 1.0.7 =
* Tested against WordPress 7.1. Verified by activating this build on a clean 7.1 install with WooCommerce 11.1, not by editing the header.

= 1.0.6 =
* Fixed the PRO promo on the settings screen quoting a price in PLN. PRO is priced and charged in EUR, so an admin on a Polish site was shown a zloty amount and then billed in euro, and the zloty figure was a fixed conversion that drifted from the real charge as the rate moved. The promo now shows the euro price that is actually taken.

= 1.0.5 =
* Two size charts with the same or similar name (a men's and a women's "T-shirts", or "Summer tops" and "Summer Tops") now both survive. Previously one of them disappeared on reload and products assigned to it started showing the other chart's measurements.

= 1.0.3 =
* Translations: completed Polish, German and Spanish for the PRO upgrade panel.

= 1.0.2 =
* Added bundled Polish, German and Spanish translations for the plugin interface.

= 1.0.1 =
* First stable release.

= 0.1.3 =
* Renamed to Plogins Sizer for WooCommerce for a more distinctive plugin name.

= 0.1.2 =
* `sizer/match_size` filter and `SizeMatcher` service for matching shopper measurements to chart rows.
* `sizer/chart` filter on resolved chart data before render.

= 0.1.1 =
* `sizer/chart_units` filter and `sizer/chart_controls` action for PRO unit switching on rendered charts.

= 0.1.0 =
* Initial release: reusable size charts, per-product assignment, and an accessible modal shown after the add-to-cart button.
