require('./bootstrap');

window.Vue = require('vue');

/** Views */
Vue.component('species', require('./views/Species').default);
Vue.component('users', require('./views/Users').default);
Vue.component('user-profile', require('./views/UserProfile').default);

/** Components */

window.Event = new Vue()

const app = new Vue({
    el: '#app',
});
