<?php
/**
 * The size guide must render once per product, whether or not WooCommerce
 * prints an add-to-cart form.
 *
 * Up to 1.1.3 the trigger hung only on woocommerce_after_add_to_cart_button.
 * WooCommerce skips the whole add-to-cart form for a product that is out of
 * stock or has no price, so those products showed no size guide at all. The
 * summary hook added in 1.1.4 covers them; on a block template it fires before
 * the add-to-cart block, so for an in-stock product it must stay silent and
 * leave the trigger to the button hook, or the page gets two.
 *
 * Run: php tests/size-guide-render-check.php
 *
 * @package Sizer
 */

declare(strict_types=1);

namespace Sizer {
    const PLUGIN_DIR = __DIR__ . '/fixture-size-guide';
}

namespace {
    define('ABSPATH', __DIR__ . '/');

    // Stub templates: the check counts triggers, not markup.
    $dir = \Sizer\PLUGIN_DIR;
    @mkdir($dir . '/templates/single-product', 0777, true);
    @mkdir($dir . '/config', 0777, true);
    file_put_contents($dir . '/templates/single-product/trigger.php', '<?php echo "[trigger]";');
    file_put_contents($dir . '/templates/single-product/dialog.php', '<?php echo "[dialog]";');
    copy(__DIR__ . '/../config/defaults.php', $dir . '/config/defaults.php');
    register_shutdown_function(static function () use ($dir): void {
        array_map('unlink', array_merge(glob($dir . '/templates/single-product/*'), glob($dir . '/config/*')));
        rmdir($dir . '/templates/single-product');
        rmdir($dir . '/templates');
        rmdir($dir . '/config');
        rmdir($dir);
    });

    $GLOBALS['hooks'] = [];
    function add_action(string $hook, callable $cb, int $priority = 10): void
    {
        $GLOBALS['hooks'][$hook][$priority][] = $cb;
    }
    function do_action(string $hook): void
    {
        $byPriority = $GLOBALS['hooks'][$hook] ?? [];
        ksort($byPriority);
        foreach ($byPriority as $cbs) {
            foreach ($cbs as $cb) {
                $cb();
            }
        }
    }
    function apply_filters(string $hook, mixed $value): mixed
    {
        return $value;
    }
    function get_option(string $name, mixed $default = false): mixed
    {
        return 'sizer_charts' === $name
            ? [['id' => 'tees', 'name' => 'Tees', 'caption' => '', 'columns' => ['Size'], 'rows' => [['M']]]]
            : $default;
    }
    function get_post_meta(int $id, string $key, bool $single): string
    {
        return 'tees';
    }
    function __(string $text, string $domain = ''): string
    {
        return $text;
    }
    function sanitize_text_field(string $s): string
    {
        return trim($s);
    }
    function sanitize_key(string $s): string
    {
        return strtolower($s);
    }
    function wp_hash(string $s): string
    {
        return md5($s);
    }
    function wp_rand(): int
    {
        return 4;
    }
    function locate_template(string $name): string
    {
        return '';
    }
    function wp_enqueue_style(string $h): void
    {
    }
    function wp_enqueue_script(string $h): void
    {
    }

    class WC_Product
    {
        public function __construct(private int $id, private bool $purchasable, private bool $inStock)
        {
        }
        public function get_id(): int
        {
            return $this->id;
        }
        public function is_purchasable(): bool
        {
            return $this->purchasable;
        }
        public function is_in_stock(): bool
        {
            return $this->inStock;
        }
    }

    spl_autoload_register(static function (string $class): void {
        if (str_starts_with($class, 'Sizer\\')) {
            $file = __DIR__ . '/../src/' . str_replace('\\', '/', substr($class, 6)) . '.php';
            if (is_file($file)) {
                require $file;
            }
        }
    });

    $failed = 0;

    /**
     * Render one product page and count triggers.
     *
     * @param list<string> $order Hooks in the order the template fires them.
     */
    $page = static function (string $label, WC_Product $p, array $order, int $want) use (&$failed): void {
        $GLOBALS['hooks']   = [];
        $GLOBALS['product'] = $p;
        $service = new \Sizer\Service\SizeGuideService(
            new \Sizer\Service\Settings(),
            new \Sizer\Service\ChartResolver(new \Sizer\Repository\ChartRepository()),
            new \Sizer\Util\TemplateLoader(),
        );
        $service->registerHooks();

        ob_start();
        foreach ($order as $hook) {
            do_action($hook);
        }
        $got = substr_count((string) ob_get_clean(), '[trigger]');

        if ($got === $want) {
            printf("ok   %s: %d trigger(s)\n", $label, $got);
        } else {
            fwrite(STDERR, sprintf("FAIL %s: %d trigger(s), expected %d\n", $label, $got, $want));
            $failed++;
        }
    };

    $btn     = 'woocommerce_after_add_to_cart_button';
    $summary = 'woocommerce_single_product_summary';

    // Classic template: summary at 30 prints the form (and the button hook), then 31.
    $page('classic, in stock', new WC_Product(10, true, true), [$btn, $summary], 1);
    $page('classic, out of stock (no form)', new WC_Product(11, true, false), [$summary], 1);
    $page('classic, no price (no form)', new WC_Product(12, false, true), [$summary], 1);
    // Block template: summary fires before the add-to-cart block.
    $page('block, in stock', new WC_Product(13, true, true), [$summary, $btn], 1);
    $page('block, out of stock (no form)', new WC_Product(14, true, false), [$summary], 1);
    // A form printed anyway for a product the fallback also matches must not double up.
    $page('form plus fallback', new WC_Product(15, false, false), [$btn, $summary], 1);

    exit($failed > 0 ? 1 : 0);
}
