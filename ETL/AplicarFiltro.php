<?php

    // PROYECTO FINAL
    // MATERIA: Inteligencia de Negocios 
    // INTEGRANTES: 
    //     - García Vargas Michell Alejandro - 259663
    //     - Jiménez Elizalde Andrés - 259678
    //     - León Paulin Daniel - 260541
    
    session_start();
    $Con = mysqli_connect('127.0.0.1', 'root', '', 'cucage');

?>
<!DOCTYPE html>
<html lang="es" charset="UTF-8">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Filtro</title>
    </head>
    <body>
        <div class='row'>
            <a class='column1' href='../Sistema/Estadisticas.php'>Regresar</a>
            <label class="column2">Filtros Aplicados</label><br><br>
        </div>

<?php

    for ($i = 0; $i < 10; $i++) { 
        $Errores[$i] = 0;
        $Filtro[$i] = 'NO';
    }
    
    // 1 - CVE_ENT (CVE_ENT < 01 OR CVE_ENT > 32)
    if(isset($_POST['CVE_ENT'])) {
        $SQL = "SELECT * FROM mar11 WHERE CVE_ENT < 01 OR CVE_ENT > 32;";
        $Result = mysqli_query($Con, $SQL);

        $Filtro[0] = 'CVE_ENT';
        $Errores[0] = mysqli_num_rows($Result);

        $SQL2 = "DELETE FROM mar11 WHERE CVE_ENT < 01 OR CVE_ENT > 32;";
        $Result = mysqli_query($Con, $SQL2);
        echo("<div class='estadistica'>Errorres Eliminados con el Filtro CVE_ENT: <a class='color'>" . $Errores[0] . "</a></div><br><br>");
    }

    // 2 - AMBITO (AMBITO NOT IN('R','U'))
    if(isset($_POST['AMBITO'])) {
        $SQL = "SELECT * FROM mar11 WHERE AMBITO NOT IN('R','U');";
        $Result = mysqli_query($Con, $SQL);
        $Filtro[1] = 'AMBITO';
        $Errores[1] = mysqli_num_rows($Result);

        $SQL2 = "DELETE FROM mar11 WHERE AMBITO NOT IN('R','U');";
        $Result = mysqli_query($Con, $SQL2);
        echo("<div class='estadistica'>Errorres Eliminados con el Filtro AMBITO: <a class='color'>" . $Errores[1] . "</a></div><br><br>");
    }

    // 3 - MAPA (MAPA < 10010001 OR MAPA > 320580043)
    if(isset($_POST['MAPA'])) {
        $SQL = "SELECT * FROM mar11 WHERE MAPA < 10010001 OR MAPA > 320580043;";
        $Result = mysqli_query($Con, $SQL);
        $Filtro[2] = 'MAPA';
        $Errores[2] = mysqli_num_rows($Result);

        $SQL2 = "DELETE FROM mar11 WHERE MAPA < 10010001 OR MAPA > 320580043;";
        $Result = mysqli_query($Con, $SQL2);
        echo("<div class='estadistica'>Errorres Eliminados con el Filtro MAPA: <a class='color'>" . $Errores[2] . "</a></div><br><br>");
    }

    // 4 - CVE_MUN (CVE_MUN < 01 OR CVE_MUN > 570)
    if(isset($_POST['CVE_MUN'])) {
        $SQL = "SELECT * FROM mar11 WHERE CVE_MUN < 01 OR CVE_MUN > 570;";
        $Result = mysqli_query($Con, $SQL);
        $Filtro[3] = 'CVE_MUN';
        $Errores[3] = mysqli_num_rows($Result);

        $SQL2 = "DELETE FROM mar11 WHERE CVE_MUN < 01 OR CVE_MUN > 570;";
        $Result = mysqli_query($Con, $SQL2);
        echo("<div class='estadistica'>Errorres Eliminados con el Filtro CVE_MUN: <a class='color'>" . $Errores[3] . "</a></div><br><br>");
    }

    // 5 - CVE_LOC (CVE_LOC < 0001 OR CVE_LOC > 8010)
    if(isset($_POST['CVE_LOC'])) {
        $SQL = "SELECT * FROM mar11 WHERE CVE_LOC < 0001 OR CVE_LOC > 8010;";
        $Result = mysqli_query($Con, $SQL);
        $Filtro[4] = 'CVE_LOC';
        $Errores[4] = mysqli_num_rows($Result);

        $SQL2 = "DELETE FROM mar11 WHERE CVE_LOC < 0001 OR CVE_LOC > 8010;";
        $Result = mysqli_query($Con, $SQL2);
        echo("<div class='estadistica'>Errorres Eliminados con el Filtro CVE_LOC: <a class='color'>" . $Errores[4] . "</a></div><br><br>");
    }

    // 6 - ALTITUD (ALTITUD < -27 OR ALTITUD > 4169)
    if(isset($_POST['ALTITUD'])) {
        $SQL = "SELECT * FROM mar11 WHERE ALTITUD < -27 OR ALTITUD > 4169;";
        $Result = mysqli_query($Con, $SQL);
        $Filtro[5] = 'ALTITUD';
        $Errores[5] = mysqli_num_rows($Result);

        $SQL2 = "DELETE FROM mar11 WHERE ALTITUD < -27 OR ALTITUD > 4169;";
        $Result = mysqli_query($Con, $SQL2);
        echo("<div class='estadistica'>Errorres Eliminados con el Filtro ALTITUD: <a class='color'>" . $Errores[5] . "</a></div><br><br>");
    }

    // 7 - LAT_DECIMAL (LAT_DECIMAL < 14.535464 OR LAT_DECIMAL > 32.716188)
    if(isset($_POST['LAT_DECIMAL'])) {
        $SQL = "SELECT * FROM mar11 WHERE LAT_DECIMAL < 14.535464 OR LAT_DECIMAL > 32.716188;";
        $Result = mysqli_query($Con, $SQL);
        $Filtro[6] = 'LAT_DECIMAL';
        $Errores[6] = mysqli_num_rows($Result);

        $SQL2 = "DELETE FROM mar11 WHERE LAT_DECIMAL < 14.535464 OR LAT_DECIMAL > 32.716188;";
        $Result = mysqli_query($Con, $SQL2);
        echo("<div class='estadistica'>Errorres Eliminados con el Filtro LAT_DECIMAL: <a class='color'>" . $Errores[6] . "</a></div><br><br>");
    }

    // 8 - LONG_DECIMAL (LONG_DECIMAL < -118.302243 OR LONG_DECIMAL > -86.724349)
    if(isset($_POST['LONG_DECIMAL'])) {
        $SQL = "SELECT * FROM mar11 WHERE LONG_DECIMAL < -118.302243 OR LONG_DECIMAL > -86.724349;";
        $Result = mysqli_query($Con, $SQL);
        $Filtro[7] = 'LONG_DECIMAL';
        $Errores[7] = mysqli_num_rows($Result);

        $SQL2 = "DELETE FROM mar11 WHERE LONG_DECIMAL < -118.302243 OR LONG_DECIMAL > -86.724349;";
        $Result = mysqli_query($Con, $SQL2);
        echo("<div class='estadistica'>Errorres Eliminados con el Filtro LONG_DECIMAL: <a class='color'>" . $Errores[7] . "</a></div><br><br>");
    }

    // 9 - NOM_ENT ('Aguascalientes', 'Baja California', 'Baja California Sur', 'Campeche', 'Coahuila de Zaragoza', 'Colima', 'Chiapas', 'Chihuahua', 'Distrito Federal', 'Durango', 'Guanajuato', 'Guerrero', 'Hidalgo', 'Jalisco', 'México', 'Michoacán de Ocampo', 'Morelos', 'Nayarit', 'Nuevo León', 'Oaxaca', 'Puebla', 'Querétaro', 'Quintana Roo', 'San Luis Potosí', 'Sinaloa', 'Sonora', 'Tabasco', 'Tamaulipas', 'Tlaxcala', 'Veracruz de Ignacio de la Llave', 'Yucatán', 'Zacatecas')
    if(isset($_POST['NOM_ENT'])) {
        $SQL = "SELECT * FROM mar11 WHERE NOM_ENT NOT IN('Aguascalientes', 'Baja California', 'Baja California Sur', 'Campeche', 'Coahuila de Zaragoza', 'Colima', 'Chiapas', 'Chihuahua', 'Distrito Federal', 'Durango', 'Guanajuato', 'Guerrero', 'Hidalgo', 'Jalisco', 'México', 'Michoacán de Ocampo', 'Morelos', 'Nayarit', 'Nuevo León', 'Oaxaca', 'Puebla', 'Querétaro', 'Quintana Roo', 'San Luis Potosí', 'Sinaloa', 'Sonora', 'Tabasco', 'Tamaulipas', 'Tlaxcala', 'Veracruz de Ignacio de la Llave', 'Yucatán', 'Zacatecas');";
        $Result = mysqli_query($Con, $SQL);
        $Filtro[8] = 'NOM_ENT';
        $Errores[8] = mysqli_num_rows($Result);

        $SQL2 = "DELETE FROM mar11 WHERE NOM_ENT NOT IN('Aguascalientes', 'Baja California', 'Baja California Sur', 'Campeche', 'Coahuila de Zaragoza', 'Colima', 'Chiapas', 'Chihuahua', 'Distrito Federal', 'Durango', 'Guanajuato', 'Guerrero', 'Hidalgo', 'Jalisco', 'México', 'Michoacán de Ocampo', 'Morelos', 'Nayarit', 'Nuevo León', 'Oaxaca', 'Puebla', 'Querétaro', 'Quintana Roo', 'San Luis Potosí', 'Sinaloa', 'Sonora', 'Tabasco', 'Tamaulipas', 'Tlaxcala', 'Veracruz de Ignacio de la Llave', 'Yucatán', 'Zacatecas');";
        $Result = mysqli_query($Con, $SQL2);
        echo("<div class='estadistica'>Errorres Eliminados con el Filtro NOM_ENT: <a class='color'>" . $Errores[8] . "</a></div><br><br>");
    }

    // 10 - NOM_ABR ('Ags.', 'BC', 'BCS', 'Camp.', 'Coah.', 'Col.', 'Chis.', 'Chih.', 'DF', 'Dgo.', 'Gto.', 'Gro.', 'Hgo.', 'Jal.', 'Mex.', 'Mich.', 'Mor.', 'Nay.', 'NL', 'Oax.', 'Pue.', 'Qro.', 'Q. Roo', 'SLP', 'Sin.', 'Son.', 'Tab.', 'Tamps.', 'Tlax.', 'Ver.', 'Yuc.', 'Zac.')
    if(isset($_POST['NOM_ABR'])) {
        $SQL = "SELECT * FROM mar11 WHERE NOM_ABR NOT IN('Ags.', 'BC', 'BCS', 'Camp.', 'Coah.', 'Col.', 'Chis.', 'Chih.', 'DF', 'Dgo.', 'Gto.', 'Gro.', 'Hgo.', 'Jal.', 'Mex.', 'Mich.', 'Mor.', 'Nay.', 'NL', 'Oax.', 'Pue.', 'Qro.', 'Q. Roo', 'SLP', 'Sin.', 'Son.', 'Tab.', 'Tamps.', 'Tlax.', 'Ver.', 'Yuc.', 'Zac.');";
        $Result = mysqli_query($Con, $SQL);
        $Filtro[9] = 'NOM_ABR';
        $Errores[9] = mysqli_num_rows($Result);

        $SQL2 = "DELETE FROM mar11 WHERE NOM_ABR NOT IN('Ags.', 'BC', 'BCS', 'Camp.', 'Coah.', 'Col.', 'Chis.', 'Chih.', 'DF', 'Dgo.', 'Gto.', 'Gro.', 'Hgo.', 'Jal.', 'Mex.', 'Mich.', 'Mor.', 'Nay.', 'NL', 'Oax.', 'Pue.', 'Qro.', 'Q. Roo', 'SLP', 'Sin.', 'Son.', 'Tab.', 'Tamps.', 'Tlax.', 'Ver.', 'Yuc.', 'Zac.');";
        $Result = mysqli_query($Con, $SQL2);
        echo("<div class='estadistica'>Errorres Eliminados con el Filtro NOM_ABR: <a class='color'>" . $Errores[9] . "</a></div><br><br>");
    }
    mysqli_close($Con);

?>
    </body>
    <footer></footer>
</html>
<style>
    body {
        background-color: #372869;
        font-family: Verdana, Geneva, sans-serif;
        margin: 0;
        padding: 0;
    }
    footer{
        width: 100%;
        height: 75vh;
        margin: -3% 0 0 0;
        background-image: url("../Sistema/images/Footer.jpg");
    }
    label {
        font-size: x-large;
        font-weight: 600;
        display: grid;
        justify-content: center;
        color: aliceblue;
        margin: 0 0 -1% 0;
    }
    .estadistica{
        width: 100%;
        color: #fff;
        font-size: x-large;
        font-weight: 600;
        text-align: center;
        padding: -1% 0;
    }
    .color{
        color: #9980FA;
    }
    .row {
        display: grid;
        grid-template-columns: 15% 80%; 
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 0 0 1% 0;
    }
    .column2 {
        padding: 30px 0;
        padding-right: 19%;
        z-index: -1;
        font-size: 370%;
    }
    .column1 {
        padding: 8% 5%;
        margin-top: 1%;
        margin-left: 5%;
        border: none;
        border-radius: 10px;
        color: #000;
        font-weight: 600;
        font-size: large;
        text-decoration: none;
        background-color: aliceblue;
    }
    .column1:hover{
        background-color: rgba(140, 122, 230, 0.7);
        color: #000;
        border: white 0px solid;
        cursor: pointer;
    }
    .column1:active{
        padding: 7% 1%;
        width: 90%;
        margin-left: 6.5%;
        background-color: rgba(140, 122, 230, 0.7);
        color: white;
        border: white 0px solid;
    }
    @media (min-width: 800px) {
        .row { grid-template-columns: repeat(4fr, 1fr); }
    }
    @media (min-width: 300px) and (max-width: 800px) {
        label{ font-size: medium; }
        input[type="checkbox"] { width: 15px; height: 15px; margin: 0 0 0 -30px; }
        .row { grid-template-columns: repeat(1, 1fr); }
        .column1 { margin-left: 0; padding: 3% 0%; }
        .column2 { padding-right: 0; }
        .column1:active{ margin: 1.8% 0 0 2%; padding: 2% 2%;}
        .insertadosPorcentaje { padding: 33% 10%; font-size: small; }
        .insertadosTexto{ font-size: medium; padding: 3% 0; }
        .insertados { grid-template-columns: 25% 65%; }
    }
</style>
<?php

    // Generar PDF para Administrador
    require('../Sistema/EnviarCorreo.php');
    require('../Sistema/GenerarPDF.php');
    if (isset($_SESSION['Nombre'])) {
        $Usuario = $_SESSION['Nombre'];
    } else {
        $Usuario = 'Desconocido';
    }
    if (isset($_SESSION['Usuario'])) {
        $Correo = $_SESSION['Usuario'];
    } else {
        $Correo = 'Desconocido';
    }
    if (isset($_SESSION['arrayEstadisticas'])) {
        $array = $_SESSION['arrayEstadisticas'];
        $NombreArchivo = $array[0]; // Nombre del archivo
        $TipoArchivo = $array[1];  // Tipo de archivo
        $Total = $array[2]; // Cantidad total de filas que estaban en el archivo
        $Insertados = $array[3]; // Cantidad de inserts correctos
        $CErrores = $array[4]; // Cantidad de errores encontrados

        $PorcentajeInsertados = intval($Insertados / $Total * 100); // PorcentajeInsertados de datos insertados
        $PorcentajeErrores = intval($CErrores / $Total * 100); // PorcentajeInsertados de datos no insertados
    
        integracionPDF($NombreArchivo, $TipoArchivo, $CErrores, $Insertados, $Total, $Filtro, $Errores, $Correo, $Usuario);
    }    
    
?>