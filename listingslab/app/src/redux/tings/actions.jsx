
import { createAction } from '@reduxjs/toolkit'
import { 
	getStore,
} from '../../App'

export const error = createAction(`TINGS/ERROR`)
export const tings = createAction(`TINGS/TINGS`)
export const subscribed = createAction(`TINGS/SUBSCRIBED`)
export const subscribing = createAction(`TINGS/SUBSCRIBING`)

