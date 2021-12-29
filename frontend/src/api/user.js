import api from "./request";

export const fetchUser = () =>
    api.get('/api/user').then(({data}) => data);