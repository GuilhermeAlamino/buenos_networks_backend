import { initializeApp } from "firebase/app";
import { getMessaging } from "firebase/messaging/sw";

// Initialize the Firebase app in the service worker by passing in
// your app's Firebase config object.
// https://firebase.google.com/docs/web/setup#config-object
const firebaseApp = initializeApp({
  apiKey: "AIzaSyDMMoVG0d0tlNcZH0kIR2FFT_WcNzq5iVU",
  authDomain: "notifications-37371.firebaseapp.com",
  projectId: "notifications-37371",
  storageBucket: "notifications-37371.appspot.com",
  messagingSenderId: "323633312623",
  appId: "1:323633312623:web:2392f121cd5aabef24ee9a",
  measurementId: "G-6645YF2CXF"
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = getMessaging(firebaseApp);