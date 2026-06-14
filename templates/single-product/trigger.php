<?php
/**
 * The size-guide trigger (button or link) that opens the dialog.
 *
 * @var string $sizer_dialog_id Target dialog element id.
 * @var string $sizer_label     Visible trigger text.
 * @var string $sizer_style     'button' or 'link'.
 *
 * @package Sizer/Templates
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

$sizer_dialog_id = isset($sizer_dialog_id) ? (string) $sizer_dialog_id : '';
$sizer_label     = isset($sizer_label) ? (string) $sizer_label : '';
$sizer_style     = isset($sizer_style) && 'link' === $sizer_style ? 'link' : 'button';

if ('' === $sizer_dialog_id) {
    return;
}
?>
<button
    type="button"
    class="sizer-trigger sizer-trigger--<?php echo esc_attr($sizer_style); ?>"
    data-sizer-open="<?php echo esc_attr($sizer_dialog_id); ?>"
    aria-haspopup="dialog"
    aria-controls="<?php echo esc_attr($sizer_dialog_id); ?>"
>
    <svg class="sizer-trigger__icon" width="16" height="16" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
        <path fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18M7 4v3m5-3v6m5-6v3" />
    </svg>
    <span class="sizer-trigger__label"><?php echo esc_html($sizer_label); ?></span>
</button>
