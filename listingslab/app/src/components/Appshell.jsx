import React from 'react'
import clsx from 'clsx'
import {
    makeStyles,
    // useTheme,
} from '@material-ui/core/'


const useStyles = makeStyles(theme => ({
    appshell:{
        margin: theme.spacing(4),
    },
    vSpace:{
        height: theme.spacing(2)
    },
    btnTxt: {
        marginRight: theme.spacing(),
        marginLeft: theme.spacing(),
    }
}))

export default function Appshell() {
	const classes = useStyles()
    // const primary = useTheme().palette.primary.main
	return	<div className={clsx(classes.appshell)}>
                Appshell
  			</div>
}




/*
<span className={classes.btnTxt}>
                        Sign out
                    </span>  
*/