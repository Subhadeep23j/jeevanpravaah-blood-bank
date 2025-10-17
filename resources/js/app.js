import './bootstrap';

// HMR debug: log when HMR is connected and before full reload
if (import.meta.hot) {
	console.log('[HMR] connected');
	import.meta.hot.on('vite:beforeFullReload', () => {
		console.log('[HMR] full reload about to happen');
	});
}
