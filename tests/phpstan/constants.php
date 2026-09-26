<?php
/**
 * PHPStan bootstrap: constants the plugin defines at runtime, so src/ can be
 * analysed without a running WordPress.
 */

declare(strict_types=1);

namespace {
    // Defined at runtime by the main plugin file; phpstan does not evaluate
    // those define() calls, so the ProUpsell panel would read as undefined.
    if (! defined('SIZER_DIR')) {
        define('SIZER_DIR', '/tmp/sizer/');
    }
    if (! defined('SIZER_URL')) {
        define('SIZER_URL', 'https://example.test/wp-content/plugins/sizer/');
    }
}
