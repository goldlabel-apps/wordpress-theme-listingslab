import pJSON from '../package.json'
import React from 'react'
import ReactDOM from 'react-dom'
import App from './App'
import firebase from '@firebase/app'
import '@firebase/auth'
import reduxStore from './redux'
import { Provider } from 'react-redux'
import { changeAuth } from './redux/app/actions'

console.log(`${process.env.REACT_APP_APP} ${pJSON.version} (${process.env.REACT_APP_ENV})`)

const fireConfig = {
  apiKey: process.env.REACT_APP_FIREBASE_APIKEY,
  authDomain: process.env.REACT_APP_FIREBASE_AUTHDOMAIN,
  databaseURL: process.env.REACT_APP_FIREBASE_DATABASEURL,
  projectId: process.env.REACT_APP_FIREBASE_PROJECTID,
  storageBucket: process.env.REACT_APP_FIREBASE_STORAGEBUCKET,
  messagingSenderId: process.env.REACT_APP_FIREBASE_MESSAGESENDERID,
  appId: process.env.REACT_APP_FIREBASE_APPID
}

const fBase = firebase.initializeApp(fireConfig)
export const getFBase = () => { return fBase }

const store = reduxStore()
export const getStore = () => { return store }

firebase.auth().onAuthStateChanged(function(user) {
  changeAuth(user)
})

ReactDOM.render(
  <Provider store={store}>
    <App />
  </Provider>,
  document.getElementById('push2talk-manager')
)