<template>
    <div class="home">
        <div class="header">
            <div class="city">{{city}}</div>
            <div class="actual">
                <div class="temperature"><span class="value">{{actual.temperature}}</span><span class="unit">°C</span>
                </div>
            </div>
        </div>
        <div class="charts">
            <Chart
                v-if="history.chartReady"
                :labels="history.labels"
                :humidity="history.humidity"
                :pressure="history.pressure"
                :temperature="history.temperature"
            />
        </div>
    </div>
</template>

<script>
import Chart from "../components/Chart"
import axios from 'axios'

export default {
    components: {Chart},
    data: () => {
        return {
            city: 'Grabownica Starzeńska',
            actual: {
                temperature: 25
            },
            history: {
                labels: [],
                pressure: [],
                humidity: [],
                temperature: [],
                chartReady: false
            }
        }
    },
    mounted() {
        this.fetchData()
    },
    methods: {
        async fetchData(){
            const response = await axios.get('/api/history/day/')

            this.history.labels = []
            this.history.pressure = []
            this.history.humidity = []
            this.history.temperature = []

            this.history = response.data.history

            this.history.chartReady = true
        }
    }
}
</script>

<style scoped>
.header {
    height: 100vh;
}

.actual {
    height: 70%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.value{
    font-size: 6em;
}

.unit{
    font-size: 3em;
}

.city {
    position: absolute;
    top: 50%;
    left: -42vh;
    transform: translateY(-50%) rotate(270deg);
    font-size: 1.5em;
    width: 90vh;
    text-align: center;
    letter-spacing: 1rem;
    text-transform: uppercase;
}
</style>
