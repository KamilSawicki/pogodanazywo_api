<template>
  <div class="new-sensor">
    <div class="from">
      <h1>Dodawanie nowego czujnika</h1>
      <h2> Podaj wymagane dane:</h2>
      <ul>
        <li>
          Miejscowość: nazwa opisująca lokalizację Twojego czujnika
        </li>
        <li>
          Kod pocztowy: kod pocztowy czujnika musi zawierać minimum 5 znaków, nie będzie publikowany
        </li>
        <li>
          Wysokość nad poziomem morza: wysokość podana w metrach
        </li>
      </ul>

      <div class="alert" v-show="error">Podane dane są niewłaściwe</div>

      <input type="text" class="form-control" placeholder="Miejscowość" v-model="name">
      <input type="text" class="form-control" placeholder="Kod pocztowy" v-model="zipcode">
      <input type="number" class="form-control" placeholder="Wysokość na poziomem morza" v-model="masLevel">
      <button class="btn" @click="submit">Dodaj</button>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: "NowSensor",
  data: ()=>{
    return {
      name: null,
      zipcode: null,
      masLevel: null,
      error: false
    }
  },
  methods:{
    submit(){
      axios.post(`/api/sensor/`,
          {
            'city': this.name,
            'zip_code': this.zipcode,
            'above_see': this.masLevel
          })
      .then(response=>{
        if('error' in response.data){
          this.error=response.data.error
        }
        else{
          this.$router.push({
            name: 'new-sensor-summary',
            params: {sensorId: response.data.sensor.id, accessToken: response.data.api_token}
          })
        }
      })
    }
  }
}
</script>

<style scoped>

</style>
