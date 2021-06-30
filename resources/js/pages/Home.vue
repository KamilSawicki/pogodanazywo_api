<template>
    <div class="home">
        <h1>{{city}}</h1>
        <ActualTiles v-bind:temperature="actual.temperature"
                     v-bind:humidity="actual.humidity"
                     v-bind:pressure="actual.pressure">
        </ActualTiles>
        <div class="range-switch">
            <div class="range" v-bind:class="{active: range===1}" @click="setRange(1)">Ostatnia doba</div>
            <div class="range" v-bind:class="{active: range===7}" @click="setRange(7)">Ostatni tydzień</div>
            <div class="range" v-bind:class="{active: range===30}" @click="setRange(30)">Ostatni miesiąc</div>
            <div class="range" v-bind:class="{active: range===365}" @click="setRange(365)">Ostatni rok</div>
        </div>
        <Charts
            v-bind:labels="measurements.labels"
            v-bind:temperature="measurements.temperature"
            v-bind:max_temperature="measurements.maxTemperature"
            v-bind:min_temperature="measurements.minTemperature"
            v-bind:humidity="measurements.humidity"
            v-bind:max_humidity="measurements.maxHumidity"
            v-bind:min_humidity="measurements.minHumidity"
            v-bind:pressure="measurements.pressure"
            v-bind:max_pressure="measurements.maxPressure"
            v-bind:min_pressure="measurements.minPressure"
            v-if="ready"
        ></Charts>
        <div class="loading" v-if="!ready">
            <img src="/images/loading_long.svg" alt="loading">
        </div>
    </div>
</template>

<style scoped>
.home {
    height: 100%;
}

h1{
    text-align: center;
    letter-spacing: .75rem;
    color: #fff;
    line-height: 0em;
}

.range-switch {
    display: flex;
    color: #fff;
    width: calc(100% - 8px);
    justify-content: space-between;
    align-items: center;
    margin: .3rem auto;
}


.range {
    width: 25%;
    text-align: center;
    height: 100%;
    border-top: 2px solid #fff;
    border-bottom: 2px solid #fff;
    padding: .5rem 0;
    cursor: pointer;
}

.range:first-child {
    border-radius: 1rem 0 0 1rem;
    border-left: 2px solid #fff;
}

.range:last-child {
    border-radius: 0 1rem 1rem 0;
    border-right: 2px solid #fff;
}

.active {
    background-color: #fff;
    color: #000
}

.loading {
    height: 100%;
    text-align: center;
}

.loading img {
    width: 200px;
    margin-top: 5rem;
}

@media (max-width: 768px) {
    .range {
        height: 3em;
        text-align: center;
        vertical-align: center;
    }
}
</style>

<script>
import ActualTiles from "../components/ActualTiles";
import Charts from "../components/Charts";
import axios from 'axios';

export default {
    name: 'Home',
    components: {ActualTiles, Charts},
    data: () => {
        return {
            range: 1,
            ready: false,
            city: '...',
            measurements: {
                labels: null,
                temperature: null,
                minTemperature: null,
                maxTemperature: null,
                humidity: null,
                maxHumidity: null,
                minHumidity: null,
                pressure: null,
                maxPressure: null,
                minPressure: null,
            },
            actual: {
                humidity: '...',
                pressure: '...',
                temperature: '...'
            }
        }
    },
    methods: {
        setRange(range) {
            this.ready = false
            this.range = range

            let url;

            switch (range) {
                case 1:
                    url = `/api/history/day/${this.$store.state.sensor}`
                    break;
                case 7:
                    url = `/api/history/week/${this.$store.state.sensor}`
                    break;
                case 30:
                    url = `/api/history/month/${this.$store.state.sensor}`
                    break;
                case 365:
                    url = `/api/history/year/${this.$store.state.sensor}`
                    break;
            }

            this.makeRequest(url)
        },
        makeRequest(url) {
            axios.get(url)
                .then(r => {
                    this.measurements.labels = r.data.labels

                    this.measurements.humidity = r.data.humidity
                    this.measurements.pressure = r.data.pressure
                    this.measurements.temperature = r.data.temperature

                    this.measurements.minHumidity = r.data.min_humidity
                    this.measurements.minPressure = r.data.min_pressure
                    this.measurements.minTemperature = r.data.min_temperature

                    this.measurements.maxHumidity = r.data.max_humidity
                    this.measurements.maxPressure = r.data.max_pressure
                    this.measurements.maxTemperature = r.data.max_temperature

                    this.ready = true
                }).catch(e => {
                console.log(e)
            })
        }
    },
    mounted() {
        if(this.$store.state.sensor == null){
            this.$router.push({name: 'Sensors'})
        }
        else {
            axios.get(`/api/weather/${this.$store.state.sensor}`)
                .then(r => {
                    this.ready = false

                    this.city = r.data.city

                    this.measurements.labels = r.data.history.labels

                    this.measurements.humidity = r.data.history.humidity
                    this.measurements.pressure = r.data.history.pressure
                    this.measurements.temperature = r.data.history.temperature

                    this.measurements.minHumidity = r.data.history.min_humidity
                    this.measurements.minPressure = r.data.history.min_pressure
                    this.measurements.minTemperature = r.data.history.min_temperature

                    this.measurements.maxHumidity = r.data.history.max_humidity
                    this.measurements.maxPressure = r.data.history.max_pressure
                    this.measurements.maxTemperature = r.data.history.max_temperature

                    this.actual.humidity = r.data.actual.humidity
                    this.actual.pressure = r.data.actual.pressure
                    this.actual.temperature = r.data.actual.temperature

                    this.ready = true
                }).catch(e => {
                console.log(e)
            })
        }
    }
}
</script>
