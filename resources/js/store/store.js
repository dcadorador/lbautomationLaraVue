import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

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
    },
    getters: {

        getUser: state => {
            return state.user
        },

    },
    mutations: {

        auth_success(state, token) {
            localStorage.setItem('jwt', token);
        },

        auth_user_success(state, user) {
            state.user = user;
            localStorage.setItem('user', JSON.stringify(user));
        }

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

                axios.post(URL + '/api/v1/login', data, config)
                    .then(response => {
                        commit('auth_success', response.data.token)
                        commit('auth_user_success', response.data.data)
                        resolve(response)
                    })
                    .catch(error => {
                        //console.log(error.message)
                        reject(error.message)
                    });

            })
        }
    }



});

export default store;
