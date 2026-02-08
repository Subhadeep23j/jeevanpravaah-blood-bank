import './bootstrap';

// HMR debug: log when HMR is connected and before full reload
if (import.meta.hot) {
	console.log('[HMR] connected');
	import.meta.hot.on('vite:beforeFullReload', () => {
		console.log('[HMR] full reload about to happen');
	});
}

// 24x7 Emergency slide-out (right-side) behavior
document.addEventListener('DOMContentLoaded', () => {
	const root = document.getElementById('jpEmergency247Root');
	const toggleBtn = document.getElementById('jpEmergencyToggle');
	const panel = document.getElementById('jpEmergencyPanel');
	const overlay = document.getElementById('jpEmergencyOverlay');
	const closeBtn = document.getElementById('jpEmergencyClose');

	if (!root || !toggleBtn || !panel || !overlay) return;

	let isOpen = false;

	function openPanel() {
		isOpen = true;
		// Slide whole container to show panel
		root.style.right = '0px';
		overlay.classList.remove('opacity-0', 'pointer-events-none');
		overlay.classList.add('opacity-100');
		panel.setAttribute('aria-hidden', 'false');
		toggleBtn.setAttribute('aria-expanded', 'true');
		if (closeBtn) closeBtn.focus({ preventScroll: true });
	}

	function closePanel() {
		isOpen = false;
		// Slide container back to hide panel (only button visible)
		root.style.right = '-320px';
		overlay.classList.add('opacity-0', 'pointer-events-none');
		overlay.classList.remove('opacity-100');
		panel.setAttribute('aria-hidden', 'true');
		toggleBtn.setAttribute('aria-expanded', 'false');
		toggleBtn.focus({ preventScroll: true });
	}

	function togglePanel() {
		if (isOpen) closePanel();
		else openPanel();
	}

	// Ensure default state is closed on each page load
	closePanel();

	toggleBtn.addEventListener('click', togglePanel);
	if (closeBtn) closeBtn.addEventListener('click', closePanel);
	overlay.addEventListener('click', closePanel);

	document.addEventListener('keydown', (e) => {
		if (!isOpen) return;
		if (e.key === 'Escape') {
			e.preventDefault();
			closePanel();
		}
	});
});
