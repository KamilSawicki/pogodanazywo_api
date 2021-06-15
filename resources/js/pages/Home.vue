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
            <apexchart width="500" type="area" :options="options" :series="series"></apexchart>
        </div>
    </div>
</template>

<script>
export default {
    data: () => {
        return {
            city: 'Grabownica Starzeńska',
            actual: {
                temperature: 25
            },
            options: {
                legend: {
                    show: false,
                }
            },
            series: [
                {
                    data: [
                        {
                            x: new Date('2021-06-15 14:30').getTime(),
                            y: 25
                        },
                        {
                            x: new Date('2021-06-15 15:00').getTime(),
                            y: 26
                        },
                        {
                            x: new Date('2021-06-15 15:30').getTime(),
                            y: 26
                        },
                        {
                            x: new Date('2021-06-15 16:00').getTime(),
                            y: 24
                        },
                        {
                            x: new Date('2021-06-15 16:30').getTime(),
                            y: 23
                        },
                        {
                            x: new Date('2021-06-15 17:00').getTime(),
                            y: 23
                        }
                    ]
                }
            ],
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
    font-size: 6em;
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
