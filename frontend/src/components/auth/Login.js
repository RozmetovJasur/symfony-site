import React, {Component} from 'react';
import axios from "axios";
import {Link, Redirect} from "react-router-dom";
import {fetchUser} from "../../api/user";

class Login extends Component {

    state = {};

    handleSubmit = (e) => {
        e.preventDefault();

        const data = {
            email: this.email,
            password: this.password
        }

        axios.post('/api/login', data).then(
            response => {
                localStorage.setItem('token', response.data.token);
                this.setState({
                    loggedIn: true
                });
                fetchUser().then(user => this.props.setUser(user))
            }
        ).catch(
            err => {
                this.setState({
                    message: err.response.data.message
                });
            }
        );
    }

    render() {

        if (this.state.loggedIn) {
            return <Redirect to={'/'}/>;
        }

        let error = '';
        if (this.state.message) {
            error = (
                <div className="alert alert-danger" role="alert">
                    {this.state.message}
                </div>
            )
        }

        return (
            <form onSubmit={this.handleSubmit}>
                {error}

                <h3>Login</h3>

                <div className="form-group mb-3">
                    <label>Email</label>
                    <input type="email" className="form-control" placeholder="Email"
                           onChange={e => this.email = e.target.value}/>
                </div>

                <div className="form-group mb-3">
                    <label>Parol</label>
                    <input type="password" className="form-control" placeholder="Parol"
                           onChange={e => this.password = e.target.value}/>
                </div>

                <div className="d-grid gap-2">
                    <button className="btn btn-primary btn-block">Login</button>
                    <p className="forgot-password text-right">
                        <Link to={"/forgot"}>Parolni unitdingizmi?</Link>
                    </p>
                </div>
            </form>
        );
    }
}

export default Login;