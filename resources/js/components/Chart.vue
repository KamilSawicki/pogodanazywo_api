<template>
    <div class="chart">
        <div id="chart"></div>
    </div>
</template>

<script>
export default {
    name: "Chart",
    props: ['labels', 'humidity', 'pressure', 'temperature'],
    mounted() {
        const options = {
            chart: {
                height: 350,
                type: 'area'
            },
            colors:['#F44336', '#1e58e9', '#27b079'],
            fill: {
                colors: ['#F44336', '#1e58e9', '#27b079']
            },
            stroke: {
                curve: 'smooth',
            },
            series: [
                {
                    name: 'Temperatura',
                    data: this.temperature
                },
                {
                    name: 'Wilgotność',
                    data: this.humidity
                },
                {
                    name: 'Ciśnienie',
                    data: this.pressure
                }
            ],
            yaxis: [
                {
                    min: Math.min.apply(Math, this.temperature),
                    axisTicks: {
                        show: true
                    },
                    axisBorder: {
                        show: true,
                        color: "#F44336"
                    },
                    labels: {
                        style: {
                            color: "#F44336"
                        }
                    },
                    title: {
                        text: "Temperatura",
                        style: {
                            color: "#F44336"
                        }
                    },
                    tooltip: {
                        enabled: false
                    }
                },
                {
                    min: Math.min.apply(Math, this.humidity),
                    axisTicks: {
                        show: true
                    },
                    axisBorder: {
                        show: true,
                        color: "#1e58e9"
                    },
                    labels: {
                        style: {
                            color: "#1e58e9"
                        }
                    },
                    title: {
                        text: "Wilgotność",
                        style: {
                            color: "#1e58e9"
                        }
                    },
                    tooltip: {
                        enabled: false
                    }
                },
                {
                    min: Math.min.apply(Math, this.pressure),
                    axisTicks: {
                        show: true
                    },
                    axisBorder: {
                        show: true,
                        color: "#27b079"
                    },
                    labels: {
                        style: {
                            color: "#27b079"
                        }
                    },
                    title: {
                        text: "Ciśnienie",
                        style: {
                            color: "#27b079"
                        }
                    },
                    tooltip: {
                        enabled: false
                    }
                },
            ],
            dataLabels: {
                enabled: true
            },
            xaxis: {
                categories: this.labels
            }
        }

        const chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();
    }
}


</script>

<style scoped>
</style>
