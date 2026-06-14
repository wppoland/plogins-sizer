<?php

declare(strict_types=1);

namespace Sizer\Service;

defined('ABSPATH') || exit;

use Sizer\Repository\ChartRepository;

/**
 * Resolves which size chart applies to a given product, based on the explicit
 * per-product assignment stored in product meta.
 */
final class ChartResolver
{
    public const PRODUCT_META = '_sizer_chart_id';

    public function __construct(
        private readonly ChartRepository $charts,
    ) {
    }

    /**
     * Resolve the applicable chart for a product, or null when none is assigned.
     *
     * @return array{id: string, name: string, caption: string, columns: list<string>, rows: list<list<string>>}|null
     */
    public function forProduct(\WC_Product $product): ?array
    {
        $chart_id = (string) get_post_meta($product->get_id(), self::PRODUCT_META, true);

        if ('' === $chart_id) {
            return null;
        }

        return $this->charts->find($chart_id);
    }
}
