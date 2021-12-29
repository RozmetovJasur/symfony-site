import React, {Component} from 'react';
import axios from "axios";
import {Redirect} from "react-router-dom";

class Forgot extends Component {

    state = {};
    handleSubmit = e => {
        e.preventDefault();

        if (!this.email) {
            this.setState({
                message: "Emailni kiriting",
                cls: 'danger'
            });
            return;
        }

        const data = {
            email: this.email
        };

        axios.post('/api/reset-password', data).then(
            response => {
                console.log(response);
                this.setState({
                    message: response.data,
                    cls: 'success'
                });
            }
        ).catch(
            err => {
                console.log(err);
                this.setState({
                    message: err.response.data,
                    cls: 'danger'
                });
            }
        )

    };

    render() {

        let message = '';
        if (this.state.message) {

            const cls = 'alert alert-' + this.state.cls;

            message = (
                <div className={cls} role="alert">
                    {this.state.message}
                </div>
            )
        }

        return (
            <form onSubmit={this.handleSubmit}>
                {message}

                <h3>Parolni tiklash</h3>

                <div className="form-group mb-3">
                    <label>Email</label>
                    <input type="email" className="form-control" placeholder="Email"
                           onChange={e => this.email = e.target.value}/>
                </div>

                <div className="d-grid gap-2">
                    <button className="btn btn-primary btn-block">Jo'natish</button>
                </div>
            </form>
        );
    }
}

export default Forgot;