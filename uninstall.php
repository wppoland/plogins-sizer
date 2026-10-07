<?php
/**
 * Sizavo uninstall routine.
 *
 * Removes plugin options, on every site of a network, when the user deletes
 * the plugin. Per-product assignments live in post meta; we leave those alone so a reinstall keeps
 * existing assignments, but the charts and settings are removed.
 *
 * @package Sizer
 */

defined('WP_UNINSTALL_PLUGIN') || exit;

function sizer_uninstall_cleanup(): void
{
    delete_option('sizer_settings');
    delete_option('sizer_charts');
    delete_option('sizer_db_version');
}

// Options are per site, so a network uninstall has to visit every site.
if (is_multisite()) {
    $sizer_site_ids = get_sites(['fields' => 'ids', 'number' => 0]);

    foreach ($sizer_site_ids as $sizer_site_id) {
        switch_to_blog((int) $sizer_site_id);
        sizer_uninstall_cleanup();
        restore_current_blog();
    }

    unset($sizer_site_ids, $sizer_site_id);
} else {
    sizer_uninstall_cleanup();
}

// The PRO banner's dismissal is stored per user, so it belongs to the
// plugin rather than to the site content. User meta is global, not
// per-site, which is why this uses delete_metadata's \$delete_all rather
// than a loop over the users of one blog.
delete_metadata('user', 0, 'sizer_pro_banner_dismissed', '', true);
