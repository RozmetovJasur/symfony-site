import React, {useContext, useEffect, useState} from "react";
import {observer} from "mobx-react-lite";
import {Context} from "../index";
import {confirmAlert} from "react-confirm-alert";
import {fetchProductsById} from "../api/product";
import {Row, Spinner} from "react-bootstrap";
import ProductItem from "../components/product/ProductItem";

const Wishlist = observer(() => {
    const {wishlist, cart} = useContext(Context);

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
                        wishlist.remove(item)
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
        if (wishlist.items.length > 0) {
            try {
                fetchProductsById(wishlist.itemIds).then(data => {
                    setProducts(data);
                }).finally(() => setLoading(false))
            } catch (e) {

            }
        } else
            setLoading(false)
    }, [wishlist.items])

    if (loading) {
        return <Spinner animation={"grow"}/>
    }


    return (

        <Row className="text-center">
            {
                products.map(product =>
                    <ProductItem key={product.id} product={product} cart={cart}/>
                )
            }
        </Row>
    )
})
export default Wishlist;