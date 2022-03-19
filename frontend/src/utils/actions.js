import './../utils/consts'
import {
    ROUTE_AUTH_LOGIN,
    ROUTE_AUTH_SIGN_UP,
    ROUTE_CART,
    ROUTE_HOME,
    ROUTE_PRODUCT, ROUTE_WISHLIST
} from "./consts";

import Home from "./../pages/Home";
import Cart from "./../pages/Cart";
import Products from "./../pages/Products";
import Login from "../pages/auth/Login";
import SignUp from "../pages/auth/SignUp";
import ProductDetail from "../pages/ProductDetail";
import Wishlist from "../pages/Wishlist";

export const privateRoutes = [
    {
        path: ROUTE_CART,
        Component: Cart
    }
];

export const publicRoutes = [
    {
        path: ROUTE_HOME,
        Component: Home
    },
    {
        path: ROUTE_AUTH_LOGIN,
        Component: Login
    },
    {
        path: ROUTE_AUTH_SIGN_UP,
        Component: SignUp
    },
    {
        path: ROUTE_PRODUCT,
        Component: Products
    },
    {
        path: ROUTE_PRODUCT + '/:id',
        Component: ProductDetail
    },
    {
        path: ROUTE_CART,
        Component: Cart
    },
    {
        path: ROUTE_WISHLIST,
        Component: Wishlist
    }
];