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
 */
final class SizeGuideService implements HasHooks
{
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
     * Render the trigger button plus, once, the dialog markup.
     */
    public function renderTrigger(): void
    {
        $product = $this->currentProduct();
        if (! $product instanceof \WC_Product) {
            return;
        }

        $chart = $this->resolver->forProduct($product);
        if (null === $chart) {
            return;
        }

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
