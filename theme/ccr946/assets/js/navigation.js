async function loadPage(url, addToHistory = true) {
	try {
		const response = await fetch(url);

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
		document.title = newDocument.title;

		// Update browser history
		if (addToHistory) {
			window.history.pushState({}, '', url);
		}

		// Scroll to top
		window.scrollTo(0, 0);

		// Reinitialize page-specific JavaScript
		document.dispatchEvent(new CustomEvent('ccr:page-loaded'));

		console.log('CCR page content replaced');
	} catch (error) {
		console.error('CCR navigation failed:', error);

		window.location.href = url;
	}
}

/**
 * Internal navigation
 */
document.addEventListener('click', function (event) {
	const link = event.target.closest('a');

	if (!link) {
		return;
	}

	// Ignore external links
	if (link.origin !== window.location.origin) {
		return;
	}

	event.preventDefault();

	loadPage(link.href);
});

/**
 * Browser Back / Forward
 */
window.addEventListener('popstate', function () {
	loadPage(window.location.href, false);
});
