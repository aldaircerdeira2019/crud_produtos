

require('./bootstrap');

import Vue from 'vue'
import money from 'v-money'
window.Vue = require('vue');

Vue.use(money, {precision: 4})
Vue.component('produtos', require('./components/site/produtos.vue').default);
Vue.component('create', require('./components/site/produto.create.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));

const app = new Vue({
    el: '#app',
});
