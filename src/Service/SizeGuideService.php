<?php

declare(strict_types=1);

namespace Sizer\Service;

defined('ABSPATH') || exit;

use Sizer\Contract\HasHooks;
use Sizer\Plugin;
use Sizer\Util\TemplateLoader;

/**
 * Front-end size-guide rendering for single product pages.
 *
 * Injects a trigger after the add-to-cart button that opens an accessible native
 * <dialog> modal containing the assigned size chart. Renders nothing when no
 * chart applies to the product (graceful empty state).
 *
 * WooCommerce prints no add-to-cart form for a product that is out of stock or
 * has no price, so that hook never fires there. A second hook in the product
 * summary covers those products, which is exactly when a shopper still wants to
 * know whether a size would fit.
 */
final class SizeGuideService implements HasHooks
{
    /** @var array<int, true> Products whose trigger is already on the page. */
    private array $rendered = [];

    public function __construct(
        private readonly Settings $settings,
        private readonly ChartResolver $resolver,
        private readonly TemplateLoader $templates,
    ) {
    }

    public function registerHooks(): void
    {
        add_action('wp_enqueue_scripts', [$this, 'registerAssets']);
        add_action('woocommerce_after_add_to_cart_button', [$this, 'renderTrigger'], 15);
        add_action('woocommerce_single_product_summary', [$this, 'renderWithoutCartForm'], 31);
    }

    /**
     * Register (but do not force-enqueue) the storefront stylesheet/script.
     */
    public function registerAssets(): void
    {
        wp_register_style(
            'sizer',
            Plugin::instance()->url('assets/css/sizer.css'),
            [],
            \Sizer\VERSION,
        );

        wp_register_script(
            'sizer',
            Plugin::instance()->url('assets/js/sizer.js'),
            [],
            \Sizer\VERSION,
            ['in_footer' => true, 'strategy' => 'defer'],
        );
    }

    /**
     * Render the trigger for a product WooCommerce shows no add-to-cart form for.
     *
     * Block templates fire this summary hook before the add-to-cart block, so a
     * purchasable, in-stock product is left to renderTrigger().
     */
    public function renderWithoutCartForm(): void
    {
        $product = $this->currentProduct();
        if (! $product instanceof \WC_Product || ($product->is_purchasable() && $product->is_in_stock())) {
            return;
        }

        $this->renderTrigger();
    }

    /**
     * Render the trigger button plus, once, the dialog markup.
     */
    public function renderTrigger(): void
    {
        $product = $this->currentProduct();
        if (! $product instanceof \WC_Product || isset($this->rendered[$product->get_id()])) {
            return;
        }

        $chart = $this->resolver->forProduct($product);
        if (null === $chart) {
            return;
        }

        $this->rendered[$product->get_id()] = true;

        wp_enqueue_style('sizer');
        wp_enqueue_script('sizer');

        $dialog_id = 'sizer-dialog-' . $product->get_id();

        $this->templates->render('single-product/trigger', [
            'dialog_id' => $dialog_id,
            'label'     => $this->settings->triggerLabel(),
        ]);

        $this->templates->render('single-product/dialog', [
            'dialog_id' => $dialog_id,
            'title'     => $this->settings->modalTitle(),
            'chart'     => $chart,
        ]);
    }

    private function currentProduct(): ?\WC_Product
    {
        global $product;

        if ($product instanceof \WC_Product) {
            return $product;
        }

        $resolved = wc_get_product(get_the_ID());

        return $resolved instanceof \WC_Product ? $resolved : null;
    }
}
