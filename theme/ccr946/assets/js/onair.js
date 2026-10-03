let scheduleInterval = null;

function initOnair() {
	const SILENCE = 'Off air - back soon!';
	const TIME_PLACEHOLDER = '-- : --';
	const player = document.getElementById('player');

	if (!player) {
		return;
	}

	let events = [];

	try {
		events = JSON.parse(player.dataset.events || '[]');
	} catch (error) {
		console.error('Unable to read schedule events.', error);
		return;
	}

	if (!Array.isArray(events)) {
		return;
	}

	const track = document.getElementById('player-track');

	if (!track) {
		return;
	}

	const heroTrack = document.getElementById('hero-track');

	const onairTime = document.getElementById('onair-time');
	const onairTrack = document.getElementById('onair-track');
	const nextTime = document.getElementById('next-time');
	const nextTrack = document.getElementById('next-track');

	function getDublinDateTime() {
		const formatter = new Intl.DateTimeFormat('en-CA', {
			timeZone: 'Europe/Dublin',
			year: 'numeric',
			month: '2-digit',
			day: '2-digit',
			hour: '2-digit',
			minute: '2-digit',
			second: '2-digit',
			hour12: false,
		});

		const parts = formatter.formatToParts(new Date());

		const values = {};

		parts.forEach((part) => {
			if (part.type !== 'literal') {
				values[part.type] = part.value;
			}
		});

		return {
			date: `${values.year}-${values.month}-${values.day}`,
			time: `${values.hour}:${values.minute}:${values.second}`,
		};
	}

	/*
	 * Find current and next events
	 */

	function getScheduleState() {
		const now = getDublinDateTime();

		const currentTime = now.time;

		let currentEvent = null;
		let nextEvent = null;

		events.forEach((event) => {
			if (event.start_time <= currentTime && currentTime < event.end_time) {
				currentEvent = event;
			}

			if (event.start_time > currentTime && nextEvent === null) {
				nextEvent = event;
			}
		});

		return {
			current: currentEvent,
			next: nextEvent,
		};
	}

	/*
	 * Update Player
	 */

	function updatePlayer(state) {
		const newTitle = state.current ? state.current.title : SILENCE;

		if (track.textContent !== newTitle) {
			track.textContent = newTitle;
		}
	}

	function updateHeroSection(state) {
		const newTitle = state.current ? state.current.title : SILENCE;

		if (heroTrack.textContent !== newTitle) {
			heroTrack.textContent = newTitle;
		}
	}

	function updateOnAirSection(state) {
		const currentTitle = state.current ? state.current.title : SILENCE;
		if (onairTrack.textContent !== currentTitle) {
			onairTrack.textContent = currentTitle;
		}

		const nextTitle = state.next ? state.next.title : '';
		if (nextTrack.textContent !== nextTitle) {
			nextTrack.textContent = nextTitle;
		}

		const currentTime = state.current
			? `${state.current.start_time.substring(0, 5)} - ${state.current.end_time.substring(0, 5)}`
			: TIME_PLACEHOLDER;
		if (onairTime.textContent !== currentTime) {
			onairTime.textContent = currentTime;
		}

		const nextTimeValue = state.next ? `${state.next.start_time.substring(0, 5)}` : '';
		if (nextTime.textContent !== nextTimeValue) {
			nextTime.textContent = nextTimeValue;
		}
	}

	/*
	 * Update everything
	 */

	function updateSchedule() {
		const state = getScheduleState();

		updatePlayer(state);

		if (heroTrack) {
			updateHeroSection(state);
		}

		if (onairTime && onairTrack && nextTime && nextTrack) {
			updateOnAirSection(state);
		}
		/*
		 * Later:
		 *
		 * updateHero(state);
		 * updateOnAir(state);
		 */
	}

	if (scheduleInterval !== null) {
		clearInterval(scheduleInterval);
	}

	/*
	 * Initial update
	 */

	updateSchedule();

	/*
	 * Check every 30 seconds
	 */

	setInterval(updateSchedule, 30000);
}

document.addEventListener('DOMContentLoaded', initOnair);
document.addEventListener('ccr:page-loaded', initOnair);
