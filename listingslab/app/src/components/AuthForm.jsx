import React from 'react'
import { 
    useSelector,
} from 'react-redux'
import {
    makeStyles,
    // useTheme,
    Button,
    TextField,
    CircularProgress,
} from '@material-ui/core/'
import { Alert } from '@material-ui/lab/'
import { Icon } from '../theme'
import { signin } from '../redux/app/actions'

const useStyles = makeStyles(theme => ({
    authForm:{
        margin: theme.spacing(4),
    },
    title:{
        // marginLeft: theme.spacing(3),
    },
    textField:{
        minWidth: 300,
    },
    btnTxt:{
    	marginRight: theme.spacing(),
        marginLeft: theme.spacing(),
    },
    vSpace:{
        height: theme.spacing(2)
    },
}))

export default function AuthForm() {

	const classes = useStyles()
    // const primary = useTheme().palette.primary.main
	const [creds, setCreds] = React.useState({ email: null, password: null })
	const appSlice = useSelector(state => state.app)
    const {
    	error,
        isAuthing,
    } = appSlice


	const validate = () => {
        let isValid = true
        const email = document.getElementById(`email`).value
        const password = document.getElementById(`password`).value
        if (email === ``){
            isValid = false
        }
        if (password === ``){
            isValid = false
        }
        let result = {
            isValid,
            email,
            password,
        }
        setCreds({ email: email.toLowerCase(), password })
        return result
    }
	
	return	<React.Fragment>
  				<div className={classes.authForm}>
	                { !isAuthing ? <React.Fragment>
                        <TextField
                            className={classes.textField}
                            onChange={(e) => {
                                validate()
                            }}
                            label={`Email`}
                            id={`email`}
                            variant={`outlined`}
                            size={`small`}
                        />
                        <div className={classes.vSpace} />
                        <TextField
                            className={classes.textField}
                            onChange={(e) => {
                                validate()
                            }}
                            type={`password`}
                            label={`Password`}
                            id={`password`}
                            variant={`outlined`}
                            size={`small`}
                        />
                        <div className={classes.vSpace} />                  
		                <Button
                            variant={`contained`}
                            color={ `primary` }
                            onClick={(e) => {
                                e.preventDefault()
                                if (validate().isValid) {
                                    signin(creds)
                                }
                            }}>    
                            <Icon icon={`user`} color={ `white` } /> 
                            <span className={classes.btnTxt}>
                                Sign in
                            </span>
                    	</Button>
                    	<div className={classes.vSpace} />
                	</React.Fragment> 
                	: <React.Fragment>
	                        		<div className={classes.vSpace} />
	                        		<CircularProgress />
	                        		<div className={classes.vSpace} />
	                        	</React.Fragment>
                	}
                </div>
                { error ? <div>
                    <Alert severity="warning">
                        { error }
                    </Alert>
                </div> : null }
  			</React.Fragment>
}
