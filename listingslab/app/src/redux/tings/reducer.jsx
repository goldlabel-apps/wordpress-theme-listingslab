import { createReducer } from '@reduxjs/toolkit'
import {
	error,
	tings,
	subscribed,
	subscribing,
} from "./actions"

export const tingsSlice = {
  error: null,
  tings: [],
  subscribed: false,
  subscribing: false,
}

const tingsReducer = createReducer(tingsSlice, {

  [tings]: (state, action) => {
    state.tings = action.tings
    return state
  },

  [subscribing]: (state, action) => {
    state.subscribing = action.subscribing
    return state
  },

  [subscribed]: (state, action) => {
    state.subscribed = action.subscribed
    return state
  },

  [error]: (state, action) => {
    state.error = action.error
    return state
  },
  
})

export { tingsReducer }
