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
     * All settings, merged over defaults, with every customer-facing text
     * resolved to its translated default where the merchant left the field
     * blank. This is the rendering view; it must never be written back to the
     * option, or one language would be frozen into the database.
     *
     * @return array<string, mixed>
     */
    public function all(): array
    {
        if (null !== $this->cache) {
            return $this->cache;
        }

        return $this->cache = Texts::apply($this->raw());
    }

    /**
     * Settings exactly as stored, merged over defaults, with no text resolution.
     * The settings screen edits these, so saving the form stores what the
     * merchant typed and nothing else.
     *
     * @return array<string, mixed>
     */
    public function raw(): array
    {
        /** @var array<string, mixed> $defaults */
        $defaults = require \Sizer\PLUGIN_DIR . '/config/defaults.php';

        $stored = get_option(self::OPTION, []);
        if (! is_array($stored)) {
            $stored = [];
        }

        return array_merge($defaults, $stored);
    }

    public function triggerLabel(): string
    {
        return trim((string) ($this->all()['trigger_label'] ?? ''));
    }

    public function modalTitle(): string
    {
        return trim((string) ($this->all()['modal_title'] ?? ''));
    }
}
