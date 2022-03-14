import React, {useContext, useEffect} from 'react';
import ProductList from "../components/product/ProductList";
import {fetchProducts} from "../api/product";
import {Context} from "../index";

const Products = () => {
    const {product} = useContext(Context)

    useEffect(() => {
        fetchProducts().then(data => {
            product.setProducts(data.items)
        });
        return () => {
            product.setProducts([]);
        }
    }, [])

    return (
        <div className="container-fluid">
            <ProductList/>
        </div>
    );
}

export default Products;