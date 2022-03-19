import React, {Component, useContext, useEffect, useState} from "react";
import {BrowserRouter} from "react-router-dom";
import NavBar from "./components/NavBar";
import AppRouter from "./components/AppRouter";
import {observer} from "mobx-react-lite";
import {Context} from "./index";
import {checkToken} from "./api/user";
import {Spinner} from "react-bootstrap";

const App = observer(() => {

    const {user} = useContext(Context);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        try {
            checkToken().then(data => {
                user.setUser(true)
                user.setIsAuth(true)
            }).finally(() => setLoading(false))
        } catch (e) {

        }
    }, [])

    if (loading) {
        return <Spinner animation={"grow"}/>
    }

    return (
        <BrowserRouter>
            <NavBar/>
            <AppRouter/>
        </BrowserRouter>
    );
})
export default App;