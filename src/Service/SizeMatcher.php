<?php

declare(strict_types=1);

namespace Sizer\Service;

defined('ABSPATH') || exit;

/**
 * Matches shopper measurements against a size-chart table.
 */
final class SizeMatcher
{
    /**
     * @param array<int|string, float|int|string> $measurements Column index => value.
     * @param array{id: string, name: string, caption: string, columns: list<string>, rows: list<list<string>>} $chart
     */
    public static function match(array $measurements, array $chart): ?string
    {
        $columns = $chart['columns'] ?? [];
        $rows    = $chart['rows'] ?? [];

        if (! is_array($columns) || ! is_array($rows) || count($columns) < 2 || [] === $rows) {
            return null;
        }

        foreach ($rows as $row) {
            if (! is_array($row) || ! self::rowMatches($measurements, $row, $columns)) {
                continue;
            }

            $size = isset($row[0]) ? trim((string) $row[0]) : '';

            return '' !== $size ? $size : null;
        }

        return null;
    }

    /**
     * @param array<int|string, float|int|string> $measurements
     * @param list<string>                        $row
     * @param list<string>                        $columns
     */
    private static function rowMatches(array $measurements, array $row, array $columns): bool
    {
        $checked = 0;

        foreach ($measurements as $columnKey => $rawValue) {
            if ('' === $rawValue || null === $rawValue) {
                continue;
            }

            $columnIndex = self::resolveColumnIndex($columnKey, $columns);

            if ($columnIndex <= 0 || ! isset($row[$columnIndex])) {
                continue;
            }

            $value = is_numeric($rawValue) ? (float) $rawValue : null;

            if (null === $value) {
                continue;
            }

            ++$checked;

            if (! self::valueInRange($value, (string) $row[$columnIndex])) {
                return false;
            }
        }

        return $checked > 0;
    }

    /**
     * @param int|string       $columnKey
     * @param list<string>     $columns
     */
    private static function resolveColumnIndex(int|string $columnKey, array $columns): int
    {
        if (is_numeric($columnKey)) {
            return (int) $columnKey;
        }

        $needle = strtolower(sanitize_key((string) $columnKey));

        foreach ($columns as $index => $label) {
            if (sanitize_key((string) $label) === $needle) {
                return (int) $index;
            }
        }

        return -1;
    }

    private static function valueInRange(float $value, string $cell): bool
    {
        $cell = trim($cell);

        if ('' === $cell) {
            return false;
        }

        if (preg_match('/^(\d+(?:\.\d+)?)\s*[-–—]\s*(\d+(?:\.\d+)?)$/', $cell, $matches)) {
            return $value >= (float) $matches[1] && $value <= (float) $matches[2];
        }

        if (preg_match('/^[≤<]=?\s*(\d+(?:\.\d+)?)$/', $cell, $matches)) {
            return $value <= (float) $matches[1];
        }

        if (preg_match('/^[≥>]=?\s*(\d+(?:\.\d+)?)$/', $cell, $matches)) {
            return $value >= (float) $matches[1];
        }

        if (preg_match('/^(\d+(?:\.\d+)?)\+$/', $cell, $matches)) {
            return $value >= (float) $matches[1];
        }

        if (is_numeric($cell)) {
            $target = (float) $cell;

            return abs($value - $target) < 0.51;
        }

        return false;
    }
}
