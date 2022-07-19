// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Bar Chart Example
data=new FormData()
data.append('opgraf','Barras')
const params={
  body:data,
  method:'POST'
}
fetch('./php/graficas.php',params)
.then(response => response.json())
.then( data => {
  //console.log(data.datagraf)
var ctx = document.getElementById("myBarChart");
var myLineChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio","Julio", "Agosto","Septiembre","Octubre","Noviembre", "Diciembre"],
    datasets: [{
      label: "Compras",
      backgroundColor: "rgba(2,117,216,1)",
      borderColor: "rgba(2,117,216,1)",
      data: [data.datagraf[0],data.datagraf[1],data.datagraf[2],data.datagraf[3],data.datagraf[4],data.datagraf[5],data.datagraf[6],
              data.datagraf[7],data.datagraf[8],data.datagraf[9],data.datagraf[10],data.datagraf[11]],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 6
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: data.maximo,
          maxTicksLimit: 5
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    }
  }
})
});
