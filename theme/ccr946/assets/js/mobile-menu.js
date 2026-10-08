document.addEventListener('DOMContentLoaded', function () {
	const button = document.querySelector('.menu-toggle');
	const menu = document.querySelector('.nav');
	const mobileMq = window.matchMedia('(max-width: 768px)');

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
		if (mobileMq.matches) {
			const parentLink = event.target.closest('.menu-item-has-children > a');

			if (parentLink) {
				event.preventDefault();

				const item = parentLink.parentElement;
				const isOpen = item.classList.toggle('is-open');
				parentLink.setAttribute('aria-expanded', isOpen);
				return;
			}
		}

		if (event.target.closest('a')) {
			closeMenu();
		}

		const link = event.target.closest('.sub-menu a');
		if (!link) return;

		const item = link.closest('.menu-item-has-children');
		item.classList.add('is-closed');

		setTimeout(() => {
			item.classList.remove('is-closed');
		}, 200);
	});

	document.addEventListener('keydown', function (event) {
		if (event.key === 'Escape') {
			closeMenu();
		}
	});
});
