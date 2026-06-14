<?php
/**
 * Sizer uninstall routine.
 *
 * Removes plugin options when the user deletes the plugin. Per-product and
 * per-category assignments live in post/term meta; we leave those alone so a
 * reinstall keeps existing assignments, but the charts and settings are removed.
 *
 * @package Sizer
 */

defined('WP_UNINSTALL_PLUGIN') || exit;

delete_option('sizer_settings');
delete_option('sizer_charts');
delete_option('sizer_db_version');
