<html>
    <!-- 
    Nombre: Michell Alejandro García Vargas
    Expediente: 259663
    Grupo: 30
    Semestre: 7mo 
    -->

    <head>
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
  
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
<?php
            include("./ObtenerDatos_259663.php");
?>
          ]);

          var options = {
            title: '<?php 
                switch($TABLA){
                  case 'Salarios_Minimos': echo("Salarios Mínimos"); break;
                  case 'Esperanza_Vida': echo("Esperanza de Vida"); break;
                  case 'Mortalidad': echo("Mortalidad"); break;
                  case 'Suicidios': echo("Suicidios"); break;
                  case 'Piramide_Poblacion': echo("Piramide de Población"); break;
                  case 'Temperatura_Maxima': echo("Temperatura Máxima"); break;
                  case 'Carne_Cerdo': echo("Carne de Cerdo"); break;
                  case 'Valor_Bitcoin': echo("Valor del Bitcoin"); break;
                  case 'Acciones_Apple': echo("Acciones de Apple"); break;
                  case 'Acciones_Google': echo("Acciones de Google"); break;
                }
            ?>',
            curveType: 'function',
            legend: { position: 'bottom' },
            width: 1600,
            height: 800,
            is3D: true,
            lineWidth: 3,
            pointShape: {type: 'star', sides: 5, dent: 0.8},
            pointSize: 10,
            //lineDashStyle: [5, 1],
            colors: ['#EA2027', '#e67e22', '#fbc531', '#4cd137', '#00a8ff', '#9b59b6', '#fd79a8'],
          };
  
          var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
  
          chart.draw(data, options);
        }
      </script>
    </head>
    <body>
      <p>Ir al archivo de configuracion para establecer las variables ↓</p>
      <div id="curve_chart" style="width: 50%; height: 60vh; font-family: 'verdana'; margin: 0 0 32% -11%; z-index: 1; position: relative;"></div>
    </body>
</html>