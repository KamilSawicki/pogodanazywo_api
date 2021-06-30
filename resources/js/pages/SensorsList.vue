<template>
    <div class="sensorsList">
        <div class="your-sensors" v-if="$store.state.isAuthenticated">
            <h1>Twoje czujniki</h1>
            <router-link :to="{name: 'new-sensor'}" class="new-sensor">Dodaj</router-link>
        </div>
        <div v-if="sensors.hasOwnProperty('user') && $store.state.isAuthenticated">
            <table v-if="sensors.user.length!==0">
                <tr v-for="sensor in sensors.user" v-bind:key="sensor.id" @click="selectSensor(sensor.id)">
                    <td>{{ sensor.city }}</td>
                    <td>Wybierz</td>
                </tr>
            </table>
            <div class="no-sensors" v-if="sensors.user.length===0">Nie posiadasz jeszcze własnych czujników</div>
        </div>
        <h1>Inne czujniki</h1>
        <table>
            <tr v-for="sensor in sensors.all" v-bind:key="sensor.id">
                <td>{{ sensor.city }}</td>
                <td @click="selectSensor(sensor.id)">Wybierz</td>
            </tr>
        </table>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name: "SensorsList",
    data: () => {
        return {
            sensors: {
                user: [],
                all: []
            }
        }
    },
    methods: {
        selectSensor(sensorId) {
            this.$store.commit('setSensor', sensorId)
            this.$router.push({name: 'Home'})
        }
    },
    mounted() {
        axios.get(`/api/sensor/`)
            .then(response => {
                this.sensors = response.data.sensors
            })
    }
}
</script>

<style scoped>
.sensorsList {
    color: #999999;
}

table {
    width: 100%;
}

.your-sensors {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.new-sensor {
    height: min-content;
    background-color: #fff;
    color: #000;
    border: none;
    border-radius: .5rem;
    display: flex;
    justify-content: center;
    background-image: url("/images/plus.svg");
    padding: 0.3rem 0.3rem 0.3rem 1.8rem;
    background-size: 1.3rem;
    background-repeat: no-repeat;
    background-position: .3rem center;
}
</style>
