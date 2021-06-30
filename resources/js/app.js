require('./bootstrap')

window.Vue = require('vue').default

import router from './router/index'
import App from './App.vue'
import store from './store'

new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app')

