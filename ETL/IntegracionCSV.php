<?php

    // PROYECTO FINAL
    // MATERIA: Inteligencia de Negocios 
    // INTEGRANTES: 
    //     - García Vargas Michell Alejandro - 259663
    //     - Jiménez Elizalde Andrés - 259678
    //     - León Paulin Daniel - 260541

    $Con = mysqli_connect('127.0.0.1', 'root', '', 'cucage');
    $ManejadorCSV = fopen("./2011+/AGEEML_202211161021989.csv", "r");
    fgets($ManejadorCSV);

    $Contador = 0;
    while($Linea = fgets($ManejadorCSV)){
        if($Linea != ""){
            $Contador++;

            $Subcadenas = explode('","', $Linea);
            $Valores = "'',";
            for($i = 0; $i < count($Subcadenas); $i++){
                if(strpos($Subcadenas[$i], "'")){
                    $Valores = $Valores."\"".$Subcadenas[$i]."\",";
                }else if($i == 0){
                    $Valores = $Valores."'".substr($Subcadenas[$i], 1)."',";
                }else if($i == 18){
                    $Valores = $Valores."'".substr($Subcadenas[$i], 0, -3)."',";
                }else{
                    $Valores = $Valores."'".$Subcadenas[$i]."',";
                }
            }
            $Valores = substr($Valores, 0, -1);
            
            $SQL = "INSERT INTO mar11 VALUES (".$Valores.");";
            print($Contador." - ".$SQL."<br><br>");
            mysqli_query($Con, $SQL);
        }
    }

    fclose($ManejadorCSV);
    mysqli_close($Con);

?>