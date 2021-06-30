<template>
  <div class="new-sensor-summary">
    <h1>Czujnik dodany</h1>
    <h2>Twój klucz dostępowy to:</h2>
    <input type="text" readonly v-model="accessToken" class="token">
    <p>Zapisz ten klucz i użyj go aby uzyskać dostęp do API.</p>
    <h2>Konfiguracja czujnika</h2>
    <p>Program kliencki przedstawiony jest przy użyciu komputera Raspberry Pi oraz czujnika Bosh BME280.</p>
    <p>Czujnik i komputer należy połączyć według poniższego schematu:</p>
    <div class="blueprint">
      <img src="/images/blueprint.svg" alt="blueprint" class="blueprint">
      <div>
        <span class="vin legend">VIN</span>
        <span class="gnd legend">GND</span>
        <span class="scl legend">SCL</span>
        <span class="sda legend">SDA</span>
      </div>
    </div>
    <p>Aby pobrać archiwum z aplikacją kliecką wporowadź polecnie:</p>
    <input type="text" readonly value="wget http://pogodanazywo.pl/get-client" class="token">

    <p>Następnie wypakuj paczkę komendą:</p>
    <input type="text" readonly value="tar -xvf get-client" class="token">

    <p>Edytuj plik main.py przez wpisanie swojego klucza dostępu:</p>
    <input type="text" readonly value="nano main.py" class="token">

    <p>Uruchom aplikację:</p>
    <input type="text" readonly value="./main.py" class="token">
  </div>
</template>

<script>
export default {
name: "NewSensorSummary",
  data: ()=>{
    return {
      sensorId: null,
      accessToken: null
    }
  },
  mounted(){
  this.sensorId=this.$route.params.sensorId
  this.accessToken=this.$route.params.accessToken
  }
}
</script>

<style scoped>
.token{
  width: calc(100% - 1rem);
  padding: .5rem;
  margin-bottom: .5rem;
}
.blueprint{
  display:flex;
  align-items: center;
  justify-content: center;
}
.vin{
  color: #d40000;
}
.gnd{
  color: #0000ff;
}
.scl{
  color: #445500;
}
.sda{
  color: #aa4400;
}
.legend{
  display: block;
}
</style>
