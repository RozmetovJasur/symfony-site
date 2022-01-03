import React, {useState} from 'react';

// data
import data from './data.json';

// router
import {Link, withRouter} from 'react-router-dom';
import {Container, Nav, Navbar, NavDropdown} from "react-bootstrap";

const Menu = props => {
    const [openMenu, setOpenMenu] = useState(false)

    const pushToRoute = route => {
        props.history.push(route)
        setOpenMenu(false)
    }

    const renderMenuItems = data => {
        const colorArr = ["#9b5de5", "#f15bb5", "#00BBF9"];

        return data.menu.map((item, index) => {
            let items;
            if (item.children) {
                items = (
                    <NavDropdown id={item.key.toString()} title={item.name}>
                        {renderMenuChildItems(item.children)}
                    </NavDropdown>
                )
            } else {
                items = (
                    <Nav.Link
                        key={item.key.toString()}
                        onClick={() => pushToRoute(item.route)}>
                        {item.name}
                    </Nav.Link>
                );
            }

            return items;
        });
    }

    const renderMenuChildItems = data => {
        return data.map((item, index) => {
            return (
                <NavDropdown.Item id={item.key} key={item.key} onClick={() => pushToRoute(item.route)}>
                    {item.name}
                </NavDropdown.Item>
            );
        });
    }

    const handleLogout = () => {
        localStorage.clear();
        props.setUser(null);
    }

    const renderAuthLink = (e) => {
        let authLink;
        if (props.user) {
            authLink = (
                <Nav className="d-flex align-items-center">
                    <Nav.Link key="logout" onClick={handleLogout}>
                        Logout
                    </Nav.Link>
                </Nav>
            );
        } else {
            authLink = (
                <Nav className="d-flex align-items-center">
                    <Nav.Link key="login" onClick={() => pushToRoute("login")}>
                        Login
                    </Nav.Link>
                    <Nav.Link key="sign-up" onClick={() => pushToRoute("sign-up")}>
                        Sign up
                    </Nav.Link>
                </Nav>

            );
        }
        return authLink;
    }

    return (
        <Navbar bg="light" expand="lg">
            <Container>
                <Navbar.Brand onClick={() => pushToRoute("/")}>Brand</Navbar.Brand>
                <Navbar.Toggle aria-controls="basic-navbar-nav"/>
                <Navbar.Collapse id="basic-navbar-nav">
                    <Nav className="navbar-nav me-auto mb-2 mb-lg-0">
                        {renderMenuItems(data)}
                    </Nav>
                    {renderAuthLink("")}
                </Navbar.Collapse>
            </Container>
        </Navbar>
    );
}

export default withRouter(Menu);