<?php

    /* 
    Nombre: Michell Alejandro García Vargas
    Expediente: 259663
    Grupo: 30
    Semestre: 7mo
    */

    $Con = mysqli_connect('127.0.0.1', 'root', '', 'cucage');
    $ManejadorKML = fopen("./2011+/AGEEML_202211161338592.kml", "r");
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
            print($Contador." - ".$SQL."<br><br>");
            mysqli_query($Con, $SQL);
        }
    }

    fclose($ManejadorKML);
    mysqli_close($Con);

?>