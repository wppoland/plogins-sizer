<?php
/**
 * Default settings, stored under the option key `sizer_settings`.
 *
 * @package Sizer
 *
 * @return array<string, mixed>
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

return [
    'trigger_style' => 'button',
    'placement'     => 'after_cart',
    'trigger_label' => 'Size guide',
    'modal_title'   => 'Size guide',
];
