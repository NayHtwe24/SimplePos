/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');



window.Vue = require('vue');
import axios from 'axios'
import VueRouter from "vue-router";
import AddOrders from "./components/AddOrders";
if (window.Vue) {
  window.Vue.use(VueRouter);
}


// Vue.component(
//     "test",
//     require("./components/Test.vue").default
// );
Vue.component(
    "cart",
    require("./components/OrderList.vue").default
);

const router = new VueRouter({
    mode: "history",
    routes: [{
            path: "/pos",
            component: AddOrders
        }
    ]
});





const pos = new Vue({
    el: '#pos',
    router
});
