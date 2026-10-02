document.addEventListener('click', async function (event) {
	const link = event.target.closest('a');

	if (!link) {
		return;
	}

	if (link.origin !== window.location.origin) {
		return;
	}

	event.preventDefault();

	const url = link.href;

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

		currentContent.innerHTML = newContent.innerHTML;

		document.dispatchEvent(new CustomEvent('ccr:page-loaded'));

		console.log('CCR page content replaced');
	} catch (error) {
		console.error('CCR navigation failed:', error);

		window.location.href = url;
	}
});
