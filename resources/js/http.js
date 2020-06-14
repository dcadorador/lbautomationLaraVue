import axios from "axios";
import Vue from 'vue';

function createInstance(baseURL) {
    let apiHeaders = {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${localStorage.getItem('jwt')}`,
        'Accept': 'application/json',
    };

    console.log(apiHeaders);

    return axios.create({
        baseURL,
        headers: apiHeaders
    });
}

const API_URL = process.env.MIX_APP_URL;
const API = createInstance(API_URL);

export default {
    install() {
        Vue.prototype.$http = API
    }
}
