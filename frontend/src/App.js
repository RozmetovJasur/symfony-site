import logo from './logo.svg';
import '../node_modules/bootstrap/dist/css/bootstrap.min.css';

import './App.css';
import Home from "./components/Home";
import Nav from "./components/Nav";
import {BrowserRouter, Route, Router, Switch} from "react-router-dom";
import Login from "./components/auth/Login";
import SignUp from "./components/auth/SignUp";

function App() {
    return (
        <BrowserRouter>
            <div className="App">
                <Nav/>
                <div className="auth-wrapper">
                    <div className="auth-inner">
                        <Switch>
                            <Route exact path="/" component={Home}/>
                            <Route exact path="/login" component={Login}/>
                            <Route exact path="/sign-up" component={SignUp}/>
                        </Switch>
                    </div>
                </div>
            </div>
        </BrowserRouter>
    );
}

export default App;
