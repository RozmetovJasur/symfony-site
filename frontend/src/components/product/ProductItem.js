import React, {Component, useContext} from 'react';
import {Button, Card, Row} from "react-bootstrap";
import {BASE_DEV_APP_API_URL} from "../../utils/consts";

const ProductItem = ({product}) => {
    return (
        <div className="col-2 mt-3">
            <Card style={{width: '18rem'}}>
                <Card.Img variant="top" src={BASE_DEV_APP_API_URL + '/' + product.image}/>
                <Card.Body>
                    <Card.Title>{product.name}</Card.Title>
                    <Card.Text>
                        {product.price} $
                    </Card.Text>
                </Card.Body>
                <Card.Footer>
                    <Button variant="success" style={{marginRight: 3}}>Buy one click</Button>
                    <Button variant="primary">Buy</Button>
                </Card.Footer>
            </Card>
        </div>
    );
}

export default ProductItem;