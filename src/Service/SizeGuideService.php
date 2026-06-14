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
 * Depending on the configured placement, it either injects a trigger that opens
 * an accessible native <dialog> modal, or registers a dedicated product tab.
 * Renders nothing when no chart applies to the product (graceful empty state).
 */
final class SizeGuideService implements HasHooks
{
    public function __construct(
        private readonly Settings $settings,
        private readonly ChartResolver $resolver,
        private readonly TemplateLoader $templates,
    ) {
    }

    /**
     * Map a placement key to a WooCommerce single-product hook and priority.
     *
     * @return array<string, array{hook: string, priority: int}>
     */
    public static function triggerHooks(): array
    {
        return [
            'after_cart'  => ['hook' => 'woocommerce_after_add_to_cart_button', 'priority' => 15],
            'before_cart' => ['hook' => 'woocommerce_before_add_to_cart_button', 'priority' => 15],
            'summary'     => ['hook' => 'woocommerce_single_product_summary', 'priority' => 35],
            'meta'        => ['hook' => 'woocommerce_product_meta_start', 'priority' => 5],
        ];
    }

    public function registerHooks(): void
    {
        add_action('wp_enqueue_scripts', [$this, 'registerAssets']);

        $placement = $this->settings->placement();

        if ('tab' === $placement) {
            add_filter('woocommerce_product_tabs', [$this, 'addProductTab']);
            return;
        }

        $hooks  = self::triggerHooks();
        $target = $hooks[$placement] ?? $hooks['after_cart'];
        add_action($target['hook'], [$this, 'renderTrigger'], $target['priority']);
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
     * Render the trigger (button or link) plus, once, the dialog markup.
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
            'style'     => $this->settings->triggerStyle(),
        ]);

        $this->templates->render('single-product/dialog', [
            'dialog_id' => $dialog_id,
            'title'     => $this->settings->modalTitle(),
            'chart'     => $chart,
        ]);
    }

    /**
     * Append a dedicated "Size guide" product tab when so configured.
     *
     * @param array<string, array<string, mixed>> $tabs Existing product tabs.
     * @return array<string, array<string, mixed>>
     */
    public function addProductTab(array $tabs): array
    {
        $product = $this->currentProduct();
        if (! $product instanceof \WC_Product) {
            return $tabs;
        }

        $chart = $this->resolver->forProduct($product);
        if (null === $chart) {
            return $tabs;
        }

        wp_enqueue_style('sizer');

        $tabs['sizer_size_guide'] = [
            'title'    => $this->settings->triggerLabel(),
            'priority' => 25,
            'callback' => function () use ($chart): void {
                $this->templates->render('single-product/tab', [
                    'title' => $this->settings->modalTitle(),
                    'chart' => $chart,
                ]);
            },
        ];

        return $tabs;
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
