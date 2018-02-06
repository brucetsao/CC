<html>
  <head>
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
      google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Memory', <? echo 23 ?>],
        ]);

        var data1 = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Memory', <? echo 25 ?>],
        ]);

        var data2 = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Memory', <? echo 28 ?>],
        ]);

        var data3 = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Memory', <? echo 32 ?>],
        ]);

        var options = {
          width: 120, height: 120,
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };

        var chart = new google.visualization.Gauge(document.getElementById('chart_div'));
        var chart1 = new google.visualization.Gauge(document.getElementById('chart_div1'));
        var chart2 = new google.visualization.Gauge(document.getElementById('chart_div2'));
        var chart3 = new google.visualization.Gauge(document.getElementById('chart_div3'));


        chart.draw(data, options);
        chart1.draw(data1, options);
        chart2.draw(data2, options);
        chart3.draw(data3, options);

        setInterval(function() {
          data.setValue(0, 1, 40 + Math.round(60 * Math.random()));
          chart.draw(data, options);
        }, 13000);
        setInterval(function() {
          data.setValue(1, 1, 40 + Math.round(60 * Math.random()));
          chart.draw(data, options);
        }, 5000);
        setInterval(function() {
          data.setValue(2, 1, 60 + Math.round(20 * Math.random()));
          chart.draw(data, options);
        }, 26000);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 100px; height: 100px;"></div>
    <div id="chart_div1" style="width: 100px; height: 100px;"></div>
    <div id="chart_div2" style="width: 100px; height: 100px;"></div>
    <div id="chart_div3" style="width: 100px; height: 100px;"></div>
  </body>
</html>