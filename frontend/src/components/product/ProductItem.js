import React, {Component, useContext, useEffect, useState} from 'react';
import {Button, Card, Row} from "react-bootstrap";
import {BASE_DEV_APP_API_URL, ROUTE_PRODUCT} from "../../utils/consts";
import {useHistory} from "react-router-dom";
import {Context} from "../../index";

const ProductItem = ({product}) => {
    const {cart} = useContext(Context);
    const history = useHistory();

    return (
        <div className="col-2 mt-3">
            <Card style={{width: '18rem'}}>
                <Card.Img onClick={() => history.push(ROUTE_PRODUCT + '/' + product.id)} variant="top"
                          src={BASE_DEV_APP_API_URL + '/' + product.image}/>
                <Card.Body>
                    <Card.Title>{product.title}</Card.Title>
                    <Card.Text>
                        {product.price} $
                    </Card.Text>
                </Card.Body>
                <Card.Footer>
                    <Button variant="success" style={{marginRight: 3}}>Buy one click</Button>
                    <Button variant="primary" onClick={() => cart.add(product)}>Buy</Button>
                </Card.Footer>
            </Card>
        </div>
    );
}

export default ProductItem;