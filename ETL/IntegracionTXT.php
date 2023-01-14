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

    $ManejadorTXT = fopen($Archivo, "r");
    fgets($ManejadorTXT);

    $Contador = 0;
    $Contador2 = 0;
    while($Linea = fgets($ManejadorTXT)){
        $Contador++;
        if($Linea != ""){
            $Contador2++;
            $Subcadenas = explode('"', $Linea);
            $Valores = "'',";
            for($i = 1; $i < count($Subcadenas); $i+=2){
                if(strpos($Subcadenas[$i], "'")){
                    $Valores = $Valores."\"".$Subcadenas[$i]."\",";
                }else if($i == 19){
                    $Valores = $Valores."'".$Subcadenas[$i]."\"".$Subcadenas[$i+1]."',";
                }else if($i == 21){}else if($i == 23){
                    $Valores = $Valores."'".$Subcadenas[$i-1]."\"".$Subcadenas[$i]."',";
                }else{
                    $Valores = $Valores."'".$Subcadenas[$i]."',";
                }
            }
            $Valores = substr($Valores, 0, -1);

            $SQL = "INSERT INTO mar11 VALUES (".$Valores.");";
            mysqli_query($Con, $SQL);
        }
    }

    fclose($ManejadorTXT);
    mysqli_close($Con);
    unlink($Archivo);
    $Total = $Contador;
    $Insertados = $Contador2;
    $Errores = $Contador - $Contador2;
    $array = array($NombreArchivo, $TipoArchivo, $Total, $Insertados, $Errores, $array);
    $_SESSION['arrayEstadisticas'] = $array;
    header("Location: ../Sistema/Estadisticas.php");

?>