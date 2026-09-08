<?php

declare(strict_types=1);

namespace Sizer;

defined('ABSPATH') || exit;

/**
 * Idempotent schema/version migrations, run on every boot. Compares a stored
 * option against VERSION and applies forward steps as needed.
 */
final class Migrator
{
    private const OPTION   = 'sizer_db_version';
    private const SETTINGS = 'sizer_settings';

    /**
     * The English strings that shipped as packaged defaults up to 1.0.9 and were
     * written into the option at activation.
     *
     * @var array<string, string>
     */
    private const LEGACY_TEXTS = [
        'trigger_label' => 'Size guide',
        'modal_title'   => 'Size guide',
    ];

    public function maybeMigrate(): void
    {
        $current = (string) get_option(self::OPTION, '0');

        if (version_compare($current, VERSION, '>=')) {
            return;
        }

        $this->clearUntranslatableTexts();

        update_option(self::OPTION, VERSION, false);
    }

    /**
     * Clear a stored label that is byte for byte the English default.
     *
     * Those values could never be translated: they were written into the option
     * before any language pack was consulted, so a shop running in Polish showed
     * the English "Size guide" however complete the translation was. Empty means
     * "use the translated default", which is what the settings screen already
     * promised.
     *
     * Only an exact match is cleared, so a merchant's own wording, including a
     * hand translation of the English one, survives untouched.
     */
    private function clearUntranslatableTexts(): void
    {
        $stored = get_option(self::SETTINGS, null);
        if (! is_array($stored)) {
            return;
        }

        $changed = false;
        foreach (self::LEGACY_TEXTS as $key => $legacy) {
            if (isset($stored[$key]) && (string) $stored[$key] === $legacy) {
                $stored[$key] = '';
                $changed      = true;
            }
        }

        if ($changed) {
            // null keeps the option's existing autoload flag. Passing false here
            // would quietly move the settings out of the autoloaded set on every
            // shop that took this update, which is not a change a text sweep gets
            // to make.
            update_option(self::SETTINGS, $stored, null);
        }
    }
}
