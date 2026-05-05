/**
 * Minimal service worker to avoid 404 registration errors.
 * Keeps behavior transparent: no caching strategy is enforced.
 */
self.addEventListener('install', (event) => {
  self.skipWaiting();
});

self.addEventListener('activate', (event) => {
  event.waitUntil(self.clients.claim());
});

self.addEventListener('fetch', () => {
  // Network is handled by the browser default pipeline.
});
