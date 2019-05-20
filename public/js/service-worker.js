const FILES_TO_CACHE = [
	'offline.html',
	'css/bootstrap.min.css',
	'img/logo.png'
];

// Salvando cache ao instalar PWA
evt.waitUntil(
	caches.open(CACHE_NAME).then((cache) => {
		console.log('[ServiceWorker] Pre-caching offline page');
		return cache.addAll(FILES_TO_CACHE);
	})
);