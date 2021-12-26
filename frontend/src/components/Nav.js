import React, {Component} from 'react';
import {Link} from "react-router-dom";

class Nav extends Component {
    render() {
        return (

            <nav className="navbar navbar-expand navbar-light">
                <div className="container">
                    <div className="collapse navbar-collapse" id="navbarButtonsExample">
                        <ul className="navbar-nav me-auto mb-2 mb-lg-0">
                            <li className="nav-item">
                                <Link to={"/"} className="nav-link">Home</Link>
                            </li>
                        </ul>

                        <div className="d-flex align-items-center">
                            <ul className="navbar-nav me-auto mb-2 mb-lg-0">
                                <li className="nav-item">
                                    <Link className="nav-link" to={"/login"}>Login</Link>
                                </li>
                                <li className="nav-item">
                                    <Link className="nav-link" to={"/sign-up"}>Sign up</Link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        );
    }
}

export default Nav;