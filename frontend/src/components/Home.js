import React, {Component} from 'react';
import axios from "axios";

class Home extends Component {
    render() {
        if (this.props.user){
            return (
                <h3>Salomlar {this.props.user.email}</h3>
            )
        }

        return (
            <h3>Siz login bo'lmadingiz</h3>
        );
    }
}

export default Home;