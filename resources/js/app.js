require('./bootstrap');

window.Vue = require('vue').default;

import router from './router/index';
import App from './App.vue';
import VueApexCharts from 'vue-apexcharts'

Vue.use(VueApexCharts)

Vue.component('apexchart', VueApexCharts)

const app = new Vue({
    router,
    el: '#app',
    render: h => h(App)
});
