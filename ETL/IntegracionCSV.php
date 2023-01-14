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

    $ManejadorCSV = fopen($Archivo, "r");
    fgets($ManejadorCSV);

    $Contador = 0;
    $Contador2 = 0;
    while ($Linea = fgets($ManejadorCSV)) {
        $Contador++;
        if ($Linea != "") {
            $Contador2++;
            $Subcadenas = explode('","', $Linea);
            $Valores = "'',";
            for ($i = 0; $i < count($Subcadenas); $i++) {
                if (strpos($Subcadenas[$i], "'")) {
                    $Valores = $Valores . "\"" . $Subcadenas[$i] . "\",";
                } else if ($i == 0) {
                    $Valores = $Valores . "'" . substr($Subcadenas[$i], 1) . "',";
                } else if ($i == 18) {
                    $Valores = $Valores . "'" . substr($Subcadenas[$i], 0, -3) . "',";
                } else {
                    $Valores = $Valores . "'" . $Subcadenas[$i] . "',";
                }
            }
            $Valores = substr($Valores, 0, -1);

            $SQL = "INSERT INTO mar11 VALUES (" . $Valores . ");";
            mysqli_query($Con, $SQL);
        }
    }
    
    fclose($ManejadorCSV);
    mysqli_close($Con);
    unlink($Archivo);
    $Total = $Contador;
    $Insertados = $Contador2;
    $Errores = $Contador - $Contador2;
    $array = array($NombreArchivo, $TipoArchivo, $Total, $Insertados, $Errores, $array);
    $_SESSION['arrayEstadisticas'] = $array;
    header("Location: ../Sistema/Estadisticas.php");

?>