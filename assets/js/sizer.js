/**
 * Sizer storefront behaviour.
 *
 * Opens/closes the native <dialog> size guide with graceful focus management and
 * keyboard support. Falls back to a basic show/hide if <dialog> is unsupported.
 * No dependencies.
 */
(function () {
	'use strict';

	function openDialog(dialog, trigger) {
		if (!dialog) {
			return;
		}

		dialog.__sizerOpener = trigger || null;

		if (typeof dialog.showModal === 'function') {
			dialog.showModal();
		} else {
			// Legacy fallback.
			dialog.setAttribute('open', '');
			dialog.style.display = 'block';
		}

		var focusable = dialog.querySelector('[data-sizer-close]');
		if (focusable) {
			focusable.focus();
		}
	}

	function closeDialog(dialog) {
		if (!dialog) {
			return;
		}

		if (typeof dialog.close === 'function') {
			dialog.close();
		} else {
			dialog.removeAttribute('open');
			dialog.style.display = 'none';
		}

		if (dialog.__sizerOpener && typeof dialog.__sizerOpener.focus === 'function') {
			dialog.__sizerOpener.focus();
		}
	}

	document.addEventListener('click', function (event) {
		var opener = event.target.closest('[data-sizer-open]');
		if (opener) {
			event.preventDefault();
			var id = opener.getAttribute('data-sizer-open');
			openDialog(document.getElementById(id), opener);
			return;
		}

		var closer = event.target.closest('[data-sizer-close]');
		if (closer) {
			event.preventDefault();
			closeDialog(closer.closest('dialog'));
			return;
		}

		// Click on the backdrop (the dialog element itself, outside its inner box).
		if (event.target.matches('dialog.sizer-dialog')) {
			var rect = event.target.querySelector('.sizer-dialog__inner');
			if (rect) {
				var box = rect.getBoundingClientRect();
				var outside =
					event.clientX < box.left ||
					event.clientX > box.right ||
					event.clientY < box.top ||
					event.clientY > box.bottom;
				if (outside) {
					closeDialog(event.target);
				}
			}
		}
	});

	// Native <dialog> already closes on Escape and restores nothing; make sure
	// focus returns to the opener in that case too.
	document.addEventListener('close', function (event) {
		if (event.target && event.target.classList && event.target.classList.contains('sizer-dialog')) {
			var opener = event.target.__sizerOpener;
			if (opener && typeof opener.focus === 'function') {
				opener.focus();
			}
		}
	}, true);
})();
