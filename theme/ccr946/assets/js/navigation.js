let currentController = null;

async function loadPage(url, addToHistory = true, state = {}) {
	// Abort previous request
	if (currentController) {
		currentController.abort();
	}

	currentController = new AbortController();

	try {
		const response = await fetch(url, {
			signal: currentController.signal,
		});

		if (!response.ok) {
			throw new Error(`HTTP error: ${response.status}`);
		}

		const html = await response.text();

		const parser = new DOMParser();

		const newDocument = parser.parseFromString(html, 'text/html');

		const newContent = newDocument.querySelector('#page-content');

		if (!newContent) {
			throw new Error('Target #page-content not found');
		}

		const currentContent = document.querySelector('#page-content');

		if (!currentContent) {
			throw new Error('Current #page-content not found');
		}

		// Replace page content
		currentContent.innerHTML = newContent.innerHTML;

		// Update body classes
		document.body.className = newDocument.body.className;

		// Update document title
		if (newDocument.title) {
			document.title = newDocument.title;
		}

		// Update browser history
		if (addToHistory) {
			window.history.pushState({}, '', url);
		}

		// Scroll to top
		if (state.yScroll) {
			window.scrollTo(0, state.yScroll);
		} else {
			if (window.scrollY > 38) {
				window.scrollTo(0, 38);
			}
		}

		// Reinitialize page-specific JavaScript
		document.dispatchEvent(new CustomEvent('ccr:page-loaded'));

		console.log('CCR page content replaced');
	} catch (error) {
		if (error.name === 'AbortError') {
			return;
		}

		console.error('CCR navigation failed:', error);

		window.location.href = url;
	}
}

/**
 * Internal navigation
 */
document.addEventListener('click', function (event) {
	// Only normal left-clicks
	if (
		event.defaultPrevented ||
		event.button !== 0 ||
		event.metaKey ||
		event.ctrlKey ||
		event.shiftKey ||
		event.altKey
	) {
		return;
	}

	const link = event.target.closest('a');

	if (!link) {
		return;
	}

	// External link
	if (link.origin !== window.location.origin) {
		return;
	}

	// New tab / download
	if (link.target === '_blank' || link.hasAttribute('download')) {
		return;
	}

	// WordPress admin / login
	if (link.pathname.startsWith('/wp-admin') || link.pathname.startsWith('/wp-login')) {
		return;
	}

	// Files
	if (/\.(pdf|zip|mp3|jpg|jpeg|png|gif|webp|svg|mp4|webm|doc|docx|xls|xlsx)$/i.test(link.pathname)) {
		return;
	}

	// Same-page anchor
	if (link.pathname === window.location.pathname && link.hash) {
		return;
	}

	event.preventDefault();

	// Save current scroll position in the current history entry
	window.history.replaceState(
		{
			...window.history.state,
			yScroll: window.scrollY,
		},
		'',
	);

	loadPage(link.href);
});

/**
 * Browser Back / Forward
 */
window.addEventListener('popstate', function (event) {
	loadPage(window.location.href, false, event.state);
});

function setBackButton() {
	const backButton = document.getElementById('back-button');
	if (backButton) {
		backButton.addEventListener('click', () => {
			if (window.history.length > 1) {
				window.history.back();
			}
		});
	}
}

document.addEventListener('ccr:page-loaded', setBackButton);
