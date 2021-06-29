require('./bootstrap');

window.Vue = require('vue').default;

import router from './router/index';
import App from './App.vue';

const app = new Vue({
    router,
    el: '#app',
    render: h => h(App)
});
