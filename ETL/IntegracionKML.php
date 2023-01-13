<!DOCTYPE html>
<html lang="es" charset="UTF-8">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cargando Archivo...</title>
    </head>
    <body>
        <div class="espera">
            <h2>Se está cargando tu archivo, por favor ten paciencia, y no cierres el navegador...</h2>
            <a class='estadisticas' href='../Sistema/Estadisticas.php'>Saltar a las estadísticas aunque no haya terminado</a>
        </div>
    </body>
</html>
<style>
    body {
        background-color: #372869;
        font-family: Verdana, Geneva, sans-serif;
    }
    h2{
        color: white;
        margin-bottom: 10%;
        margin-top: 40%;
    }
    .espera{
        display: grid;
        grid-template-columns: 50%; 
        justify-content: center;
        align-self: center;
        text-align: center;
    }
    .estadisticas{
        padding: 2% 3%;
        border: none;
        border-radius: 10px;
        color: #000;
        font-weight: 600;
        font-size: large;
        text-decoration: none;
        background-color: aliceblue;
    }
    .estadisticas:hover{
        background-color: rgba(140, 122, 230, 0.7);
        color: #000;
        border: white 0px solid;
        cursor: pointer;
    }
    .estadisticas:active{
        padding: 1.8% 2%;
        margin-top: 0.2%;
        background-color: rgba(140, 122, 230, 0.7);
        color: white;
        border: white 0px solid;
    }
</style>
<?php

    // PROYECTO FINAL
    // MATERIA: Inteligencia de Negocios 
    // INTEGRANTES: 
    //     - García Vargas Michell Alejandro - 259663
    //     - Jiménez Elizalde Andrés - 259678
    //     - León Paulin Daniel - 260541

    session_start();
    $Archivo = $_SESSION['ArchivoSubido'];

    $Con = mysqli_connect('127.0.0.1', 'root', '', 'cucage');

    // Reestablecer Tabla
    mysqli_query($Con, "TRUNCATE mar11;");

    $ManejadorKML = fopen($Archivo, "r");
    fgets($ManejadorKML);

    $Contador = 0;
    $Linea = fgets($ManejadorKML);
    while($Linea = fgets($ManejadorKML)){
        if($Linea != ""){
            $Contador++;

            preg_match_all('#<value>(.+?)</value>#', $Linea, $Subcadenas);
            $Valores = "'',";
            for($i = 0; $i < count($Subcadenas[1]); $i++){
                if($i == 19){}else if(strpos($Subcadenas[1][$i], "'")){
                    $Valores = $Valores."\"".$Subcadenas[1][$i]."\",";
                }else{
                    $Valores = $Valores."'".$Subcadenas[1][$i]."',";
                }
            }
            $Valores = substr($Valores, 0, -1);
            
            $SQL = "INSERT INTO mar11 VALUES (".$Valores.");";
            mysqli_query($Con, $SQL);
        }
    }

    fclose($ManejadorKML);
    mysqli_close($Con);
    unlink($Archivo);
    header('Location: ../Sistema/Estadisticas.php');

?>