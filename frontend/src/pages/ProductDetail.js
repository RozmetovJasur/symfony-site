import React, {useContext, useEffect, useState} from 'react';
import {Button, Card, Col, Container, Image, Row} from "react-bootstrap";
import {useParams} from 'react-router-dom'
import {fetchOneProduct} from "../api/product";
import {BASE_DEV_APP_API_URL} from "../utils/consts";
import {Context} from "../index";

const ProductDetail = () => {

    const {cart} = useContext(Context);

    const [product, setProduct] = useState({})
    const {id} = useParams()
    useEffect(() => {
        fetchOneProduct(id).then(data => setProduct(data))
    }, [])

    return (
        <Container className="mt-3">
            <Row>
                <Col md={4}>
                    <Image width={300} height={300} src={BASE_DEV_APP_API_URL + '/' + product.image}/>
                </Col>
                <Col md={4}>
                    <Row className="d-flex flex-column align-items-center">
                        <h2>{product.name}</h2>
                        {product.rating}
                    </Row>
                </Col>
                <Col md={4}>
                    <Card
                        className="d-flex flex-column align-items-center justify-content-around"
                        style={{width: 300, height: 300, fontSize: 32, border: '5px solid lightgray'}}
                    >
                        <h3>Price: {product.price} $.</h3>
                        <Button variant={"outline-dark"} onClick={() => cart.plusCount(product)}>Add to cart</Button>
                    </Card>
                </Col>
            </Row>
            <Row className="d-flex flex-column m-3">
                <h1>Description</h1>
                <Row key={product.id} style={{background: 1 % 2 === 0 ? 'lightgray' : 'transparent', padding: 10}}>
                    {product.category ? product.category.title : null}
                    <p>
                        {product.content}
                    </p>

                </Row>
            </Row>
        </Container>
    );
};

export default ProductDetail;