'use strict';

const swReady = navigator.serviceWorker.ready;

document.addEventListener('DOMContentLoaded', function () {
    initSW();
});

function initSW() {
    if (!"serviceWorker" in navigator) {
        //worker de serviço não é suportado
        console.log("worker de serviço não é suportado");
        return;
    }

    if (!"PushManager" in window) {
        //push não é suportado
        console.log("push não é suportado");
        return;
    }

    //registrando o service worker
    navigator.serviceWorker.register('../sw.js')
        .then(() => {
            console.log('Service Worker Registrado!')
            initPush();
        })
        .catch((err) => {
            console.log(err)
        });
}

function initPush() {
    if (!swReady) {
        return;
    }

    new Promise(function (resolve, reject) {
        const permissionResult = Notification.requestPermission(function (result) {
            resolve(result);
        });

        if (permissionResult) {
            permissionResult.then(resolve, reject);
        }
    })
        .then((permissionResult) => {
            if (permissionResult !== 'granted') {
                throw new Error('Não nos foi concedida permissão.');
            }
            subscribeUser();
        });
}

/**
 * Inscrever o usuário para enviar push
 */
function subscribeUser() {
    swReady
        .then((registration) => {
            const subscribeOptions = {
                userVisibleOnly: true,
                applicationServerKey: urlBase64ToUint8Array(
                    vapidPublicKey
                )
            };

            return registration.pushManager.subscribe(subscribeOptions);
        })
        .then((pushSubscription) => {
            console.log('Push Subscrição recebida: ', JSON.stringify(pushSubscription));
            storePushSubscription(pushSubscription);
        });
}

/**
 * enviando PushSubscription para o servidor.
 * @param {object} pushSubscription
 */

async function storePushSubscription(pushSubscription) {
    try {
        const token = document.querySelector('meta[name=csrf-token]').getAttribute('content');

        const response = await fetch('dashboard/subscribe', {
            method: 'POST',
            body: JSON.stringify(pushSubscription),
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-Token': token
            }
        });

        const data = await response.json();
        console.log(data);
    } catch (error) {
        console.error(error);
    }
}


/**
 * urlBase64ToUint8Array
 * 
 * @param {string} base64String a public vapid key
 */
function urlBase64ToUint8Array(base64String) {
    var padding = '='.repeat((4 - base64String.length % 4) % 4);
    var base64 = (base64String + padding)
        .replace(/\-/g, '+')
        .replace(/_/g, '/');

    var rawData = window.atob(base64);
    var outputArray = new Uint8Array(rawData.length);

    for (var i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
}