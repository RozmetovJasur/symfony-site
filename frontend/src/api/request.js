import axios from 'axios'
const request = axios.create({
    baseURL: process.env.NODE_ENV === 'development' ? 'http://learn.loc': 'http://learn.loc',
    headers: {
        'Accept': 'application/json',
    }
});
request.interceptors.request.use(config => {
    const jwtToken = localStorage.getItem('token');

    if (jwtToken) {
        config.headers['authorization'] = `Bearer ${jwtToken}`
    }

    return config
}, error => {
    // Do something with request error here
    Promise.reject(error)
});

export default request;