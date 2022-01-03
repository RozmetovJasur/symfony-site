import logo from './logo.svg';
import '../node_modules/bootstrap/dist/css/bootstrap.min.css';

import './App.css';
import Home from "./components/Home";
import {BrowserRouter, Route, Router, Switch} from "react-router-dom";
import Login from "./components/auth/Login";
import SignUp from "./components/auth/SignUp";
import {Component} from "react";
import axios from "axios";
import Forgot from "./components/auth/Forgot";
import ResetPassword from "./components/auth/ResetPassword";
import Products from "./admin/components/Products";
import Skeleton, {SkeletonTheme} from 'react-loading-skeleton';
import 'react-loading-skeleton/dist/skeleton.css'
import Menu from "./components/menu/Menu";

export default class App extends Component {

    state = {};

    componentDidMount = () => {
        if (localStorage.getItem('token')) {
            axios.get('api/user').then(
                response => {
                    this.setUser(response.data);

                }
            ).catch(err => {
                console.log(err);
            });
        }
    };

    setUser = user => {
        this.setState({
            user: user
        });
    };


    render() {

        // if (localStorage.getItem('token') && this.state.user)
        {
            return (
                <BrowserRouter>
                    <div className="App">
                        <Menu user={this.state.user} setUser={this.setUser}/>
                        <div className="auth-wrapper">
                            <div className="auth-inner">
                                <Switch>
                                    <Route exact path="/" component={() => <Home user={this.state.user}/>}/>
                                    <Route exact path="/login" component={() => <Login setUser={this.setUser}/>}/>
                                    <Route exact path="/sign-up" component={SignUp}/>
                                    <Route exact path="/forgot" component={Forgot}/>
                                    <Route exact path="/reset-password/:id" component={ResetPassword}/>
                                    <Route exact path="/admin/products" component={Products}/>
                                </Switch>
                            </div>
                        </div>
                    </div>
                </BrowserRouter>
            );
        }
        // else {
        //     return (
        //                 <Skeleton count={30}/>
        //     );
        // }

    }

}