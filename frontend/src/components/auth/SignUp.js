import React, {Component} from 'react';
import axios from "axios";

class SignUp extends Component {

    handleSubmit = (e) => {
        e.preventDefault();

        const data = {
            firstName: this.firstName,
            lastName: this.lastName,
            email: this.email,
            plainPassword: {
                "first": this.password,
                "second": this.confirmPassword,
            }
        }

        axios.post('http://learn.loc/api/sign-up', data).then(
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
                <h3>Sign up</h3>
                <div className="form-group mb-3">
                    <label>Ism</label>
                    <input type="text" className="form-control" placeholder="Ism"
                           onChange={e => this.firstName = e.target.value}/>
                </div>

                <div className="form-group mb-3">
                    <label>Familya</label>
                    <input type="text" className="form-control" placeholder="Familya"
                           onChange={e => this.lastName = e.target.value}/>
                </div>

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

                <div className="form-group mb-3">
                    <label>Takror parol</label>
                    <input type="password" className="form-control" placeholder="Takror parol"
                           onChange={e => this.confirmPassword = e.target.value}/>
                </div>

                <div className="d-grid gap-2">
                    <button className="btn btn-primary btn-block">Sign up</button>
                </div>
            </form>
        );
    }
}

export default SignUp;