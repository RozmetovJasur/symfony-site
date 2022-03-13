import {$host, $authHost} from "./http";

export const signUp = async (email, password) => {
    const response = await $host.post('api/sign-up', {email, password})
    return response
}
export const login = async (email, password) => {
    const response = await $host.post('api/login', {email, password})
    localStorage.setItem('token', response.data.token);
    return response
}
export const checkToken = async () => {
    const response = await $authHost.get('api/check')
    localStorage.setItem('token', response.data);
    return response
}