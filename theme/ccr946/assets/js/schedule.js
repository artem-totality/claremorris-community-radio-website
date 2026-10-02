function initSchedule() {
	const tabs = document.querySelectorAll('.day-tabs__tab');
	const panels = document.querySelectorAll('.day-panel');

	if (!tabs.length || !panels.length) {
		return;
	}

	tabs.forEach((tab) => {
		tab.addEventListener('click', () => {
			const day = tab.dataset.day;

			tabs.forEach((item) => {
				item.classList.remove('day-tabs__tab--active');
				item.setAttribute('aria-selected', 'false');
			});

			panels.forEach((panel) => {
				panel.classList.remove('day-panel--active');
			});

			tab.classList.add('day-tabs__tab--active');
			tab.setAttribute('aria-selected', 'true');

			const panel = document.querySelector(`.day-panel[data-panel="${day}"]`);

			if (panel) {
				panel.classList.add('day-panel--active');
			}
		});
	});
}

document.addEventListener('DOMContentLoaded', initSchedule);
document.addEventListener('ccr:page-loaded', initSchedule);
