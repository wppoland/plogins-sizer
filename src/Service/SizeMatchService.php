<?php

declare(strict_types=1);

namespace Sizer\Service;

use Sizer\Contract\HasHooks;

defined('ABSPATH') || exit;

/**
 * Registers the default `sizer/match_size` filter implementation.
 */
final class SizeMatchService implements HasHooks
{
    public function registerHooks(): void
    {
        add_filter('sizer/match_size', [$this, 'match'], 10, 4);
    }

    /**
     * @param array<int|string, float|int|string> $measurements
     * @param array{id: string, name: string, caption: string, columns: list<string>, rows: list<list<string>>} $chart
     */
    public function match(?string $matched, array $measurements, array $chart, \WC_Product $product): ?string
    {
        unset($product);

        if (null !== $matched && '' !== $matched) {
            return $matched;
        }

        $result = SizeMatcher::match($measurements, $chart);

        return null !== $result && '' !== $result ? $result : $matched;
    }
}
