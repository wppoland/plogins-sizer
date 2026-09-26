<?php

declare(strict_types=1);

namespace Sizer;

defined('ABSPATH') || exit;

/**
 * Seeds default settings on activation so the plugin behaves sanely out of the
 * box and the container is never resolved against an empty option set.
 */
final class Activator
{
    private const OPTION = 'sizer_settings';

    public static function activate(): void
    {
        if (false === get_option(self::OPTION, false)) {
            /** @var array<string, mixed> $defaults */
            $defaults = require PLUGIN_DIR . '/config/defaults.php';
            add_option(self::OPTION, $defaults);
        }

        // Deliberately NOT stamping sizer_db_version here. Activation runs before
        // Migrator::maybeMigrate(), so writing the current version would tell the
        // migrator there is nothing to do: on the deactivate, update, reactivate
        // path the text sweep would be skipped for good and the shop would keep
        // the frozen English label forever. Let the migrator stamp it once it has
        // actually done its work.
        (new Migrator())->maybeMigrate();
    }
}
