<?php
/**
 * The size chart rendered inline inside a WooCommerce product tab.
 *
 * @var string                                                                              $sizer_title Heading.
 * @var array{id: string, name: string, caption: string, columns: list<string>, rows: list<list<string>>} $sizer_chart Chart data.
 *
 * @package Sizer/Templates
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

$sizer_title = isset($sizer_title) ? (string) $sizer_title : '';
$sizer_chart = isset($sizer_chart) && is_array($sizer_chart) ? $sizer_chart : [];
?>
<div class="sizer-tab">
    <?php if ('' !== $sizer_title) : ?>
        <h2 class="sizer-tab__title"><?php echo esc_html($sizer_title); ?></h2>
    <?php endif; ?>
    <?php
    \Sizer\Plugin::instance()
        ->container()
        ->get(\Sizer\Util\TemplateLoader::class)
        ->render('single-product/chart-table', ['chart' => $sizer_chart]);
    ?>
</div>
