<script>
import {Line} from "vue-chartjs"

export default {
  name: "LineChartTemperature",
  props: [ 'labels', 'data', 'max_temperature', 'min_temperature'],
  extends: Line,
  mounted() {
    const fontColor='#ccc'
    const mainColor='#95225a'
    const maxColor='#ff225a'
    const minColor='#b522ff'

    const datasets=[]

    datasets.push({
      label: "Średnia temperatura powietrza",
          data: this.data,
        backgroundColor: "transparent",
        borderColor: mainColor,
        pointBackgroundColor: mainColor
    })

    if(this.max_temperature!=null){
      datasets.push({
        label: "Maksymalna temperatura powietrza",
        data: this.max_temperature,
        backgroundColor: "transparent",
        borderColor: maxColor,
        pointBackgroundColor: maxColor
      })
    }

    if(this.min_temperature!=null){
      datasets.push({
        label: "Minimalna temperatura powietrza",
        data: this.min_temperature,
        backgroundColor: "transparent",
        borderColor: minColor,
        pointBackgroundColor: minColor
      })
    }


    this.renderChart(
        {
          labels: this.labels,
          datasets: datasets
        },
        {
          responsive: true,
          maintainAspectRatio: false,
          legend: {
            labels: {
              fontColor: fontColor
            },
          },
          scales: {
            yAxes: [{
              ticks: {
                fontColor: fontColor
              }
            }],
            xAxes: [{
              ticks: {
                fontColor: fontColor
              }
            }]
          }
        },
    );
  }
}
</script>