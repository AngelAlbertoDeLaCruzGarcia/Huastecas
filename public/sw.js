self.addEventListener("install", function(event) {
    event.waitUntil(preLoad());
});

var filesToCache = ["/", "/offline.html"];

var preLoad = function() {
    return caches.open("offline").then(function(cache) {
        // caching index and important routes
        return cache.addAll(filesToCache);
    });
};

self.addEventListener("fetch", function(event) {
    event.respondWith(
        checkResponse(event.request).catch(function() {
            return returnFromCache(event.request);
        })
    );
});

var checkResponse = function(request) {
    return new Promise(function(fulfill, reject) {
        fetch(request).then(function(response) {
            if (response.status != 404) {
                fulfill(response);
            } else {
                reject();
            }
        }, reject);
    });
};

var returnFromCache = function(request) {
    return caches.open("offline").then(function(cache) {
        return cache.match(request).then(function(matching) {
            if (!matching) {
                return cache.match("offline.html");
            } else {
                return matching;
            }
        });
    });
};

self.addEventListener("activate", function(event) {
    event.waitUntil(
        caches
            .keys()
            .then(function(names) {
                return Promise.all(
                    names
                        .filter(function(name) {
                            return name !== "offline";
                        })
                        .map(function(name) {
                            return caches.delete(name);
                        })
                );
            })
            .then(function() {
                return self.clients.claim();
            })
    );
});
