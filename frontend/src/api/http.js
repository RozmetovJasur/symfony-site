import axios from "axios";

const $host = axios.create({
    baseURL: process.env.NODE_ENV === 'development' ? 'http://learn.loc' : 'http://learn.loc',
});

const $authHost = axios.create({
    baseURL: process.env.NODE_ENV === 'development' ? 'http://learn.loc' : 'http://learn.loc',
})

const authInterceptor = config => {
    config.headers.Authorization = `Bearer ${localStorage.getItem('token')}`
    return config;
}

$authHost.interceptors.request.use(authInterceptor);

export {
    $host,
    $authHost
}