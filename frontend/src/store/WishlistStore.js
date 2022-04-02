import {makeAutoObservable} from "mobx";
import {Button, notification} from 'antd';

export default class WishlistStore {
    constructor() {
        if (localStorage.getItem('wishlist') != null)
            this._items = JSON.parse(localStorage.getItem('wishlist'));
        else this._items = [];

        makeAutoObservable(this);
    }

    setItems(items) {
        this._items = items;
    }

    add(product) {
        let items = this._items;
        const exist = items.find((x) => x.id === product.id);
        let message = "";
        if (exist) {
            items = items.filter(item => item.id !== product.id)
            message = "Successfully remove to the wishlist";
        } else {
            items.push({id: product.id});
            message = "Successfully added to the wishlist";
        }

        this.setItems(items)
        localStorage.setItem('wishlist', JSON.stringify(items));

        notification.open({
            type: 'success',
            message: message,
            description: message,
            onClick: () => {
                console.log('Notification Clicked!');
            },
        });

    };

    remove(product) {
        let items = this._items;
        items = items.filter(item => item.id !== product.id)
        this.setItems(items)
        localStorage.setItem('wishlist', JSON.stringify(items));
    };

    get items() {
        return this._items;
    }

    get itemIds() {
        let ids = '?';
        this._items.map(value => {
            ids = ids + 'id[]=' + value.id + '&';
        });
        return ids;
    }
}