import {makeAutoObservable} from "mobx";
import {Button, notification} from 'antd';

export default class CartStore {
    constructor() {
        if (localStorage.getItem('cart') != null) this._items = JSON.parse(localStorage.getItem('cart')); else this._items = [];
        makeAutoObservable(this);
    }

    setItems(items) {
        this._items = items;
    }

    plusCount(product) {
        let items = this._items;
        const exist = items.find((x) => x.id === product.id);
        if (exist) {
            items = items.map(value => (value.id === product.id ? {...value, qty: exist.qty + 1} : value))
        } else {
            items.push({id: product.id, qty: 1});
        }

        this.setItems(items)
        localStorage.setItem('cart', JSON.stringify(items));

        notification.open({
            type: 'success',
            message: 'Successfully added to the cart',
            description:
                'Successfully added to the cart',
            onClick: () => {
                console.log('Notification Clicked!');
            },
        });

    };

    minusCount(product) {
        let items = this._items;
        const exist = items.find((x) => x.id === product.id);
        if (exist) {
            items = items.map(value => (value.id === product.id ? {...value, qty: exist.qty - 1} : value))
            items = items.filter(item => item.qty > 0)
        }
        this.setItems(items)
        localStorage.setItem('cart', JSON.stringify(items));

        notification.open({
            type: 'success',
            message: 'Successfully minus count the cart',
            description:
                'Successfully minus count the cart',
            onClick: () => {
                console.log('Notification Clicked!');
            },
        });
    };

    remove(product) {
        let items = this._items;
        items = items.filter(item => item.id !== product.id)
        this.setItems(items)
        localStorage.setItem('cart', JSON.stringify(items));
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

    get totalCount() {
        let count = 0;
        this._items.map(value => {
            count += value.qty;
        })
        return count;
    }

     totalPrice(products) {
        let price = 0;
        this._items.map(value => {
            let product = products.find(v => {
                if (v.id === value.id)
                    return v;
            })

            price += product.price * value.qty;
        })
        return price;
    }
}