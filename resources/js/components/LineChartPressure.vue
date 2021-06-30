<script>
import {Line} from "vue-chartjs"

export default {
  name: "LineChartPressure",
  props: ['labels', 'data', 'max_pressure', 'min_pressure'],
  extends: Line,
  mounted() {
    const fontColor='#ccc'
    const mainColor='#0ba535'
    const maxColor='#5fa535'
    const minColor='#0ba58a'

    const dataset=[]

    dataset.push({
      label: "Średnie ciśnienie atmosferyczne",
      data: this.data,
      backgroundColor: "transparent",
      borderColor: mainColor,
      pointBackgroundColor: mainColor
    })

    if(this.max_pressure!=null){
      dataset.push({
        label: "Maksymalne ciśnienie atmosferyczne",
        data: this.max_pressure,
        backgroundColor: "transparent",
        borderColor: maxColor,
        pointBackgroundColor: maxColor
      })
    }

    if(this.min_pressure!=null){
      dataset.push({
        label: "Minimalne ciśnienie atmosferyczne",
        data: this.min_pressure,
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