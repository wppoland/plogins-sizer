<?php
/**
 * PRO upsell content, generated from the plogins.com registry by
 * scripts/gen-pro-upsell.mjs. The admin upsell renders this; curate the
 * feature list to fit this plugin's settings screen (do not invent features).
 *
 * @package plogins-sizer-pro
 */

defined('ABSPATH') || exit;

return [
    'name'       => 'Sizer Pro',
    'url'        => 'https://plogins.com/plogins-sizer-pro/pricing/',
    'sellable'   => true,
    'price_from' => 29,
    'currency'   => 'EUR',
    'price_pln'  => 129,
    'lead'       => [
        'en' => 'The 0.4.0 release completes the Track 3 roadmap wedge list.',
        'pl' => 'Wydanie 0.4.0 dostarcza pełny zestaw funkcji roadmapy Track 3.',
    ],
    'features'   => [
        [
            'en' => ['title' => 'Store-wide default chart', 'desc' => 'Fallback chart for products with no per-product or category assignment (shipped).'],
            'pl' => ['title' => 'Domyślna tabela rozmiarów', 'desc' => 'Tabela zapasowa dla produktów bez własnego przypisania (wdrożone).'],
        ],
        [
            'en' => ['title' => 'Per-variation charts', 'desc' => 'Show a different chart depending on the variation the shopper selects (shipped).'],
            'pl' => ['title' => 'Tabele per wariant', 'desc' => 'Pokaz innej tabeli zależnie od wariantu wybranego przez klienta (wdrożone).'],
        ],
        [
            'en' => ['title' => 'Unit switching', 'desc' => 'Toggle the chart between cm and inch with one control (shipped).'],
            'pl' => ['title' => 'Przełączanie jednostek', 'desc' => 'Zmiana tabeli między cm a calami jednym przełącznikiem (wdrożone).'],
        ],
        [
            'en' => ['title' => 'Find my size', 'desc' => 'Measurement form that suggests a size from the chart (shipped).'],
            'pl' => ['title' => 'Znajdź mój rozmiar', 'desc' => 'Formularz pomiarów sugerujący rozmiar na podstawie tabeli (wdrożone).'],
        ],
        [
            'en' => ['title' => 'Import / export', 'desc' => 'JSON backup for all charts or CSV for a single chart (shipped).'],
            'pl' => ['title' => 'Import / eksport', 'desc' => 'Backup JSON wszystkich tabel lub CSV pojedynczej tabeli (wdrożone).'],
        ],
    ],
];
