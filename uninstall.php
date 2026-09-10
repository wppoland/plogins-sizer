<?php
/**
 * Sizer uninstall routine.
 *
 * Removes plugin options when the user deletes the plugin. Per-product
 * assignments live in post meta; we leave those alone so a reinstall keeps
 * existing assignments, but the charts and settings are removed.
 *
 * @package Sizer
 */

defined('WP_UNINSTALL_PLUGIN') || exit;

delete_option('sizer_settings');
delete_option('sizer_charts');
delete_option('sizer_db_version');

// The PRO banner's dismissal is stored per user, so it belongs to the
// plugin rather than to the site content. User meta is global, not
// per-site, which is why this uses delete_metadata's \$delete_all rather
// than a loop over the users of one blog.
delete_metadata('user', 0, 'sizer_pro_banner_dismissed', '', true);
