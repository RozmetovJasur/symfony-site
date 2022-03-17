import React, {Component, useContext} from 'react';
import {Context} from "../index";

const Cart = () => {
    const {cart} = useContext(Context);

    return (
        <div>{
            cart.items.map(function (value, idx) {
                return (<div>{value.id} {value.qty} </div>)
            })

        }
        </div>
    );
}

export default Cart;