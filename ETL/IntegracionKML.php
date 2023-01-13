<?php

    // PROYECTO FINAL
    // MATERIA: Inteligencia de Negocios 
    // INTEGRANTES: 
    //     - García Vargas Michell Alejandro - 259663
    //     - Jiménez Elizalde Andrés - 259678
    //     - León Paulin Daniel - 260541

    session_start();
    $Archivo = $_SESSION['ArchivoSubido'];
    $NombreArchivo = $_SESSION['ArchivoNombre'];
    $TipoArchivo = $_SESSION['ArchivoExtension'];

    $Con = mysqli_connect('127.0.0.1', 'root', '', 'cucage');
    // Reestablecer Tabla
    mysqli_query($Con, "TRUNCATE mar11;");

    $ManejadorKML = fopen($Archivo, "r");
    fgets($ManejadorKML);

    $Contador = 0;
    $Contador2 = 0;
    $Linea = fgets($ManejadorKML);
    while($Linea = fgets($ManejadorKML)){
        $Contador++;
        if($Linea != ""){
            $Contador2++;
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
        $Total = $Contador;
        $Insertados = $Contador2;
        $Errores = $Contador - $Contador2;
        $array = array($NombreArchivo, $TipoArchivo, $Total, $Insertados, $Errores, $array);
        $_SESSION['arrayEstadisticas'] = $array;
    }

    fclose($ManejadorKML);
    mysqli_close($Con);
    unlink($Archivo);
    header("Location: ../Sistema/Estadisticas.php");

?>