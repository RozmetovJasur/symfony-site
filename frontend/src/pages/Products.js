import React, {Component, useContext, useEffect} from 'react';
import {Col, Container, Row} from "react-bootstrap";
import ProductList from "../components/product/ProductList";
import {fetchProducts} from "../api/product";
import {Context} from "../index";

const Products = () => {
    const {product} = useContext(Context)

    useEffect(() => {
        fetchProducts().then(data => {
            product.setProducts(data.items)
        })
    }, [])

    return (
        <div className="container-fluid">
            <ProductList/>
        </div>
    );
}

export default Products;