import axios from "axios";
import Vue from 'vue';

function createInstance(baseURL) {
    return axios.create({
        baseURL,
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${localStorage.getItem('jwt')}`,
            'Accept': 'application/json'
        }
    });
}

const API_URL = process.env.MIX_APP_URL;
const API = createInstance(API_URL);

export default {
    install() {
        Vue.prototype.$http = API
    }
}