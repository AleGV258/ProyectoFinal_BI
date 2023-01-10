<?php

    /* 
    Nombre: Michell Alejandro García Vargas
    Expediente: 259663
    Grupo: 30
    Semestre: 7mo
    */

    $Con = mysqli_connect('127.0.0.1', 'root', '', 'cucage');
    $ManejadorTXT = fopen("./2011+/AGEEML_20221116102015.txt", "r");
    fgets($ManejadorTXT);

    $Contador = 0;
    while($Linea = fgets($ManejadorTXT)){
        if($Linea != ""){
            $Contador++;

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
            print($Contador." - ".$SQL."<br><br>");
            mysqli_query($Con, $SQL);
        }
    }

    fclose($ManejadorTXT);
    mysqli_close($Con);

?>