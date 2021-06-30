import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../pages/Home.vue'
import Login from "../pages/Login";
import SensorsList from "../pages/SensorsList";
import NewSensor from '../pages/NewSensor'
import NewSensorSummary from '../pages/NewSensorSummary'

Vue.use(VueRouter)

const routes = [
    {
        path: '/', name: 'Home', component: Home
    },
    {
        path: '/login', name: 'Login', component: Login
    },
    {
        path: '/sensors', name: 'Sensors', component: SensorsList
    },
    {
        path: '/new-sensor', name: 'new-sensor', component: NewSensor
    },
    {
        path: '/new-sensor-summary',  name: 'new-sensor-summary', component: NewSensorSummary
    }
]

const router = new VueRouter({
    routes
})

export default router
