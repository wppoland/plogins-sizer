<?php

declare(strict_types=1);

namespace Sizer\Service;

defined('ABSPATH') || exit;

/**
 * The customer-facing strings a merchant may override, in the language of the
 * site.
 *
 * They used to be English sentences in config/defaults.php, written into
 * `sizer_settings` at activation. A string in a config array is never wrapped in
 * a gettext call, so it is not in the .pot and cannot be translated, and once it
 * is in the option even a complete language pack cannot reach it. Settings
 * already carried a `__()` fallback next to the key, which looked like the
 * problem was handled; it could never fire, because the key was always present
 * and never empty.
 *
 * The packaged default is now empty, meaning "use the string below". A merchant
 * who types their own still wins, and what they typed is stored as typed.
 */
final class Texts
{
    /**
     * Setting key => the translated default.
     *
     * `modal_title` is deliberately absent: its documented default is not a
     * literal, it is "reuse the link wording", which apply() resolves below.
     *
     * @return array<string, string>
     */
    public static function defaults(): array
    {
        return [
            'trigger_label' => __('Size guide', 'plogins-sizer'),
        ];
    }

    /**
     * Fill every empty text key with its translated default.
     *
     * Applied on the way OUT, where the string is about to be shown, and never
     * on the way in: writing the resolved text back to the option would freeze
     * one language into the database, which is the bug this class exists to fix.
     *
     * @param array<string, mixed> $settings
     * @return array<string, mixed>
     */
    public static function apply(array $settings): array
    {
        foreach (self::defaults() as $key => $text) {
            if ('' === trim((string) ($settings[$key] ?? ''))) {
                $settings[$key] = $text;
            }
        }

        // A blank pop-up heading reuses the link wording, which the settings
        // screen promises and which is resolved (and translated) by now.
        if ('' === trim((string) ($settings['modal_title'] ?? ''))) {
            $settings['modal_title'] = (string) ($settings['trigger_label'] ?? '');
        }

        return $settings;
    }
}
