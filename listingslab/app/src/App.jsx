import React from 'react'
import { useSelector } from 'react-redux'
import clsx from 'clsx'
import { theme } from './theme/'
import {
    makeStyles,
    CssBaseline,
    MuiThemeProvider, 
    createMuiTheme,
} from '@material-ui/core/'
import { 
  AuthForm,
  Appshell,
  Top,
} from './components'

const useStyles = makeStyles(theme => ({
     app: {
        // border: '1px solid red',
    },
    vSpace:{
        height: theme.spacing(2)
    },
}))

export default function App() {
	const appSlice = useSelector(state => state.app)
  const classes = useStyles()
	// const tingsSlice = useSelector(state => state.tings)
     //    const {
     //    	tings,
     //    } = tingsSlice
    const {
    	authStateChanged,
        authed,
    } = appSlice

    // console.log ('authed', authed, 'authStateChanged', authStateChanged )
    if (!authStateChanged) return null
  	return 	<div className={clsx(classes.app)}>
              <MuiThemeProvider theme={createMuiTheme(theme)}>
                <CssBaseline />
                <Top />
                { !authed ? <AuthForm /> : <Appshell /> }
              </MuiThemeProvider>
			      </div>
}













/*

tings
              <pre>
                  { JSON.stringify(tings, null, 2)}
              </pre>
*/