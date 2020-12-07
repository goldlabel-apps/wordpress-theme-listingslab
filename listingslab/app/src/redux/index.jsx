import { configureStore, getDefaultMiddleware } from '@reduxjs/toolkit'
import { combineReducers } from 'redux'
import { appReducer, appSlice } from './app/reducer'
import { tingsReducer, tingsSlice } from './tings/reducer'

const reduxStore = () => {
  const reducer = combineReducers({
    app: appReducer,
    tings: tingsReducer,
  })

  const preloadedState = {
    app: appSlice,
    tings: tingsSlice,
  }
  
  const middleware = [
    ...getDefaultMiddleware({
      serializableCheck: false
    })
  ]
  const store = configureStore({
    devTools: process.env.NODE_ENV !== 'production',
    reducer,
    middleware,
    preloadedState,
    enhancers: []
  })
  return store
}

export default reduxStore