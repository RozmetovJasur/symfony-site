import {makeAutoObservable} from "mobx";

export default class CartStore {
    constructor() {
        if (localStorage.getItem('cart') != null)
            this._items = localStorage.getItem('cart');
        else
            this._items = [];
        makeAutoObservable(this);
    }

    setItems(items) {
        this._items = items;
    }

    add(product) {
        const exist = this._items.find((x) => x.id === product.id);
        if (exist) {
            this._items.map((item) =>
                item.id === product.id ? {...exist, qty: exist.qty + 1} : item
            )
        } else {
            this._items = [...this._items, {...product, qty: 1}]
        }
        localStorage.setItem('cart', this._items);
    };

    get items() {
        return this._items;
    }
}