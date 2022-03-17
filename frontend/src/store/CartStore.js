import {makeAutoObservable} from "mobx";

export default class CartStore {
    constructor() {
        if (localStorage.getItem('cart') != null)
            this._items = JSON.parse(localStorage.getItem('cart'));
        else
            this._items = [];
        makeAutoObservable(this);
    }

    setItems(items) {
        this._items = items;
    }

    add(product) {
        let items = this._items;
        const exist = items.find((x) => x.id === product.id);
        if (exist) {
            items = items.map(value => (value.id === product.id ? {...value, qty: exist.qty + 1} : value))
        } else {
            items.push({id: product.id, qty: 1});
        }

        this.setItems(items)
        localStorage.setItem('cart', JSON.stringify(items));
    };

    get items() {
        return this._items;
    }
}