// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Pie Chart Example
// Bar Chart Example
data=new FormData()
data.append('opgraf','Pie')
const paramspie={
  body:data,
  method:'POST'
}
fetch('./php/graficas.php',paramspie)
.then(response => response.json())
.then( data => {

arreglopr=[]
arregloprcant=[]
data.datapr.forEach(element => {
  arreglopr.push(element)
});
data.dataprcant.forEach(element => {
  arregloprcant.push(element)
});

var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: arreglopr,
    datasets: [{
      data: arregloprcant,
      backgroundColor: ['#001FB9','#007bff', '#dc3545', '#ffc107', '#28a745','#43B900','#0E0D0D','#1BE8C9','#E81BD8','#B0B0B0'],
    }],
  },
})
});
