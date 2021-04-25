import axios from 'axios';

export default {
    find(id) {
        return axios.get(`/api/publications/${id}`);
    },
};
