import React, {Component, useContext, useEffect, useState} from 'react';
import {Context} from "../index";
import "../assets/css/cart.css"
import {BASE_DEV_APP_API_URL} from "../utils/consts";
import 'react-confirm-alert/src/react-confirm-alert.css'; // Import css
import {Spinner} from "react-bootstrap";
import {fetchProductsById} from "../api/product";
import {observer} from "mobx-react-lite";
import {confirmAlert} from "react-confirm-alert";

const Cart = observer(() => {
    const {cart} = useContext(Context);

    const [loading, setLoading] = useState(true);
    const [products, setProducts] = useState([]);
    const remove = (item) => {
        confirmAlert({
            title: 'Are you sure?',
            message: 'You want to delete this item?',
            buttons: [
                {
                    label: 'Yes',
                    onClick: () => {
                        cart.remove(item)
                    }
                },
                {
                    label: 'No',
                    onClick: () => {
                    }
                }
            ]
        });
    };

    useEffect(() => {
        if (cart.items.length > 0) {
            try {
                fetchProductsById(cart.itemIds).then(data => {
                    setProducts(data);
                }).finally(() => setLoading(false))
            } catch (e) {

            }
        } else
            setLoading(false)
    }, [cart.items])

    if (loading) {
        return <Spinner animation={"grow"}/>
    }

    return (
        <section className="h-100 gradient-custom">
            <div className="container py-5">
                <div className="row d-flex justify-content-center my-4">
                    <div className="col-md-8">
                        <div className="card mb-4">
                            <div className="card-header py-3">
                                <h5 className="mb-0">Cart - {cart.items.length} items</h5>
                            </div>
                            <div className="card-body">
                                {products.map((item) => {
                                    let cartItem = cart.items.find(v => {
                                        if (item.id === v.id) {
                                            return v;
                                        }
                                    })
                                    if (cartItem == null)
                                        return false;
                                    return (
                                        <div className="row">
                                            <div className="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                                <div className="bg-image hover-overlay hover-zoom ripple rounded"
                                                     data-mdb-ripple-color="light">
                                                    <img
                                                        src={BASE_DEV_APP_API_URL + '/' + item.image}
                                                        className="w-100" alt="Blue Jeans Jacket"/>
                                                </div>
                                            </div>

                                            <div className="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                                <p><strong>Blue denim shirt</strong></p>
                                                <p>Color: blue</p>
                                                <p>Size: M</p>
                                                <button type="button" className="btn btn-primary btn-sm me-1 mb-2"
                                                        data-mdb-toggle="tooltip"
                                                        onClick={() => remove(item)}
                                                        title="Remove item">
                                                    <i className="fa fa-trash"></i>
                                                </button>
                                                <button type="button" className="btn btn-danger btn-sm mb-2"
                                                        data-mdb-toggle="tooltip"
                                                        title="Move to the wish list">
                                                    <span className="fa fa-heart"></span>
                                                </button>

                                            </div>


                                            <div className="col-lg-4 col-md-6 mb-4 mb-lg-0">
                                                <div className="d-flex mb-4">
                                                    <button className="btn btn-success btn-ms  px-3 me-2"
                                                            onClick={() => cart.minusCount(item)}
                                                            style={{height: 40}}>
                                                        <i className="fa fa-minus"></i>
                                                    </button>

                                                    <div className="form-outline" style={{width: 50}}>
                                                        <input id="form1" min="0" name="quantity" value={cartItem.qty}
                                                               type="number"
                                                               className="form-control"/>
                                                        <label className="form-label" htmlFor="form1">Quantity</label>
                                                    </div>

                                                    <button className="btn btn-success px-3 ms-2"
                                                            onClick={() => cart.plusCount(item)} style={{height: 40}}>
                                                        <i className="fa fa-plus"></i>
                                                    </button>
                                                </div>

                                                <p className="text-start text-md-center">
                                                    <strong>$ {item.price}</strong>
                                                </p>
                                            </div>
                                        </div>
                                    )
                                })}
                                <hr className="my-4"/>
                            </div>
                        </div>
                        <div className="card mb-4">
                            <div className="card-body">
                                <p><strong>Expected shipping delivery</strong></p>
                                <p className="mb-0">12.10.2020 - 14.10.2020</p>
                            </div>
                        </div>
                        <div className="card mb-4 mb-lg-0">
                            <div className="card-body">
                                <p><strong>We accept</strong></p>
                                <img className="me-2" width="45px"
                                     src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/visa.svg"
                                     alt="Visa"/>
                                <img className="me-2" width="45px"
                                     src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/amex.svg"
                                     alt="American Express"/>
                                <img className="me-2" width="45px"
                                     src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/mastercard.svg"
                                     alt="Mastercard"/>
                                <img className="me-2" width="45px"
                                     src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce/includes/gateways/paypal/assets/images/paypal.png"
                                     alt="PayPal acceptance mark"/>
                            </div>
                        </div>
                    </div>
                    <div className="col-md-4">
                        <div className="card mb-4">
                            <div className="card-header py-3">
                                <h5 className="mb-0">Summary</h5>
                            </div>
                            <div className="card-body">
                                <ul className="list-group list-group-flush">
                                    <li
                                        className="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                        Products count
                                        <span>{cart.totalCount}</span>
                                    </li>
                                    <li
                                        className="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                        Products
                                        <span>{cart.totalPrice(products)} $</span>
                                    </li>
                                    <li className="list-group-item d-flex justify-content-between align-items-center px-0">
                                        Shipping
                                        <span>Gratis</span>
                                    </li>
                                    <li
                                        className="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                        <div>
                                            <strong>Total amount</strong>
                                            <strong>
                                                <p className="mb-0">(including VAT)</p>
                                            </strong>
                                        </div>
                                        <span><strong>$53.98</strong></span>
                                    </li>
                                </ul>

                                <button type="button" className="btn btn-primary btn-lg btn-block">
                                    Go to checkout
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
})

export default Cart;