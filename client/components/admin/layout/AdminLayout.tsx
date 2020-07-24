import React, { useState }  from 'react'
import clsx from 'clsx'
import TheHeader from "./TheHeader"
import TheSidebar from "./TheSidebar"
import CssBaseline from '@material-ui/core/CssBaseline';
import { makeStyles, Theme, createStyles } from '@material-ui/core/styles';

const drawerWidth = 240;

const useStyles = makeStyles((theme: Theme) =>
    createStyles({
        root: {
            display: 'flex',
        },
        content: {
            flexGrow: 1,
            padding: theme.spacing(3),
            transition: theme.transitions.create('margin', {
              easing: theme.transitions.easing.sharp,
              duration: theme.transitions.duration.leavingScreen,
            }),
            marginLeft: -drawerWidth,
          },
        contentShift: {
            transition: theme.transitions.create('margin', {
                easing: theme.transitions.easing.easeOut,
                duration: theme.transitions.duration.enteringScreen,
            }),
            marginLeft: 0,
        },
    }),
);

const Layout = ({ children }): JSX.Element => {
    const classes = useStyles();

    const [state, setState] = useState(false);

    const toggleDrawer = (open: boolean) => (
        event: React.KeyboardEvent | React.MouseEvent,
    ) => {
        if (
            event &&
            event.type === 'keydown' &&
            ((event as React.KeyboardEvent).key === 'Tab' ||
            (event as React.KeyboardEvent).key === 'Shift')
        ) {
            return;
        }

        console.log(open)
        setState(open);
    }

    return (
        <div className={classes.root}>
            <CssBaseline />

            <TheHeader onClick={() => toggleDrawer(!state)} />

            <TheSidebar open={state} onOpen={() => toggleDrawer(true)} onClose={() => toggleDrawer(false)} />

            <main className={clsx(classes.content, {
                [classes.contentShift]: state,
            })}>
                {children}
            </main>
        </div>
    )
}

export default Layout