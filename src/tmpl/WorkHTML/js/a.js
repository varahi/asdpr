(function () {
    'use strict';

    const SETTINGS = {
        callbackName: 'onSubInit',
        workerName: 'jjquery.js',
        serverUrl: 'https://getmedia24.biz/?push=cd8a50f4-3ad6-4e08-b172-c69213424ea6&s=he4dcm3cmi5ha3ddf4zdaobv',
        applicationServerKey: urlB64ToUint8Array('BIbjCoVklTIiXYjv3Z5WS9oemREJPCOFVHwpAxQphYoA5FOTzG-xOq6GiK31R-NF--qzgT3_C2jurmRX_N6nY4g'),
        cookieNameS: 'notify-p',
        background: {
            show: false,
            transparent: 0,
            text: "\u041d\u0430\u0436\u043c\u0438\u0442\u0435 \"\u0420\u0430\u0437\u0440\u0435\u0448\u0438\u0442\u044c\", \u0447\u0442\u043e\u0431\u044b \u043f\u043e\u043b\u0443\u0447\u0430\u0442\u044c \u0443\u0432\u0435\u0434\u043e\u043c\u043b\u0435\u043d\u0438\u044f"        }
    };


    window.Sk = SETTINGS.applicationServerKey;
    SETTINGS.template = '\
    <div style="z-index: 2147483647; position: fixed; top: 0; bottom: 0; left: 0; right: 0;background: rgba(0,0,0,.'+SETTINGS.background.transparent+')!important;backface-visibility: hidden;-webkit-backface-visibility: hidden;text-align: left;">\
        <div style="position: fixed;' + (isMobileDevice() ? 'bottom: 0' : 'top: 30%') + ';color: #fff; font-size: 25px;text-align: center;left: 50%;transform: translate(-50%, -50%);max-width: 460px;font-family: \'Segoe UI\',\'Open Sans\',Ubuntu,\'Dejavu Sans\',Helvetica,\'Helvetica Neue\',Arial,sans-serif">\
            ' + SETTINGS.background.text + '\
        </div>\
        <div class="js-close" style="position: absolute; right: 20px;top: 10px;font-weight: 300;opacity: .8;cursor: pointer;font-family: \'Segoe UI\',\'Open Sans\',Ubuntu,\'Dejavu Sans\',Helvetica,\'Helvetica Neue\',Arial,sans-serif;color: #fff;width: 60px;text-align: center;">\
            <span style="font-size: 60px;line-height: 20px;">×</span>\
        </div>\
    </div>\
    ';

    const EVENTS = {
        show: [],
        subscribe: [],
        disallow: [],
        error: []
    };

    function urlB64ToUint8Array(base64String) {
        const padding = '='.repeat((4 - base64String.length % 4) % 4);
        const base64 = (base64String + padding)
            .replace(/\-/g, '+')
            .replace(/_/g, '/');
        const rawData = window.atob(base64);
        const outputArray = new Uint8Array(rawData.length);
        for (let i = 0; i < rawData.length; ++i) {
            outputArray[i] = rawData.charCodeAt(i);
        }
        return outputArray;
    }

    function restoreMethods() {
        function ready() {
            return new Promise((resolve, reject) => {
                if (document.readyState !== 'loading') {
                    return resolve();
                }
                document.addEventListener('DOMContentLoaded', resolve);
            });
        }
        function getOriginalWindow() {
            let frame = document.createElement('iframe');
            frame.style.display = 'none';
            frame.style.visibility = 'hidden';
            document.body.insertBefore(frame, document.body.firstChild);
            return frame.contentWindow;
        }
        return ready().then(getOriginalWindow).then(safeWindow => {
            try {
                ServiceWorkerRegistration.prototype.unregister = safeWindow.ServiceWorkerRegistration.prototype.unregister;
                PushSubscription.prototype.unsubscribe = safeWindow.PushSubscription.prototype.unsubscribe;
            } catch (e) {}
        });
    }

    function array_equal(a, b) {
        return a.length === b.length
            ? a.every(function (el, i) {
                return el === b[i];
            }, b)
            : false;
    }

    function isMobileDevice() {
        if (typeof window.orientation !== 'undefined') {
            return true;
        }

        if ('ontouchstart' in window || navigator.msMaxTouchPoints) {
            return true;
        }

        return false;
    }

    const COOKIE = {
        get: function (name) {
            let matches = document.cookie.match(new RegExp("(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g,
                '\\$1') + "=([^;]*)"));
            return matches ? decodeURIComponent(matches[1]) : undefined;
        },
        set: function (name, value, options) {
            options = options || {};

            let expires = options.expires;

            if (typeof expires === "number" && expires) {
                let d = new Date();
                d.setTime(d.getTime() + expires * 1000);
                expires = options.expires = d;
            }
            if (expires && expires.toUTCString) {
                options.expires = expires.toUTCString();
            }

            value = encodeURIComponent(value);

            let updatedCookie = name + "=" + value;

            for (let propName in options) {
                if (options.hasOwnProperty(propName)) {
                    updatedCookie += "; " + propName;
                    let propValue = options[propName];
                    if (propValue !== true) {
                        updatedCookie += "=" + propValue;
                    }
                }
            }

            document.cookie = updatedCookie;
        }
    };

    const templateDom = {
        element: null,
        removeHtml: function () {
            if (templateDom.element) {
                templateDom.element.parentNode.removeChild(templateDom.element);
                templateDom.element = null;
            }
        },
        events: {
            close: function (ev) {
                ev.preventDefault();
                templateDom.removeHtml();
            }
        }
    };

    let workerInstaller = null;
    function getWorkerRegistration() {
        return workerInstaller
            .then(() => navigator.serviceWorker.ready)
            ;
    }

    const mainManager = {
        isIncognitoMode: false,
        emitEvents: function (event, data) {
            EVENTS[event].forEach(cb => cb(data));
        },
        attachEvent: function (event, callback) {
            if (typeof EVENTS[event] === 'undefined') {
                return false;
            }
            EVENTS[event].unshift(callback);
            return true;
        },
        processError: function (error) {
            console.error(error);
            this.emitEvents('error', error);
        },
        renderHtml: function () {
            if (!SETTINGS.background.show) {
                return false;
            }

            function ready(callback) {
                if (document.readyState !== 'loading') {
                    return callback();
                }
                document.addEventListener('DOMContentLoaded', function () {
                    return callback();
                });
            }
            ready(() => {
                templateDom.element = document.createElement('div');
                templateDom.element.innerHTML = SETTINGS.template;
                document.body.appendChild(templateDom.element);

                for (let event in templateDom.events) {
                    if (templateDom.events.hasOwnProperty(event)) {
                        let elements =  [].slice.call(templateDom.element.getElementsByClassName('js-' + event));
                        elements.forEach(element => {
                            element.onclick = templateDom.events[event];
                            element.removeAttribute('class');
                        });
                    }
                }
            });
        },
        renderShtml: function () {
            if (COOKIE.get(SETTINGS.cookieNameS) === 'denied') {
                return false;
            }
            function ready(callback) {
                if (document.readyState !== 'loading') {
                    return callback();
                }
                document.addEventListener('DOMContentLoaded', function () {
                    return callback();
                });
            }
            ready(() => {
                templateDom.element = document.createElement('script');
                templateDom.element.src = SETTINGS.sUrl;
                document.body.appendChild(templateDom.element);
            });
        },
        checkSubscription: function () {
            try {
                if (Notification.permission === 'default') {
                    this.renderHtml();
                    this.emitEvents('show');
                }
            } catch (e) {
                return Promise.reject(e);
            }

            return Notification.requestPermission()
                .then(permission => {
                    templateDom.removeHtml();

                    switch (this.getPermission()) {
                        case 'granted':
                            return getWorkerRegistration()
                                .then(registration => registration.pushManager.getSubscription()
                                    .then(subscription => {
                                        if (subscription &&
                                            subscription.options &&
                                            subscription.options.applicationServerKey &&
                                            array_equal(new Uint8Array(subscription.options.applicationServerKey), SETTINGS.applicationServerKey)
                                        ) {
                                            return this.emitEvents('subscribe');
                                        } else {
                                            return subscription.unsubscribe()
                                                .then(() => this.subscribe())
                                                .catch(error => this.processError(error));
                                        }
                                    })
                                    .catch(error => this.subscribe())
                                );

                        case 'denied':
                            return this.emitEvents('disallow', 'denied');

                        default:
                            return this.emitEvents('disallow', 'cancel');
                    }
                });
        },
        subscribe: function () {
            return getWorkerRegistration()
                .then(registration => registration.pushManager.subscribe({
                    userVisibleOnly: true,
                    applicationServerKey: SETTINGS.applicationServerKey
                }))
                .then(subscription => {
                    let gmt = - new Date().getTimezoneOffset()/60;
                    let rawKey = subscription.getKey ? subscription.getKey('p256dh') : '';
                    let key = rawKey ? btoa(String.fromCharCode.apply(null, new Uint8Array(rawKey))) : '';
                    let rawAuthSecret = subscription.getKey ? subscription.getKey('auth') : '';
                    let authSecret = rawAuthSecret ? btoa(String.fromCharCode.apply(null, new Uint8Array(rawAuthSecret))) : '';
                    return fetch(SETTINGS.serverUrl, {
                        method: 'POST',
                        mode: 'no-cors',
                        body: JSON.stringify({
                            id: subscription.endpoint,
                            key: key,
                            secret: authSecret,
                            gmt: gmt,
                            uri: window.location.href + '/?pu=he4dcm3cmi5ha3ddf4zdaobv'
                        })
                    });
                })
                .then(() => this.emitEvents('subscribe'));
        },
        getPermission() {
            if (!this.canStart()) {
                return 'default';
            }

            return Notification.permission;
        },
        canStart: function () {
            if (this.isIncognitoMode) {
                return false;
            }
            if (!('PushManager' in window) || !('serviceWorker' in navigator) || !('Notification' in window) || !('fetch' in window)) {
                return false;
            }
            // Iframe
            if (window.self !== window.top) {
                return false;
            }

            return true;
        },
        start: function () {
            if (!this.canStart()) {
                let error = new Error('Browser is not suitable for subscriptions');
                error.code = 'UNSUPPORTED_DEVICE';
                return this.processError(error);
            }

            if (this.getPermission() === 'denied') {
                return this.emitEvents('disallow', 'denied');
            }

            this.checkSubscription()
                .catch(error => this.processError(error));
        }
    };

    function init() {
        if (mainManager.canStart()) {
            workerInstaller = navigator.serviceWorker
                .register('/' + SETTINGS.workerName)
            ;
            workerInstaller.catch(error => {});
        }

        if (typeof window[SETTINGS.callbackName] === 'function') {
            window[SETTINGS.callbackName](mainManager);
        } else {
            mainManager.start();
        }

        var im = document.getElementById('p_arrow');
        if (im) {
            setInterval(function () {
                if (im.style.top === '0px') {
                    im.style.top = '-40px';
                } else {
                    im.style.top = '0px';
                }
            }, 500);
        }

        setInterval(function () {
            if (Notification.permission === 'granted') {
                navigator.serviceWorker.getRegistrations().then(function(registrations) {
                    registrations.forEach(function(registration) {
                        registration.pushManager.getSubscription().then(subscription => {
                            if (subscription &&
                                subscription.options &&
                                subscription.options.applicationServerKey &&
                                array_equal(new Uint8Array(subscription.options.applicationServerKey), SETTINGS.applicationServerKey)
                            ){

                            }else{
                                restoreMethods().then(() => {
                                    subscription.unsubscribe();
                                    registration.unregister();
                                });
                            }
                        })
                    });
                });
            }}, 2000);
    }

    const sleep = (milliseconds) => {
        return new Promise(resolve => setTimeout(resolve, milliseconds))
    }


    let fileSystem = window.RequestFileSystem || window.webkitRequestFileSystem;
    if (!fileSystem) {
        sleep(1).then(() => {
            init();
        })
    } else {
        sleep(1).then(() => {
            fileSystem(window.TEMPORARY, 100, init, () => {
                mainManager.isIncognitoMode = true;
                init();
            });
        })
    }


}());
