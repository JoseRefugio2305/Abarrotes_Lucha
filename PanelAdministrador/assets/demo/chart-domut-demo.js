// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Pie Chart Example
// Bar Chart Example
data=new FormData()
data.append('opgraf','Doughnut')
const paramsdoughnut={
  body:data,
  method:'POST'
}
fetch('./php/graficas.php',paramsdoughnut)
.then(response => response.json())
.then( data => {

arreglocats=[]
arreglocantcomp=[]
data.datacats.forEach(element => {
  arreglocats.push(element)
});
data.datacantcomp.forEach(element => {
  arreglocantcomp.push(element)
});

var ctx = document.getElementById("myPieChartCategory");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: arreglocats,
    datasets: [{
      data: arreglocantcomp,
      backgroundColor: ['#001FB9','#007bff', '#dc3545', '#ffc107', '#28a745','#43B900','#0E0D0D','#1BE8C9','#E81BD8','#1B2BE8'],
    }],
  },
})
});
