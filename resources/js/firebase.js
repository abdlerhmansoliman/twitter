import firebase from 'firebase/app';
import 'firebase/messaging';

const firebaseConfig = {
    apiKey: "AIzaSyBT-OncghYHDUAm6b5sTo1PRW3nluSXAMo",
    authDomain: "tweeter-93d7b.firebaseapp.com",
    projectId: "tweeter-93d7b",
    storageBucket: "tweeter-93d7b.firebasestorage.app",
    messagingSenderId: "75448950038",
    appId: "1:75448950038:web:f9cae7c64975aba0ee4437",
    measurementId: "G-6MQ6JFZDVK"
  };
  firebase.initializeApp(firebaseConfig);
  const messaging = firebase.messaging();
  export const getFcmToken = () => {
    return new Promise((resolve, reject) => {
        Notification.requestPermission()
            .then((permission) => {
                if (permission === 'granted') {
                    messaging.getToken()
                        .then((token) => resolve(token))
                        .catch((err) => reject(err));
                } else {
                    reject(new Error('Permission not granted'));
                }
            })
            .catch((err) => reject(err));
    });
};

export const onMessageListener = () =>
    new Promise((resolve) => {
        messaging.onMessage((payload) => {
            resolve(payload);
        });
    });