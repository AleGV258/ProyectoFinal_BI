<?php
    /* 
    Nombre: Michell Alejandro García Vargas
    Expediente: 259663
    Grupo: 30
    Semestre: 7mo
    */

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    //Conectarse al SMBD
    $Conexion_OD = mysqli_connect('127.0.0.1', 'root', '', 'data');

    //Ejectar Consultas
    $SQL_OD = 'SELECT Periodo, Frecuencia FROM '.$TABLA.';';
    $Result_OD = mysqli_query($Conexion_OD, $SQL_OD);

    //Cerrar Conexion
    mysqli_close($Conexion_OD);

    print("['Periodo', 'Frecuencia', 'PS', 'PMS', 'PMD', 'PMDA', 'PTMAC', 'SE'],");

    //Interpretar Resultados
    $Data = "";
    $Total = mysqli_num_rows($Result_OD);
    for($f = 0; $f < $Total; $f++){
        $Fila_OD = mysqli_fetch_row($Result_OD);
        $Data = $Data."['$Fila_OD[0]', $Fila_OD[1], ".$_SESSION["Datos"][$f][2].", ".$_SESSION["Datos"][$f][5].", ".$_SESSION["Datos"][$f][8].", ".$_SESSION["Datos"][$f][11].", ".$_SESSION["Datos"][$f][15].", ";
        if($_SESSION["Datos"][$f][18] == NULL){
            $Data = $Data."null],";
        }else{
            $Data = $Data.$_SESSION["Datos"][$f][18]."],";
        }
    }
    $NewDate = date('Y-m-d', strtotime($Fila_OD[0]. ' + 1 months'));
    $Data = $Data."['$NewDate', $Fila_OD[1], ".$_SESSION["Datos"][$Total][2].", ".$_SESSION["Datos"][$Total][5].", ".$_SESSION["Datos"][$Total][8].", ".$_SESSION["Datos"][$Total][11].", ".$_SESSION["Datos"][$Total][15].", ".$_SESSION["Datos"][$Total][18]."]";
    print($Data);
?>