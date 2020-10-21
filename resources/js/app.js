

require('./bootstrap');

window.Vue = require('vue');

Vue.component('produtos', require('./components/site/produtos.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));

const app = new Vue({
    el: '#app',
});
