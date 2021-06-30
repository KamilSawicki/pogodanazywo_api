<script>
import {Line} from "vue-chartjs"

export default {
  name: "LineChartHumidity",
  props: ['labels', 'data', 'max_humidity', 'min_humidity'],
  extends: Line,
  mounted() {
    const fontColor='#ccc'
    const mainColor='#0c2877'
    const maxColor='#6328de'
    const minColor='#0928ff'

    const dataset=[]

    dataset.push({
      label: "Średnia wilgotność powietrza",
      data: this.data,
      backgroundColor: "transparent",
      borderColor: mainColor,
      pointBackgroundColor: mainColor
    })

    if(this.max_humidity!=null){
      dataset.push({
        label: "Maksymalna wilgotność powietrza",
        data: this.max_humidity,
        backgroundColor: "transparent",
        borderColor: maxColor,
        pointBackgroundColor: maxColor
      })
    }

    if(this.min_humidity!=null){
      dataset.push({
        label: "Minimalna wilgotność powietrza",
        data: this.min_humidity,
        backgroundColor: "transparent",
        borderColor: minColor,
        pointBackgroundColor: minColor
      })
    }

    this.renderChart(
        {
          labels: this.labels,
          datasets: dataset
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