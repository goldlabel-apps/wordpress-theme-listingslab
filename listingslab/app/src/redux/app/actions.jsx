import { createAction } from '@reduxjs/toolkit'
import firebase from '@firebase/app'
import '@firebase/auth'
import { 
	getStore,
} from '../../'

export const error = createAction(`APP/ERROR`)
export const authStateChanged = createAction(`APP/AUTHSTATECHANGED`)
export const authed = createAction(`APP/AUTHED`)
export const isAuthing = createAction(`APP/AUTHING`)


export const signin = creds => {
	const store = getStore()
	store.dispatch({type: `APP/AUTHING`, isAuthing: true })
	const { email, password } = creds
	firebase.auth()
		.signInWithEmailAndPassword( email, password)
		.then(function(result) {
			store.dispatch({type: `APP/AUTHING`, isAuthing: false })
		})
		.catch(function(error) {
			store.dispatch({type: `APP/AUTHING`, isAuthing: false })
			store.dispatch({type: `APP/ERROR`, error: error.message })
		})
}

export const changeAuth = user => {
	const store = getStore()
	store.dispatch({ type: `APP/AUTHSTATECHANGED`, authStateChanged: true })
	if (user){
		store.dispatch({ type: `APP/AUTHED`, authed: true })
	} else {
		store.dispatch({ type: `APP/AUTHED`, authed: false })
	}
}


export const signout = () => {
	const store = getStore()
	store.dispatch({type: `APP/AUTHING`, isAuthing: true })
	firebase.auth().signOut()
		.then(function(result) {
			store.dispatch({type: `APP/AUTHING`, isAuthing: false })
			store.dispatch({ type: `APP/AUTHED`, authed: false })
		})
}
