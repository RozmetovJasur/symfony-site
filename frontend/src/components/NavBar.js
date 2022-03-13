import {useContext} from "react";
import {Context} from "../index";
import {Button, Container, Nav, Navbar} from "react-bootstrap";
import {ROUTE_AUTH_LOGIN, ROUTE_AUTH_SIGN_UP, ROUTE_HOME, ROUTE_PRODUCT} from "../utils/consts";
import {observer} from "mobx-react-lite";
import {useHistory} from "react-router-dom";

const NavBar = observer(() => {
    const {user} = useContext(Context);
    const history = useHistory()

    const logout = () => {
        user.setUser({});
        user.setIsAuth(false);
        localStorage.setItem('token', null);
    }

    return (
        <Navbar bg="dark" variant="dark" className="mb-4">
            <Container>
                <Nav.Link onClick={() => history.push(ROUTE_HOME)} className="text-white">Home</Nav.Link>
                <Nav.Link onClick={() => history.push(ROUTE_PRODUCT)} className="text-white">Product</Nav.Link>
                {user.isAuth ?
                    <Nav className="ml-auto text-white">
                        <Button variant={"outline-light"} className="m-1" onClick={() => logout()}>Logout</Button>
                    </Nav>
                    :
                    <Nav className="ml-auto text-white">
                        <Button variant={"outline-light"} onClick={() => history.push(ROUTE_AUTH_LOGIN)}>Login</Button>
                        <Button variant={"outline-light"} style={{marginLeft: 10}}
                                onClick={() => history.push(ROUTE_AUTH_SIGN_UP)}>Sign up</Button>
                    </Nav>
                }
            </Container>
        </Navbar>
    );
})
export default NavBar;