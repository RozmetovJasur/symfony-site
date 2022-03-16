import React, {Component, useContext} from 'react';
import {Row} from "react-bootstrap";
import {Context} from "../../index";
import ProductItem from "./ProductItem";
import {observer} from "mobx-react-lite";

const ProductList = observer(() => {
    const {product,cart} = useContext(Context);

    return (
        <Row className="text-center">
            {
                product.products.map(product =>
                    <ProductItem key={product.id} product={product} cart={cart}/>
                )
            }
        </Row>
    );
})

export default ProductList;