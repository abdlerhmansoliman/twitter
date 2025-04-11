import './bootstrap';


import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
import { initializeApp } from "firebase/app";
import { getMessaging, getToken, onMessage } from "firebase/messaging";

const firebaseConfig = {
    apiKey: "AIzaSyBT-OncghYHDUAm6b5sTo1PRW3nluSXAMo",
    authDomain: "tweeter-93d7b.firebaseapp.com",
    projectId: "tweeter-93d7b",
    storageBucket: "tweeter-93d7b.firebasestorage.app",
    messagingSenderId: "75448950038",
    appId: "1:75448950038:web:f9cae7c64975aba0ee4437",
    measurementId: "G-6MQ6JFZDVK"
  };

 