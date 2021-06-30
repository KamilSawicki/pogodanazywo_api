<template>
    <div class="tiles">
        <div class="tile temperature box">
            <span class="text">Temperatura</span>
            <span class="value"><span class="number">{{temperature}}</span><span class="unit">°C</span></span>
            <img src="/images/thermometer.svg" alt="temperature" class="icon">
        </div>
        <div class="tile humidity box">
            <span class="text">Wilgotność</span>
            <span class="value"><span class="number">{{humidity}}</span><span class="unit">%</span></span>
            <img src="/images/humidity.svg" alt="humidity" class="icon">
        </div>
        <div class="tile pressure box">
            <span class="text">Ciśnienie</span>
            <span class="value"><span class="number">{{pressure}}</span><span class="unit">HPa</span></span>
            <img src="/images/pressure.svg" alt="pressure" class="icon">
        </div>
    </div>
</template>

<script>
export default {
    name: "ActualTiles",
    props: ['temperature', 'humidity', 'pressure']
}
</script>

<style scoped>
.tiles{
    display: flex;
    justify-content: center;
}
.tile{
    width: 33.33%;
    min-height: 200px;
    position: relative;
}
.text{
    position: absolute;
    top: 1rem;
    right: 1rem;
    font-size: 1.5em;
}
.value{
    position: absolute;
    bottom: 1rem;
    right: 1rem;
}
.number{
    font-size: 4em;
}
.icon{
    position: absolute;
    font-size: 7em;
    line-height: 200px;
    height: 50%;
}

@media (max-width: 768px) {
    .tiles{
        display: block;
    }
    .tile{
        width: calc(100% - 1.6rem);
    }
}

</style>
