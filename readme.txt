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

Add size guides and size charts to your WooCommerce products via an accessible modal.

== Description ==

Sizer lets you build reusable size charts and show them on your WooCommerce products in an accessible pop-up modal. Fewer sizing questions, fewer returns.

Create a chart once (a simple labelled table of rows and columns), then assign it to a product. A "Size guide" button appears automatically after the add-to-cart button and opens the chart in a modal.

**Features**

* Reusable size charts — build a labelled table once and reuse it across products.
* Assign a chart per product from the Product data → Size guide panel.
* Accessible native `<dialog>` modal — keyboard operable, focus-managed, screen-reader friendly.
* Set the button label and the modal title.
* Themeable, responsive output with no layout shift; respects reduced-motion and dark mode.
* Graceful by design — nothing renders when a product has no chart assigned.
* Fully self-contained: no external services, no tracking.

== Installation ==

1. Upload the plugin to `/wp-content/plugins/sizer`, or install via Plugins → Add New.
2. Activate it. WooCommerce must be active.
3. Go to WooCommerce → Size Guides to create a chart and set the button label.
4. Assign a chart on a product (Product data → Size guide).

== Frequently Asked Questions ==

= Does it require WooCommerce? =

Yes. Sizer extends WooCommerce single product pages.

= Where does the size guide appear? =

On the single product page, as a button shown after the add-to-cart button. The button opens the chart in an accessible modal.

= Can I override the styling? =

Yes. Templates can be overridden from your theme under a `sizer/` folder, and the storefront CSS exposes custom properties you can re-theme.

== Screenshots ==

1. The size guide modal on a product page.
2. Building a reusable size chart in the admin.

== Changelog ==

= 0.1.0 =
* Initial release: reusable size charts, per-product assignment, and an accessible modal shown after the add-to-cart button.
