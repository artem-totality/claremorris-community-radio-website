const audio = document.getElementById('radioStream');

const headerButton = document.getElementById('playBtn');
let heroButton = document.getElementById('dialPlayBtn');
let equaliser = document.getElementById('equaliser');

let playerElements = [headerButton, heroButton, equaliser].filter(Boolean);

/*
 * Update UI
 */
function updatePlayerUI(isPlaying) {
	playerElements.forEach((element) => {
		element.classList.toggle('playing', isPlaying);
	});

	/*
	 * Hero button label
	 */
	if (heroButton) {
		const label = heroButton.querySelector('.caption');

		if (label) {
			label.textContent = isPlaying ? 'Pause' : 'Listen Live';
		}
	}

	/*
	 * Header button accessibility
	 */
	if (headerButton) {
		headerButton.setAttribute('aria-pressed', isPlaying ? 'true' : 'false');

		headerButton.setAttribute('aria-label', isPlaying ? 'Pause live stream' : 'Play live stream');
	}
}

/*
 * Play / Pause
 */
async function togglePlayback() {
	if (audio.paused) {
		try {
			await audio.play();
		} catch (error) {
			console.error('CCR player error:', error);
		}
	} else {
		audio.pause();
	}
}

function initPlayer() {
	if (!audio) {
		return;
	}

	/*
	 * Both buttons control the same audio
	 */
	if (headerButton) {
		headerButton.addEventListener('click', togglePlayback);
	}
	if (heroButton) {
		heroButton.addEventListener('click', togglePlayback);
	}

	/*
	 * Audio events
	 */
	audio.addEventListener('play', () => {
		updatePlayerUI(true);
	});

	audio.addEventListener('pause', () => {
		updatePlayerUI(false);
	});

	audio.addEventListener('ended', () => {
		updatePlayerUI(false);
	});

	audio.addEventListener('error', () => {
		if (audio.error?.code === MediaError.MEDIA_ERR_ABORTED) {
			return;
		}

		updatePlayerUI(false);
		console.error('CCR stream error:', audio.error);
	});

	/*
	 * Volume
	 */
	const volumeSlider = document.getElementById('volumeSlider');

	if (volumeSlider) {
		audio.volume = Number(volumeSlider.value) / 100;

		volumeSlider.addEventListener('input', () => {
			audio.volume = Number(volumeSlider.value) / 100;
		});
	}

	/*
	 * Initial state
	 */
	updatePlayerUI(false);
}

function reInitPlayer() {
	if (!audio) {
		return;
	}

	heroButton = document.getElementById('dialPlayBtn');
	equaliser = document.getElementById('equaliser');

	if (heroButton) {
		heroButton.addEventListener('click', togglePlayback);
	}

	playerElements = [headerButton, heroButton, equaliser].filter(Boolean);

	const isPlaying = !audio.paused && !audio.ended && audio.readyState > 2;

	updatePlayerUI(isPlaying);
}

document.addEventListener('DOMContentLoaded', initPlayer);
document.addEventListener('ccr:page-loaded', reInitPlayer);
