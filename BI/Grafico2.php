<html>
    <head>
        <script src="https://code.highcharts.com/highcharts.js"></script>
    </head>
    <body>
        <div id="container" style="width: 100%; height: 400px;"></div>
    </body>
    <script>
<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    for($i = 0; $i < count($Datos); $i++){
        for($j = 0; $j < 19; $j++){
            if($Datos[$i][$j] == NULL){
                $Datos[$i][$j] = 'null';
            }
        }
    }
    $Total = count($Datos);
?>
    Highcharts.chart('container', {
    title: { 
        text: '<?php 
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
            ?>'
    },
    yAxis: {
        title: { 
            text: 'Frecuencia'
        }
    },
    xAxis: {
        title: { 
            text: 'Periodo'
        },
        type: "datetime",
        categories: 
<?php 
            echo("[");
            for($i = 0; $i < $Total; $i++){
                if($i == $Total-1){
                    echo("'".date('d-m-Y', strtotime($Datos[$i][0]))."'"); 
                } else { 
                    echo("'".date('d-m-Y', strtotime($Datos[$i][0]))."',");
                }
            }
            echo("]");
?>
    },
    legend: {
        layout: 'horizontal',
        align: 'center',
        verticalAlign: 'bottom'
    },
    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            }
        }
    },
    colors: ['#EA2027', '#e67e22', '#fbc531', '#4cd137', '#00a8ff', '#9b59b6', '#fd79a8'],

    series: [{
        name: 'Frecuencia',
        data: 
<?php 
        echo("[");
        for($i = 0; $i < $Total; $i++){
            if($i == $Total-1){ echo($Datos[$i][1]); }
            else{ echo($Datos[$i][1].","); }
        }
        echo("]");
?>
    },{
        name: 'Promedio Simple',
        data: 
<?php 
        echo("[");
        for($i = 0; $i < $Total; $i++){
            if($i == $Total-1){ echo($Datos[$i][2]); }
            else{ echo($Datos[$i][2].","); }
        }
        echo("]");
?>
    },{
        name: 'Promedio Móvil Simple',
        data: 
<?php 
        echo("[");
        for($i = 0; $i < $Total; $i++){
            if($i == $Total-1){ echo($Datos[$i][5]); }
            else{ echo($Datos[$i][5].","); }
        }
        echo("]");
?>
    },{
        name: 'Promedio Móvil Doble',
        data: 
<?php 
        echo("[");
        for($i = 0; $i < $Total; $i++){
            if($i == $Total-1){ echo($Datos[$i][8]); }
            else{ echo($Datos[$i][8].","); }
        }
        echo("]");
?>
    },{
        name: 'Promedio Móvil Doble Ajustado',
        data: 
<?php 
        echo("[");
        for($i = 0; $i < $Total; $i++){
            if($i == $Total-1){ echo($Datos[$i][11]); }
            else{ echo($Datos[$i][11].","); }
        }
        echo("]");
?>
    },{
        name: 'Predicción de Tasa Media de Crecimiento',
        data: 
<?php 
        echo("[");
        for($i = 0; $i < $Total; $i++){
            if($i == $Total-1){ echo($Datos[$i][15]); }
            else{ echo($Datos[$i][15].","); }
        }
        echo("]");
?>
    },{
        name: 'Suavizado Exponencial',
        data: 
<?php 
        echo("[");
        for($i = 0; $i < $Total; $i++){
            if($i == $Total-1){ echo($Datos[$i][18]); }
            else{ echo($Datos[$i][18].","); }
        }
        echo("]");
?>
    }],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

    });
    </script>
</html>
