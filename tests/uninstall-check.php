<?php
/**
 * Uninstall must clear the options on every site of a network.
 *
 * Up to 1.1.3 uninstall.php called delete_option() for the current blog only,
 * so a network uninstall left the charts and settings on every other site.
 * This runs uninstall.php against a three-site network and a single site and
 * records which blog each delete_option() call landed on.
 *
 * Run: php tests/uninstall-check.php
 *
 * @package Sizer
 */

declare(strict_types=1);

define('WP_UNINSTALL_PLUGIN', 'mezuro/mezuro.php');

$GLOBALS['multisite'] = false;
$GLOBALS['blog']      = 1;
$GLOBALS['deleted']   = [];
$GLOBALS['user_meta'] = 0;

function is_multisite(): bool
{
    return $GLOBALS['multisite'];
}
function get_sites(array $args): array
{
    return ['fields' => 'ids', 'number' => 0] === $args ? [1, 2, 3] : [];
}
function switch_to_blog(int $id): void
{
    $GLOBALS['blog'] = $id;
}
function restore_current_blog(): void
{
    $GLOBALS['blog'] = 1;
}
function delete_option(string $name): void
{
    $GLOBALS['deleted'][$GLOBALS['blog']][] = $name;
}
function delete_metadata(string $type, int $id, string $key, string $value, bool $all): void
{
    $GLOBALS['user_meta']++;
}

$options = ['sizer_settings', 'sizer_charts', 'sizer_db_version'];
$failed  = 0;

$expect = static function (string $label, array $want) use (&$failed): void {
    $got = $GLOBALS['deleted'];
    ksort($got);
    if ($got === $want && 1 === $GLOBALS['user_meta']) {
        printf("ok   %s\n", $label);
        return;
    }
    fwrite(STDERR, sprintf("FAIL %s: deleted %s, user meta calls %d\n", $label, json_encode($got), $GLOBALS['user_meta']));
    $failed++;
};

// The function the uninstall file declares cannot be declared twice, so run
// the network case in a child process.
if (in_array('--single', $argv, true)) {
    require __DIR__ . '/../uninstall.php';
    $expect('single site', [1 => $options]);
    exit($failed > 0 ? 1 : 0);
}

passthru(escapeshellarg(PHP_BINARY) . ' ' . escapeshellarg(__FILE__) . ' --single', $single);
$failed += $single;

$GLOBALS['multisite'] = true;
require __DIR__ . '/../uninstall.php';
$expect('network of three sites', [1 => $options, 2 => $options, 3 => $options]);

exit($failed > 0 ? 1 : 0);
