import React, {Component} from 'react';
import axios from "axios";
import {Redirect} from "react-router-dom";

class ResetPassword extends Component {
    state = {};
    handleSubmit = e => {
        e.preventDefault();
        const data = {
            "plainPassword": {
                "first": this.password,
                "second": this.confirmPassword,
            }
        };

        axios.post('/api/reset-password/reset/' + this.props.match.params.id, data).then(
            response => {
                console.log(response);
                this.setState({
                    reset: true
                });
            }
        )
    }

    render() {

        if (this.state.reset) {
            return <Redirect to={'/login'}/>
        }

        return (
            <form onSubmit={this.handleSubmit}>
                <h3>Yangi parol o'rnatish</h3>

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
                    <button className="btn btn-primary btn-block">Jo'natish</button>
                </div>
            </form>
        );
    }
}

export default ResetPassword;