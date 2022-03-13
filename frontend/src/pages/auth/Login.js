import React, {useContext, useState} from 'react';
import {useHistory} from "react-router-dom";
import {Button, Card, Col, Container, Form, NavLink, Row} from "react-bootstrap";
import {Context} from "../../index";
import {ROUTE_AUTH_SIGN_UP, ROUTE_HOME} from "../../utils/consts";
import {login} from "../../api/user";
import {observer} from "mobx-react-lite";

const Login = observer(() => {

    const {user} = useContext(Context)
    const history = useHistory()
    const [email, setEmail] = useState('')
    const [password, setPassword] = useState('')

    const click = async () => {
        try {
            let data = await login(email, password);
            user.setUser(user)
            user.setIsAuth(true)
            history.push(ROUTE_HOME)
        } catch (e) {
            alert(e.response.data.message)
        }

    }
    return (
        <Container className="d-flex justify-content-center align-items-center"
                   style={{height: window.innerHeight - 70}}>
            <Card style={{width: 600}} className="p-5">
                <h2 className="m-auto">Login</h2>
                <Form className="d-flex flex-column">
                    <Form.Control className="mt-3" placeholder="Email" value={email}
                                  onChange={e => setEmail(e.target.value)}/>
                    <Form.Control className="mt-3" placeholder="Password" value={password}
                                  onChange={e => setPassword(e.target.value)}
                                  type="password"/>
                    <br/>
                    <Row className="d-flex justify-content-between">
                        <Col className="text-center"> Don't have an account?</Col>
                        <Col className="text-center"> <NavLink onClick={ () => history.push(ROUTE_AUTH_SIGN_UP)}>Register</NavLink></Col>
                    </Row>
                    <Row className="d-flex justify-content-between pt-3">
                        <Button variant={"outline-success"} onClick={click}>
                            Login
                        </Button>
                    </Row>

                </Form>
            </Card>
        </Container>
    );
})

export default Login;