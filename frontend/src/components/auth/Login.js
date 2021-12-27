import React, {Component} from 'react';
import axios from "axios";

class Login extends Component {

    handleSubmit = (e) => {
        e.preventDefault();

        const data = {
            email: this.email,
            password: this.password
        }

        axios.post('http://learn.loc/api/login', data).then(
            response => {
                console.log(response);
            }
        ).catch(
            err => {
                console.log(err);
            }
        )
    }

    render() {
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