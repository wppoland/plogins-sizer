=== Sizer - Size Guide and Charts for WooCommerce ===
Contributors: wppoland
Tags: woocommerce, size guide, size chart, product, fashion
Requires at least: 6.5
Tested up to: 7.0
Requires PHP: 8.1
Stable tag: 0.1.0
Requires Plugins: woocommerce
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Add size guides and size charts to products via an accessible modal or tab.

== Description ==

Sizer lets you build reusable size charts and show them on your WooCommerce products — either in an accessible pop-up modal or as a product tab. Fewer sizing questions, fewer returns.

Create a chart once (a simple labelled table of rows and columns), then assign it to individual products or to whole product categories. The size guide appears automatically on the product page using the trigger style and placement you choose.

**Features**

* Reusable size charts — build a labelled table once and reuse it everywhere.
* Assign per product, or set a default chart per product category.
* Accessible native `<dialog>` modal — keyboard operable, focus-managed, screen-reader friendly.
* Or show the chart inline as a product tab instead of a modal.
* Choose the trigger style (button or text link) and where it appears on the product page.
* Themeable, responsive output with no layout shift; respects reduced-motion and dark mode.
* Graceful by design — nothing renders when a product has no chart assigned.
* Fully self-contained: no external services, no tracking.

**Sizer PRO**

Sizer PRO adds per-variation charts, unit switching (cm/inch), a "find my size" calculator, import/export, and more.

== Installation ==

1. Upload the plugin to `/wp-content/plugins/sizer`, or install via Plugins → Add New.
2. Activate it. WooCommerce must be active.
3. Go to WooCommerce → Size Guides to create a chart and configure display options.
4. Assign a chart on a product (Product data → Size guide) or on a product category.

== Frequently Asked Questions ==

= Does it require WooCommerce? =

Yes. Sizer extends WooCommerce single product pages.

= Where does the size guide appear? =

On the single product page. You choose the placement (after/before the add-to-cart button, in the product summary or meta area, or as a product tab) under WooCommerce → Size Guides.

= Can I use one chart for a whole category? =

Yes. Assign a chart to a product category and every product in it inherits the chart, unless the product has its own assignment.

= Can I override the styling? =

Yes. Templates can be overridden from your theme under a `sizer/` folder, and the storefront CSS exposes custom properties you can re-theme.

== Screenshots ==

1. The size guide modal on a product page.
2. Building a reusable size chart in the admin.

== Changelog ==

= 0.1.0 =
* Initial release: reusable charts, per-product and per-category assignment, accessible modal or product tab, configurable trigger style and placement.
