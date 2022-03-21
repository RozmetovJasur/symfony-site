import 'bootstrap';
import React, {createContext} from 'react';
import ReactDOM from 'react-dom';
import App from './App';
import UserStore from "./store/UserStore";
import ProductStore from "./store/ProductStore";
import CartStore from "./store/CartStore";
import "antd/dist/antd.css";
import WishlistStore from "./store/WishlistStore";

export const Context = createContext(null);

ReactDOM.render(
    <Context.Provider value={{
        user: new UserStore(),
        product: new ProductStore(),
        cart: new CartStore(),
        wishlist: new WishlistStore()
    }}>
        <React.StrictMode>
            <App/>
        </React.StrictMode>
    </Context.Provider>,
    document.getElementById('root')
);