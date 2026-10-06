document.addEventListener('DOMContentLoaded', function () {
	const button = document.querySelector('.menu-toggle');
	const menu = document.querySelector('.nav');

	if (!button || !menu) return;

	function closeMenu() {
		menu.classList.remove('is-open');
		button.setAttribute('aria-expanded', 'false');
		button.setAttribute('aria-label', 'Open navigation menu');
	}

	button.addEventListener('click', function () {
		const isOpen = menu.classList.toggle('is-open');

		button.setAttribute('aria-expanded', String(isOpen));
		button.setAttribute('aria-label', isOpen ? 'Close navigation menu' : 'Open navigation menu');
	});

	menu.addEventListener('click', function (event) {
		if (event.target.closest('a')) {
			closeMenu();
		}
	});

	document.addEventListener('keydown', function (event) {
		if (event.key === 'Escape') {
			closeMenu();
		}
	});
});
