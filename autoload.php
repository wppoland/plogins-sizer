<?php
/**
 * Autoloading: prefer Composer's vendor autoloader (the optimized classmap when
 * present). Fall back to a minimal PSR-4 autoloader so the plugin still boots if
 * vendor/ is somehow absent. Sizer is fully self-contained — no runtime deps.
 *
 * @package Sizer
 */

declare(strict_types=1);

namespace Sizer;

defined('ABSPATH') || exit;

$sizer_composer = __DIR__ . '/vendor/autoload.php';
if (is_readable($sizer_composer)) {
    require_once $sizer_composer;
    return;
}

spl_autoload_register(static function (string $class): void {
    $prefix  = 'Sizer\\';
    $base_dir = __DIR__ . '/src/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative = substr($class, $len);
    $file     = $base_dir . str_replace('\\', '/', $relative) . '.php';
    if (is_readable($file)) {
        require_once $file;
    }
});
