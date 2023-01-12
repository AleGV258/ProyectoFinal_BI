<?php

    // PROYECTO FINAL
    // MATERIA: Inteligencia de Negocios 
    // INTEGRANTES: 
    //     - García Vargas Michell Alejandro - 259663
    //     - Jiménez Elizalde Andrés - 259678
    //     - León Paulin Daniel - 260541

    require 'vendor/autoload.php';

    use XBase\TableReader;
    
    $Con = mysqli_connect("127.0.0.1", "root", "", "cucage");

    $table = new TableReader('./2011+/AGEEML_202211161342331.dbf');

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

        $SQL = "INSERT INTO ene12 VALUES ('','" . $MAPA . "', '" . $CVE_ENT . "', '" . $NOM_ENT . "', '" . $NOM_ABR . "', '" . $CVE_MUN . "', '" . $NOM_MUN . "', '" . $CVE_LOC . "', '" . $NOM_LOC . "', '" . $AMBITO . "', '" . $LATITUD . "', '" . $LONGITUD . "', '" . $LAT_DECIMAL . "', '" . $LON_DECIMAL . "', '" . $ALTITUD . "', '" . $CVE_CARTA . "', '" . $POB_TOTAL . "', '" . $POB_MASCULINA . "', '" . $POB_FEMENINA . "', '" . $TOTAL_DE_VIVIENDAS_HABITADAS . "');";
        echo $SQL . "<br>";
        $Result = mysqli_query($Con, $SQL);
        echo $Result . "<br>";
    }

    mysqli_close($Con);
?>