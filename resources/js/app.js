import App from "./components/App";
import Router from "./router";
import Store from "./store/store"
require('./bootstrap');
window.Vue = require('vue');


const app = new Vue({
    el: '#app',
    router: Router,
    store: Store,
    render: h => h(App)
});
