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

    require 'vendor/autoload.php';
    use XBase\TableReader;

    session_start();
    $Archivo = $_SESSION['ArchivoSubido'];
    
    $Con = mysqli_connect("127.0.0.1", "root", "", "cucage");

    // Reestablecer Tabla
    mysqli_query($Con, "TRUNCATE mar11;");

    $table = new TableReader($Archivo);
    while ($record = $table->nextRecord()) {
        $MAPA = $record->get('MAPA');
        $CVE_ENT = utf8_encode($record->get('CVE_ENT'));
        $NOM_ENT = str_replace("'", "\'", utf8_encode($record->get('NOM_ENT')));
        $NOM_ABR = utf8_encode($record->get('NOM_ABR'));
        $CVE_MUN = utf8_encode($record->get('CVE_MUN'));
        $NOM_MUN = str_replace("'", "\'", utf8_encode($record->get('NOM_MUN')));
        $CVE_LOC = utf8_encode($record->get('CVE_LOC'));
        $NOM_LOC = str_replace("'", "\'", utf8_encode($record->get('NOM_LOC')));
        $AMBITO = utf8_encode($record->get('AMBITO'));
        $LATITUD = str_replace("'", "\'", utf8_encode($record->get('LATITUD')));
        $LONGITUD = str_replace("'", "\'", utf8_encode($record->get('LONGITUD')));
        $LAT_DECIMAL = utf8_encode($record->get('LAT_DECIMAL'));
        $LON_DECIMAL = utf8_encode($record->get('LON_DECIMAL'));
        $ALTITUD = utf8_encode($record->get('ALTITUD'));
        $CVE_CARTA = utf8_encode($record->get('CVE_CARTA'));
        $POB_TOTAL = utf8_encode($record->get('POB_TOTAL'));
        $POB_MASCULINA = utf8_encode($record->get('POB_MASCULI'));
        $POB_FEMENINA = utf8_encode($record->get('POB_FEMENIN'));
        $TOTAL_DE_VIVIENDAS_HABITADAS = utf8_encode($record->get('TOTAL DE VI'));

        $SQL = "INSERT INTO mar11 VALUES ('','" . $MAPA . "', '" . $CVE_ENT . "', '" . $NOM_ENT . "', '" . $NOM_ABR . "', '" . $CVE_MUN . "', '" . $NOM_MUN . "', '" . $CVE_LOC . "', '" . $NOM_LOC . "', '" . $AMBITO . "', '" . $LATITUD . "', '" . $LONGITUD . "', '" . $LAT_DECIMAL . "', '" . $LON_DECIMAL . "', '" . $ALTITUD . "', '" . $CVE_CARTA . "', '" . $POB_TOTAL . "', '" . $POB_MASCULINA . "', '" . $POB_FEMENINA . "', '" . $TOTAL_DE_VIVIENDAS_HABITADAS . "');";
        $Result = mysqli_query($Con, $SQL);
    }

    mysqli_close($Con);
    unlink($Archivo);
    header('Location: ../Sistema/Estadisticas.php');
    
?>