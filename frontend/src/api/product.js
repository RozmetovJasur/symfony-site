import {$host, $authHost} from "./http";

export const fetchProducts = async () => {
    const {data} = await $host.get('/api/products')
    return data
}

export const fetchOneProduct = async (id) => {
    const {data} = await $host.get('api/products/' + id)
    return data
}

export const fetchProductsById = async (id) => {
    const {data} = await $host.get('api/products-by-id/' + id)
    return data
}