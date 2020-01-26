const staticCacheName = 'SGSE-V2';
const assets = [
	'/css/bootstrap.min.css',
	'/img/logo.png',
	'https://code.jquery.com/jquery-3.3.1.min.js',
	'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js',
	'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js',
	'https://use.fontawesome.com/releases/v5.4.1/css/all.css'
];

// install event
self.addEventListener('install', evt => {
	console.log('service worker installed');
	evt.waitUntil(
		caches.open(staticCacheName).then((cache) => {
			console.log('caching shell assets');
			cache.addAll(assets);
		})
	);
});

// activate event
self.addEventListener('activate', evt => {
	console.log('service worker activated');
});

// fetch event
self.addEventListener('fetch', evt => {
	console.log('fetch event', evt);
	evt.respondWith(
		caches.match(evt.request).then(cacheRes => {
			return cacheRes || fetch(evt.request);
		})
	);
});

 // push notifications event
self.addEventListener('push', function (e) {
    if (!(self.Notification && self.Notification.permission === 'granted')) {
        return;
    }

    if (e.data) {
        var msg = e.data.json();
        console.log(msg)
        e.waitUntil(self.registration.showNotification(msg.title, {
            body: msg.body,
            icon: msg.icon,
            actions: msg.actions
        }));
    }
});
