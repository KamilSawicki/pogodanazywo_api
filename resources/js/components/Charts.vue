<template>
  <div class="charts">
    <line-chart-temperature
        class="box"
        v-bind:labels="labels"
        v-bind:data="temperature"
        v-bind:max_temperature="max_temperature"
        v-bind:min_temperature="min_temperature"
    ></line-chart-temperature>
    <line-chart-humidity
        class="box"
        v-bind:labels="labels"
        v-bind:data="humidity"
        v-bind:max_humidity="max_humidity"
        v-bind:min_humidity="min_humidity"
    ></line-chart-humidity>
    <line-chart-pressure
        class="box"
        v-bind:labels="labels"
        v-bind:data="pressure"
        v-bind:max_pressure="max_pressure"
        v-bind:min_pressure="min_pressure"
    ></line-chart-pressure>
  </div>
</template>

<script>
import LineChartTemperature from "../components/LineChartTemperature";
import LineChartHumidity from "../components/LineChartHumidity";
import LineChartPressure from "../components/LineChartPressure";

export default {
  components: {LineChartPressure, LineChartTemperature, LineChartHumidity},
  name: "Charts",
  props: ['labels',
    'temperature',
    'humidity',
    'pressure',
    'max_temperature',
    'min_temperature',
    'max_humidity',
    'min_humidity',
    'max_pressure',
    'min_pressure'],
  mounted() {
  }
}
</script>
