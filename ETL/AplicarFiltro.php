<?php

    // MATERIA: Inteligencia de Negocios 
    // INTEGRANTES: 
    //     - García Vargas Michell Alejandro - 259663
    //     - Jiménez Elizalde Andrés - 259678
    //     - León Paulin Daniel - 260541

    $Con = mysqli_connect('127.0.0.1', 'root', '', 'cucage');
    for ($i = 0; $i < 10; $i++) { 
        $Errores[$i] = 0;
    }

    // 1 - CVE_ENT (CVE_ENT < 01 OR CVE_ENT > 32)
    if(isset($_POST['CVE_ENT'])) {
        $SQL = "SELECT * FROM mar11 WHERE CVE_ENT < 01 OR CVE_ENT > 32;";
        $Result = mysqli_query($Con, $SQL);

        $Errores[0] = mysqli_num_rows($Result);

        $SQL2 = "DELETE FROM mar11 WHERE CVE_ENT < 01 OR CVE_ENT > 32;";
        $Result = mysqli_query($Con, $SQL2);
        print("Errorres eliminados con el filtro CVE_ENT: " . $Errores[0] . "<br><br>");
    }

    // 2 - AMBITO (AMBITO NOT IN('R','U'))
    if(isset($_POST['AMBITO'])) {
        $SQL = "SELECT * FROM mar11 WHERE AMBITO NOT IN('R','U');";
        $Result = mysqli_query($Con, $SQL);

        $Errores[1] = mysqli_num_rows($Result);

        $SQL2 = "DELETE FROM mar11 WHERE AMBITO NOT IN('R','U');";
        $Result = mysqli_query($Con, $SQL2);
        print("Errorres eliminados con el filtro AMBITO: " . $Errores[1] . "<br><br>");
    }

    // 3 - MAPA (MAPA < 10010001 OR MAPA > 320580043)
    if(isset($_POST['MAPA'])) {
        $SQL = "SELECT * FROM mar11 WHERE MAPA < 10010001 OR MAPA > 320580043;";
        $Result = mysqli_query($Con, $SQL);

        $Errores[2] = mysqli_num_rows($Result);

        $SQL2 = "DELETE FROM mar11 WHERE MAPA < 10010001 OR MAPA > 320580043;";
        $Result = mysqli_query($Con, $SQL2);
        print("Errorres eliminados con el filtro MAPA: " . $Errores[2] . "<br><br>");
    }

    // 4 - CVE_MUN (CVE_MUN < 01 OR CVE_MUN > 570)
    if(isset($_POST['CVE_MUN'])) {
        $SQL = "SELECT * FROM mar11 WHERE CVE_MUN < 01 OR CVE_MUN > 570;";
        $Result = mysqli_query($Con, $SQL);

        $Errores[3] = mysqli_num_rows($Result);

        $SQL2 = "DELETE FROM mar11 WHERE CVE_MUN < 01 OR CVE_MUN > 570;";
        $Result = mysqli_query($Con, $SQL2);
        print("Errorres eliminados con el filtro CVE_MUN: " . $Errores[3] . "<br><br>");
    }

    // 5 - CVE_LOC (CVE_LOC < 0001 OR CVE_LOC > 8010)
    if(isset($_POST['CVE_LOC'])) {
        $SQL = "SELECT * FROM mar11 WHERE CVE_LOC < 0001 OR CVE_LOC > 8010;";
        $Result = mysqli_query($Con, $SQL);

        $Errores[4] = mysqli_num_rows($Result);

        $SQL2 = "DELETE FROM mar11 WHERE CVE_LOC < 0001 OR CVE_LOC > 8010;";
        $Result = mysqli_query($Con, $SQL2);
        print("Errorres eliminados con el filtro CVE_LOC: " . $Errores[4] . "<br><br>");
    }

    // 6 - ALTITUD (ALTITUD < -27 OR ALTITUD > 4169)
    if(isset($_POST['ALTITUD'])) {
        $SQL = "SELECT * FROM mar11 WHERE ALTITUD < -27 OR ALTITUD > 4169;";
        $Result = mysqli_query($Con, $SQL);

        $Errores[5] = mysqli_num_rows($Result);

        $SQL2 = "DELETE FROM mar11 WHERE ALTITUD < -27 OR ALTITUD > 4169;";
        $Result = mysqli_query($Con, $SQL2);
        print("Errorres eliminados con el filtro ALTITUD: " . $Errores[5] . "<br><br>");
    }

    // 7 - LAT_DECIMAL (LAT_DECIMAL < 14.535464 OR LAT_DECIMAL > 32.716188)
    if(isset($_POST['LAT_DECIMAL'])) {
        $SQL = "SELECT * FROM mar11 WHERE LAT_DECIMAL < 14.535464 OR LAT_DECIMAL > 32.716188;";
        $Result = mysqli_query($Con, $SQL);

        $Errores[6] = mysqli_num_rows($Result);

        $SQL2 = "DELETE FROM mar11 WHERE LAT_DECIMAL < 14.535464 OR LAT_DECIMAL > 32.716188;";
        $Result = mysqli_query($Con, $SQL2);
        print("Errorres eliminados con el filtro LAT_DECIMAL: " . $Errores[6] . "<br><br>");
    }

    // 8 - LONG_DECIMAL (LONG_DECIMAL < -118.302243 OR LONG_DECIMAL > -86.724349)
    if(isset($_POST['LONG_DECIMAL'])) {
        $SQL = "SELECT * FROM mar11 WHERE LONG_DECIMAL < -118.302243 OR LONG_DECIMAL > -86.724349;";
        $Result = mysqli_query($Con, $SQL);

        $Errores[7] = mysqli_num_rows($Result);

        $SQL2 = "DELETE FROM mar11 WHERE LONG_DECIMAL < -118.302243 OR LONG_DECIMAL > -86.724349;";
        $Result = mysqli_query($Con, $SQL2);
        print("Errorres eliminados con el filtro LONG_DECIMAL: " . $Errores[7] . "<br><br>");
    }

    // 9 - NOM_ENT ('Aguascalientes', 'Baja California', 'Baja California Sur', 'Campeche', 'Coahuila de Zaragoza', 'Colima', 'Chiapas', 'Chihuahua', 'Distrito Federal', 'Durango', 'Guanajuato', 'Guerrero', 'Hidalgo', 'Jalisco', 'México', 'Michoacán de Ocampo', 'Morelos', 'Nayarit', 'Nuevo León', 'Oaxaca', 'Puebla', 'Querétaro', 'Quintana Roo', 'San Luis Potosí', 'Sinaloa', 'Sonora', 'Tabasco', 'Tamaulipas', 'Tlaxcala', 'Veracruz de Ignacio de la Llave', 'Yucatán', 'Zacatecas')
    if(isset($_POST['NOM_ENT'])) {
        $SQL = "SELECT * FROM mar11 WHERE NOM_ENT NOT IN('Aguascalientes', 'Baja California', 'Baja California Sur', 'Campeche', 'Coahuila de Zaragoza', 'Colima', 'Chiapas', 'Chihuahua', 'Distrito Federal', 'Durango', 'Guanajuato', 'Guerrero', 'Hidalgo', 'Jalisco', 'México', 'Michoacán de Ocampo', 'Morelos', 'Nayarit', 'Nuevo León', 'Oaxaca', 'Puebla', 'Querétaro', 'Quintana Roo', 'San Luis Potosí', 'Sinaloa', 'Sonora', 'Tabasco', 'Tamaulipas', 'Tlaxcala', 'Veracruz de Ignacio de la Llave', 'Yucatán', 'Zacatecas');";
        $Result = mysqli_query($Con, $SQL);

        $Errores[8] = mysqli_num_rows($Result);

        $SQL2 = "DELETE FROM mar11 WHERE NOM_ENT NOT IN('Aguascalientes', 'Baja California', 'Baja California Sur', 'Campeche', 'Coahuila de Zaragoza', 'Colima', 'Chiapas', 'Chihuahua', 'Distrito Federal', 'Durango', 'Guanajuato', 'Guerrero', 'Hidalgo', 'Jalisco', 'México', 'Michoacán de Ocampo', 'Morelos', 'Nayarit', 'Nuevo León', 'Oaxaca', 'Puebla', 'Querétaro', 'Quintana Roo', 'San Luis Potosí', 'Sinaloa', 'Sonora', 'Tabasco', 'Tamaulipas', 'Tlaxcala', 'Veracruz de Ignacio de la Llave', 'Yucatán', 'Zacatecas');";
        $Result = mysqli_query($Con, $SQL2);
        print("Errorres eliminados con el filtro NOM_ENT: " . $Errores[8] . "<br><br>");
    }

    // 10 - NOM_ABR ('Ags.', 'BC', 'BCS', 'Camp.', 'Coah.', 'Col.', 'Chis.', 'Chih.', 'DF', 'Dgo.', 'Gto.', 'Gro.', 'Hgo.', 'Jal.', 'Mex.', 'Mich.', 'Mor.', 'Nay.', 'NL', 'Oax.', 'Pue.', 'Qro.', 'Q. Roo', 'SLP', 'Sin.', 'Son.', 'Tab.', 'Tamps.', 'Tlax.', 'Ver.', 'Yuc.', 'Zac.')
    if(isset($_POST['NOM_ABR'])) {
        $SQL = "SELECT * FROM mar11 WHERE NOM_ABR NOT IN('Ags.', 'BC', 'BCS', 'Camp.', 'Coah.', 'Col.', 'Chis.', 'Chih.', 'DF', 'Dgo.', 'Gto.', 'Gro.', 'Hgo.', 'Jal.', 'Mex.', 'Mich.', 'Mor.', 'Nay.', 'NL', 'Oax.', 'Pue.', 'Qro.', 'Q. Roo', 'SLP', 'Sin.', 'Son.', 'Tab.', 'Tamps.', 'Tlax.', 'Ver.', 'Yuc.', 'Zac.');";
        $Result = mysqli_query($Con, $SQL);

        $Errores[9] = mysqli_num_rows($Result);

        $SQL2 = "DELETE FROM mar11 WHERE NOM_ABR NOT IN('Ags.', 'BC', 'BCS', 'Camp.', 'Coah.', 'Col.', 'Chis.', 'Chih.', 'DF', 'Dgo.', 'Gto.', 'Gro.', 'Hgo.', 'Jal.', 'Mex.', 'Mich.', 'Mor.', 'Nay.', 'NL', 'Oax.', 'Pue.', 'Qro.', 'Q. Roo', 'SLP', 'Sin.', 'Son.', 'Tab.', 'Tamps.', 'Tlax.', 'Ver.', 'Yuc.', 'Zac.');";
        $Result = mysqli_query($Con, $SQL2);
        print("Errorres eliminados con el filtro NOM_ABR: " . $Errores[9] . "<br><br>");
    }

    mysqli_close($Con);
?>