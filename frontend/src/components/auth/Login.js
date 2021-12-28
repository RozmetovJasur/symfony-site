import React, {Component} from 'react';
import axios from "axios";
import Redirect from "react-router-dom/es/Redirect";

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

                this.props.setUser(response.data.user);
            }
        ).catch(
            err => {
                console.log(err);
            }
        );
    }

    render() {

        if (this.state.loggedIn) {
            return <Redirect to={'/'}/>;
        }

        return (
            <form onSubmit={this.handleSubmit}>
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
                </div>
            </form>
        );
    }
}

export default Login;