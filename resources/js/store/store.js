import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
import * as types from './mutation-types';

Vue.use(Vuex);

const URL = process.env.MIX_APP_URL;

export const store = new Vuex.Store({
    state: {
        user: {
            id: '',
            email: '',
            name: '',
            last_login: '',
            role: '',
        },

        authenticated: false
    },
    getters: {

        getUser: state => {
            return state.user
        },

        isAuthenticated: state => {
            return state.authenticated
        }

    },
    mutations: {

        [types.USER](state, data) {
            state.user = data;
        },

        [types.AUTHENTICATED](state, data, token) {
            state.authenticated = data;
            localStorage.setItem('jwt', token);

        },

        /*authSuccess(state, token) {
            state.authenticated = true;
            localStorage.setItem('jwt', token);
        }*/

    },

    actions: {
        login({ commit }, user) {
            return new Promise((resolve, reject) => {

                let config = {
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                }

                let data = {
                    email: user.email,
                    password: user.password
                }

                console.log(URL);

                axios.post(URL + '/api/v1/login', data, config)
                    .then(response => {
                        commit(AUTHENTICATED, true, response.data.token)
                        commit(USER, response.data.data)
                        resolve($response)
                    })
                    .catch(error => {
                        reject(error)
                    });

            })
        }
    }



});

export default store;