<?php

declare(strict_types=1);

namespace Sizer\Service;

defined('ABSPATH') || exit;

/**
 * Typed accessor over the `sizer_settings` option. Falls back to bundled
 * defaults so callers never have to guard against missing keys.
 */
final class Settings
{
    public const OPTION = 'sizer_settings';

    /** @var array<string, mixed>|null */
    private ?array $cache = null;

    /**
     * Trigger styles available for the storefront entry point.
     *
     * @return array<string, string>
     */
    public static function triggerStyles(): array
    {
        return [
            'button' => __('Button', 'sizer'),
            'link'   => __('Text link', 'sizer'),
        ];
    }

    /**
     * Placement options: where the size guide appears on the product page.
     *
     * @return array<string, string>
     */
    public static function placements(): array
    {
        return [
            'after_cart'  => __('After the add-to-cart button', 'sizer'),
            'before_cart' => __('Before the add-to-cart button', 'sizer'),
            'summary'     => __('In the product summary', 'sizer'),
            'meta'        => __('In the product meta area', 'sizer'),
            'tab'         => __('As a product tab (no modal)', 'sizer'),
        ];
    }

    /**
     * All settings, merged over defaults.
     *
     * @return array<string, mixed>
     */
    public function all(): array
    {
        if (null !== $this->cache) {
            return $this->cache;
        }

        /** @var array<string, mixed> $defaults */
        $defaults = require \Sizer\PLUGIN_DIR . '/config/defaults.php';

        $stored = get_option(self::OPTION, []);
        if (! is_array($stored)) {
            $stored = [];
        }

        return $this->cache = array_merge($defaults, $stored);
    }

    public function triggerStyle(): string
    {
        $value = (string) ($this->all()['trigger_style'] ?? 'button');

        return array_key_exists($value, self::triggerStyles()) ? $value : 'button';
    }

    public function placement(): string
    {
        $value = (string) ($this->all()['placement'] ?? 'after_cart');

        return array_key_exists($value, self::placements()) ? $value : 'after_cart';
    }

    public function triggerLabel(): string
    {
        $label = trim((string) ($this->all()['trigger_label'] ?? ''));

        return '' !== $label ? $label : __('Size guide', 'sizer');
    }

    public function modalTitle(): string
    {
        $title = trim((string) ($this->all()['modal_title'] ?? ''));

        return '' !== $title ? $title : $this->triggerLabel();
    }
}
