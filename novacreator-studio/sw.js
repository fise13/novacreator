self.addEventListener('push', function(event) {
    const data = event.data ? event.data.json() : {};
    const title = data.title || 'NovaCreator Studio';
    const options = {
        body: data.body || 'У вас новое обновление',
        icon: data.icon || '/assets/img/logo.svg',
        badge: data.badge || '/assets/img/logo.svg',
        data: {
            url: data.url || '/client/dashboard.php'
        }
    };
    
    event.waitUntil(
        self.registration.showNotification(title, options)
    );
});

self.addEventListener('notificationclick', function(event) {
    event.notification.close();
    
    const url = event.notification.data.url || '/client/dashboard.php';
    
    event.waitUntil(
        clients.openWindow(url)
    );
});

self.addEventListener('install', function(event) {
    self.skipWaiting();
});

self.addEventListener('activate', function(event) {
    event.waitUntil(clients.claim());
});

