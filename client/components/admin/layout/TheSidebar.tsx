import React from 'react';
import { makeStyles, Theme, createStyles } from '@material-ui/core/styles';
import SwipeableDrawer from '@material-ui/core/SwipeableDrawer';
import Toolbar from '@material-ui/core/Toolbar';
import List from '@material-ui/core/List';
import Divider from '@material-ui/core/Divider';
import ListItem from '@material-ui/core/ListItem';
import ListItemIcon from '@material-ui/core/ListItemIcon';
import ListItemText from '@material-ui/core/ListItemText';
import InboxIcon from '@material-ui/icons/MoveToInbox';
import MailIcon from '@material-ui/icons/Mail';
import HomeIcon from '@material-ui/icons/Home';
import StoreIcon from '@material-ui/icons/Store';
import Link from 'next/link'

interface SidebarItem {
  href: string
  text: string
  icon: JSX.Element
}

const SidebarItemList = (): SidebarItem[] => [
  { href: '/admin', text: 'Home', icon: <HomeIcon /> },
  { href: '/admin/shops', text: 'Shop', icon: <StoreIcon /> },
  { href: '/admin/signin', text: 'ログイン', icon: <HomeIcon /> },
]

const drawerWidth = 240;

const useStyles = makeStyles((theme: Theme) =>
  createStyles({
    root: {
      display: 'flex',
    },
    appBar: {
      zIndex: theme.zIndex.drawer + 1,
    },
    drawer: {
      width: drawerWidth,
      flexShrink: 0,
    },
    drawerPaper: {
      width: drawerWidth,
    },
    drawerContainer: {
      overflow: 'auto',
    },
    content: {
      flexGrow: 1,
      padding: theme.spacing(3),
    },
  }),
);

const Sidebar = ({ open, onOpen, onClose }): JSX.Element => {
    const classes = useStyles();

    return (
        <SwipeableDrawer
            anchor="left"
            variant="persistent"
            className={classes.drawer}
            classes={{
              paper: classes.drawerPaper,
            }}
            open={open}
            onClose={onClose()}
            onOpen={onOpen()}
        >
        <Toolbar />
        <div className={classes.drawerContainer}>
            <List>
                {SidebarItemList().map((item) => (
                  <Link href={item.href} key={item.text}>
                    <ListItem button component="a" href={item.href}>
                      <ListItemIcon>{item.icon}</ListItemIcon>
                      <ListItemText primary={item.text} />
                    </ListItem>
                  </Link>
                ))}
            </List>
            <Divider />
            <List>
                {['All mail', 'Trash', 'Spam'].map((text, index) => (
                <ListItem button key={text}>
                    <ListItemIcon>{index % 2 === 0 ? <InboxIcon /> : <MailIcon />}</ListItemIcon>
                    <ListItemText primary={text} />
                </ListItem>
                ))}
            </List>
            </div>
        </SwipeableDrawer>
    )
}

export default Sidebar