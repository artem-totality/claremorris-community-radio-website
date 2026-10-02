document.addEventListener('DOMContentLoaded', () => {
	const audio = document.getElementById('radioStream');

	if (!audio) {
		return;
	}

	const headerButton = document.getElementById('playBtn');
	const heroButton = document.querySelector('.listen-live');

	const buttons = [headerButton, heroButton].filter(Boolean);

	/*
	 * Update UI
	 */
	function updatePlayerUI(isPlaying) {
		buttons.forEach((button) => {
			button.classList.toggle('playing', isPlaying);
		});

		/*
		 * Hero button label
		 */
		if (heroButton) {
			const label = heroButton.querySelector('.label');

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

	/*
	 * Both buttons control the same audio
	 */
	buttons.forEach((button) => {
		button.addEventListener('click', togglePlayback);
	});

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
});
