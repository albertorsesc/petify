require('./bootstrap');

window.Vue = require('vue');

/** Views */
Vue.component('species', require('./views/Species').default);

/** Components */

window.Event = new Vue()

const app = new Vue({
    el: '#app',
});
