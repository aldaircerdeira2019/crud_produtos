

require('./bootstrap');

window.Vue = require('vue');

Vue.component('produtos', require('./components/site/produtos.vue').default);

const app = new Vue({
    el: '#app',
});
