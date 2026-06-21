<?php
/**
 * Boot order: services listed here are resolved from the container and have
 * their registerHooks() called during Plugin::boot(). Each must implement
 * Sizer\Contract\HasHooks. Services absent from the container (e.g. admin-only
 * services outside wp-admin) are skipped gracefully.
 *
 * @package Sizer
 *
 * @return array<class-string>
 */

declare(strict_types=1);

use Sizer\Admin\Assignment;
use Sizer\Admin\SettingsPage;
use Sizer\Service\SizeGuideService;
use Sizer\Service\SizeMatchService;

defined('ABSPATH') || exit;

return [
    SizeGuideService::class,
    SizeMatchService::class,
    SettingsPage::class,
    Assignment::class,
];
