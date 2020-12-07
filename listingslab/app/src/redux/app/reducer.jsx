import pJSON from '../../../package.json'
import { createReducer } from '@reduxjs/toolkit'
import {
	error,
	authStateChanged,
	authed,
	isAuthing,
} from "./actions"

export const appSlice = {
  pJSON,
  error: null,
  authStateChanged: false,
  authed: false,
  isAuthing: false,
}

const appReducer = createReducer(appSlice, {

  [error]: (state, action) => {
    state.error = action.error
    return state
  },

  [authStateChanged]: (state, action) => {
    state.authStateChanged = action.authStateChanged
    return state
  },

  [authed]: (state, action) => {
    state.authed = action.authed
    return state
  },

  [isAuthing]: (state, action) => {
    state.isAuthing = action.isAuthing
    return state
  },

  
})

export { appReducer }
