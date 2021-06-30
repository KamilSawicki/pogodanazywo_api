import Vue from 'vue'
import Vuex from 'vuex'
import VuexPersist from 'vuex-persist';

Vue.use(Vuex)

const vuexLocalStorage = new VuexPersist({
    key: 'vuex',
    storage: window.localStorage
})

export default new Vuex.Store({
    state: {
        email:null,
        isAuthenticated:false,
        sensor: null
    },
    mutations: {
        setAuthenticated(state, value){
            state.isAuthenticated=value
        },
        setEmail(state, value){
            state.email=value
        },
        setSensor(state, value){
            state.sensor=value
        },
        flushState(state){
            state.email=null
            state.isAuthenticated=false
        }
    },
    actions: {
    },
    modules: {
    },
    plugins: [vuexLocalStorage.plugin]
})
