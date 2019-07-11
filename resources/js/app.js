require('./bootstrap');

window.Vue = require('vue');

/** Views */
Vue.component('species', require('./views/Species').default);
Vue.component('breeds', require('./views/Breeds').default);
Vue.component('users', require('./views/Users').default);
Vue.component('user-profile', require('./views/UserProfile').default);

/** Components */
Vue.component('toastr', require('./components/Toastr').default);

window.Event = new Vue()
window.flash = function(message) {
    Event.$emit('flash', message);
};

const app = new Vue({
    el: '#app',
});
