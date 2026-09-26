<?php
/**
 * Default settings, stored under the option key `sizer_settings`.
 *
 * @package Sizer
 *
 * @return array<string, mixed>
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

return [
    // Both customer-facing strings below are empty on purpose. A value here is
    // written into the option at activation and can never be translated, because
    // a config array is not a gettext call, so the packaged English survived even
    // a complete language pack. Empty means "use Sizer\Service\Texts", which is
    // translated; anything a merchant types still wins. An empty `modal_title`
    // additionally reuses the resolved link wording, as the settings screen says.
    'trigger_label' => '',
    'modal_title'   => '',
];
