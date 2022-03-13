import {makeAutoObservable} from "mobx";

export default class ProductStore {
    constructor() {
        this._categories = [
            {id: 1, name: "Telefon"},
            {id: 2, name: "Xolodelnik"},
        ];
        this._brands = [
            {id: 1, name: "Samsung"},
            {id: 2, name: "LG"},
        ];
        this._products = []
        makeAutoObservable(this);
    }

    setCategories(categories) {
        this._categories = categories;
    }

    setBrands(brands) {
        this._brands = brands;
    }

    setProducts(products) {
        this._products = products;
    }

    get categories() {
        return this._categories;
    }

    get brands() {
        return this._brands;
    }

    get products() {
        return this._products;
    }
}