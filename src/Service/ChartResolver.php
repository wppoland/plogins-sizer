<?php

declare(strict_types=1);

namespace Sizer\Service;

defined('ABSPATH') || exit;

use Sizer\Repository\ChartRepository;

/**
 * Resolves which size chart applies to a given product.
 *
 * Precedence: an explicit per-product assignment wins; otherwise the first
 * product category (in WooCommerce's order) that has a chart assigned is used.
 */
final class ChartResolver
{
    public const PRODUCT_META = '_sizer_chart_id';
    public const TERM_META    = 'sizer_chart_id';

    public function __construct(
        private readonly ChartRepository $charts,
    ) {
    }

    /**
     * Resolve the applicable chart for a product, or null when none/disabled.
     *
     * @return array{id: string, name: string, caption: string, columns: list<string>, rows: list<list<string>>}|null
     */
    public function forProduct(\WC_Product $product): ?array
    {
        $chart_id = $this->resolveChartId($product);

        /**
         * Filter the resolved chart id for a product. PRO uses this to add
         * variation-level overrides and other targeting rules.
         *
         * @param string      $chart_id Resolved chart id ('' when none, 'none' to suppress).
         * @param \WC_Product $product  The product being viewed.
         */
        $chart_id = (string) apply_filters('sizer/resolved_chart_id', $chart_id, $product);

        if ('' === $chart_id || 'none' === $chart_id) {
            return null;
        }

        return $this->charts->find($chart_id);
    }

    /**
     * Resolve the raw chart id assigned to a product (product meta, then category).
     */
    private function resolveChartId(\WC_Product $product): string
    {
        $product_id = $product->get_id();

        $assigned = (string) get_post_meta($product_id, self::PRODUCT_META, true);
        if ('' !== $assigned) {
            return $assigned;
        }

        // 'none' on the product explicitly suppresses any category fallback.
        $terms = get_the_terms($product_id, 'product_cat');
        if (is_array($terms)) {
            foreach ($terms as $term) {
                if (! $term instanceof \WP_Term) {
                    continue;
                }
                $term_chart = (string) get_term_meta($term->term_id, self::TERM_META, true);
                if ('' !== $term_chart) {
                    return $term_chart;
                }
            }
        }

        return '';
    }
}
