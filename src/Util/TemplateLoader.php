<?php

declare(strict_types=1);

namespace Sizer\Util;

defined('ABSPATH') || exit;

use const Sizer\PLUGIN_DIR;

/**
 * Loads PHP templates with optional theme overrides.
 *
 * Lookup order: {theme}/sizer/{template}.php → {plugin}/templates/{template}.php
 */
final class TemplateLoader
{
    private const THEME_DIR = 'sizer';

    /**
     * Include a template, extracting $args as `sizer_`-prefixed locals.
     *
     * @param string               $template Template name (e.g. 'single-product/size-guide').
     * @param array<string, mixed> $args     Variables exposed to the template.
     */
    public function render(string $template, array $args = []): void
    {
        $path = $this->locate($template);

        if (null === $path) {
            return;
        }

        $scoped = [];
        foreach ($args as $key => $value) {
            if (! is_string($key) || '' === $key) {
                continue;
            }
            $scoped[str_starts_with($key, 'sizer_') ? $key : 'sizer_' . $key] = $value;
        }

        unset($args, $key, $value);

        extract($scoped, EXTR_SKIP); // phpcs:ignore WordPress.PHP.DontExtract.extract_extract

        include $path;
    }

    /**
     * Resolve the absolute path of a template, or null when not found.
     */
    public function locate(string $template): ?string
    {
        $template = ltrim($template, '/');

        if (! str_ends_with($template, '.php')) {
            $template .= '.php';
        }

        $theme_path = locate_template(self::THEME_DIR . '/' . $template);
        if ('' !== $theme_path) {
            return $theme_path;
        }

        $plugin_path = PLUGIN_DIR . '/templates/' . $template;

        return file_exists($plugin_path) ? $plugin_path : null;
    }
}
