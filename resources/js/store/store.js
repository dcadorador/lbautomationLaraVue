import Vue from 'vue';
import Vuex from 'vuex';
import * as types from './mutation-types';

Vue.use(Vuex);

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

       [types.AUTHENTICATED](state, data) {
           state.authenticated = data;
       }

    },

    actions: {
        authentication: ( {commit}, data ) => {
            //
            commit(types.USER, {
                id: 1,
                name: 'Drew',
                email: 'drew@email.com',
                role: 'admin' ,
            })
        }
    }



});

export default store;
