<?php

declare(strict_types=1);

namespace Sizer\Repository;

defined('ABSPATH') || exit;

/**
 * Persists reusable size charts in a single autoloaded option.
 *
 * A chart is a labelled table:
 *   - id:      string slug-like identifier (unique)
 *   - name:    string admin/customer-facing name
 *   - caption: string optional caption shown below the table
 *   - columns: list<string> column headers
 *   - rows:    list<list<string>> cell values, each row aligned to columns
 *
 * @phpstan-type Chart array{id: string, name: string, caption: string, columns: list<string>, rows: list<list<string>>}
 */
final class ChartRepository
{
    private const OPTION = 'sizer_charts';

    /**
     * Return every stored chart, keyed by id.
     *
     * @return array<string, array{id: string, name: string, caption: string, columns: list<string>, rows: list<list<string>>}>
     */
    public function all(): array
    {
        $raw = get_option(self::OPTION, []);

        if (! is_array($raw)) {
            return [];
        }

        $charts = [];
        foreach ($raw as $chart) {
            if (! is_array($chart) || ! isset($chart['id'])) {
                continue;
            }
            $normalised       = $this->normalise($chart);
            $normalised['id'] = $this->uniqueId($normalised['id'], $charts);
            $charts[$normalised['id']] = $normalised;
        }

        return $charts;
    }

    /**
     * Find a single chart by id.
     *
     * @return array{id: string, name: string, caption: string, columns: list<string>, rows: list<list<string>>}|null
     */
    public function find(string $id): ?array
    {
        $charts = $this->all();

        return $charts[$id] ?? null;
    }

    /**
     * Persist the full set of charts, replacing whatever is stored.
     *
     * @param array<int|string, array<string, mixed>> $charts Charts to store.
     */
    public function save(array $charts): void
    {
        // Two charts whose names slug down to the same key, a men's and a women's
        // "T-shirts", or "Summer tops" next to "Summer Tops", used to end up with
        // the same id. Both rows were stored, but every read keys by id, so the
        // later chart swallowed the earlier one: the merchant saved two charts and
        // found one on reload, and shoppers on the product still holding that id
        // were shown the other chart's measurements. Ids already in the option are
        // what products point at, so those keep their key and only the newcomer
        // moves to the next free one.
        $reserved = array_fill_keys(array_keys($this->all()), true);

        $clean = [];
        $used  = [];
        foreach ($charts as $chart) {
            if (! is_array($chart)) {
                continue;
            }
            $normalised = $this->normalise($chart);
            if ('' === $normalised['id'] || '' === $normalised['name']) {
                continue;
            }
            $taken            = isset($reserved[$normalised['id']]) ? $used : $used + $reserved;
            $normalised['id'] = $this->uniqueId($normalised['id'], $taken);

            $used[$normalised['id']] = true;
            $clean[]                 = $normalised;
        }

        update_option(self::OPTION, $clean, false);
    }

    /**
     * Return $id, or the first free "$id-2", "$id-3" variant when it is already taken.
     *
     * @param array<string, mixed> $taken Map of ids already in use.
     */
    private function uniqueId(string $id, array $taken): string
    {
        if (! isset($taken[$id])) {
            return $id;
        }

        $suffix = 2;
        while (isset($taken[$id . '-' . $suffix])) {
            $suffix++;
        }

        return $id . '-' . $suffix;
    }

    /**
     * Build the list of {id => name} pairs for select controls.
     *
     * @return array<string, string>
     */
    public function choices(): array
    {
        $choices = [];
        foreach ($this->all() as $chart) {
            $choices[$chart['id']] = $chart['name'];
        }

        return $choices;
    }

    /**
     * Coerce raw chart data into the canonical, fully-sanitised shape.
     *
     * @param array<string, mixed> $chart Raw chart data.
     * @return array{id: string, name: string, caption: string, columns: list<string>, rows: list<list<string>>}
     */
    public function normalise(array $chart): array
    {
        $name = isset($chart['name']) ? sanitize_text_field((string) $chart['name']) : '';

        $id = isset($chart['id']) ? sanitize_key((string) $chart['id']) : '';
        if ('' === $id && '' !== $name) {
            $id = sanitize_key($name);
        }
        if ('' === $id) {
            $id = 'chart-' . substr((string) wp_hash($name . wp_rand()), 0, 8);
        }

        $columns = [];
        if (isset($chart['columns']) && is_array($chart['columns'])) {
            foreach ($chart['columns'] as $col) {
                $columns[] = sanitize_text_field((string) $col);
            }
        }

        $rows = [];
        if (isset($chart['rows']) && is_array($chart['rows'])) {
            foreach ($chart['rows'] as $row) {
                if (! is_array($row)) {
                    continue;
                }
                $cells = [];
                foreach ($row as $cell) {
                    $cells[] = sanitize_text_field((string) $cell);
                }
                // Skip fully-empty rows.
                if ('' !== implode('', $cells)) {
                    $rows[] = $cells;
                }
            }
        }

        return [
            'id'      => $id,
            'name'    => $name,
            'caption' => isset($chart['caption']) ? sanitize_text_field((string) $chart['caption']) : '',
            'columns' => $columns,
            'rows'    => $rows,
        ];
    }
}
