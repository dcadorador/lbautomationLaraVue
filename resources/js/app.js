import App from "./components/App";
import Router from "./router";
import Store from "./store/store";
import http from "./http";
import MainLayout from "./components/layouts/MainLayout";

require('./bootstrap');
window.Vue = require('vue');

Vue.component('main-layout', MainLayout);
Vue.use(http);

const app = new Vue({
    el: '#app',
    router: Router,
    store: Store,
    render: h => h(App)
});
