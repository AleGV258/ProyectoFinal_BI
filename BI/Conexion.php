<?php

// PROYECTO FINAL
// MATERIA: Inteligencia de Negocios 
// INTEGRANTES: 
//     - García Vargas Michell Alejandro - 259663
//     - Jiménez Elizalde Andrés - 259678
//     - León Paulin Daniel - 260541

// Conectarse al SMBD
$Conexion = mysqli_connect('127.0.0.1', 'root', '', 'data');

// Recuperar la sesion de las variables
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_GET['tabla']) && isset($_GET['k']) && isset($_GET['j']) && isset($_GET['m']) && isset($_GET['a']) && isset($_GET['pronostico'])) {
    $TABLA = $_GET['tabla'];
    $K = $_GET['k'];
    $J = $_GET['j'];
    $M = $_GET['m'];
    $ALFA = $_GET['a'];
    $PRONOSTICO = $_GET['pronostico'];
} else {
    $TABLA = $_SESSION['tabla'];
    $K = $_SESSION['k'];
    $J = $_SESSION['j'];
    $M = $_SESSION['m'];
    $ALFA = $_SESSION['a'];
    $PRONOSTICO = $_SESSION['pronostico'];
}

// Ejectar Consultas
$SQL = 'SELECT Periodo, Frecuencia FROM ' . $TABLA . ';';
$Result = mysqli_query($Conexion, $SQL);
$N = mysqli_num_rows($Result);
if ($K > 0 && $K < ($N - 1)) {
    if ($J > 0 && $J < ($N - $K - 1)) {
        if ($M > 0) {
            if ($ALFA >= 0 && $ALFA <= 1) {
                // Calcular la Tabla con Pronósticos

                // Interpretar Resultados
                for ($f = 0; $f < mysqli_num_rows($Result); $f++) {
                    $Fila = mysqli_fetch_row($Result);
                    $Datos[$f][0] = $Fila[0]; // Periodo
                    $Datos[$f][1] = $Fila[1]; // Frecuencia
                }
                $Total = count($Datos); // 100

                // Hacer Nulos los Valores Pronosticados
                for ($c = 0; $c < 100; $c++) {
                    $Datos[$Total][$c] = NULL;
                }
                if ($TABLA == 'Temperatura_Maxima' || $TABLA == 'Acciones_Google') {
                    $Datos[$Total][0] = date('Y-m-d', strtotime($Datos[$Total - 1][0] . ' + 1 months'));
                }

                // Calcular Promedio Simple (PS)
                $Datos[0][2] = NULL;
                $AcumuladorPS = 0;
                for ($f = 1; $f <= $Total; $f++) {
                    $AcumuladorPS = $AcumuladorPS + $Datos[$f - 1][1];
                    $PS = ($AcumuladorPS / $f);
                    $Datos[$f][2] = round($PS, 2); // Promedio Simple
                }

                // Calcular Promedio Móvil Simple (PMS)
                for ($f = 0; $f < $K; $f++) {
                    $Datos[$f][5] = NULL;
                }
                for ($f = $K; $f <= $Total; $f++) {
                    $AcumuladorPMS = 0;
                    for ($i = 1; $i <= $K; $i++) {
                        $AcumuladorPMS = $AcumuladorPMS + $Datos[$f - $i][1];
                    }
                    $PMS = ($AcumuladorPMS / $K);
                    $Datos[$f][5] = round($PMS, 2); // Promedio Móvil Simple
                }

                // Calcular Promedio Móvil Doble (PMD)
                for ($f = 0; $f < ($K + $J); $f++) {
                    $Datos[$f][8] = NULL;
                }
                for ($f = ($K + $J); $f <= $Total; $f++) {
                    $AcumuladorPMD = 0;
                    for ($i = 1; $i <= $J; $i++) {
                        $AcumuladorPMD = $AcumuladorPMD + $Datos[$f - $i][5];
                    }
                    $PMD = ($AcumuladorPMD / $J);
                    $Datos[$f][8] = round($PMD, 2); // Promedio Móvil Doble
                }

                // Calcular Promedio Móvil Doble Ajustado (PMDA)
                for ($f = 0; $f < ($K + $J); $f++) {
                    $Datos[$f][11] = NULL;
                }
                for ($f = ($K + $J); $f <= $Total; $f++) {
                    $A = ($Datos[$f][5] * 2) - $Datos[$f][8];
                    $B = ((abs($Datos[$f][5] - $Datos[$f][8]) * 2) / ($Total - 1));
                    $PMDA = $A + ($B * $M);
                    $Datos[$f][11] = round($PMDA, 2); // Promedio Móvil Doble Ajustado
                }

                // Calcular Prónostico de Tasa Media de Crecimiento
                $Datos[0][14] = NULL;
                $Datos[0][15] = NULL;
                $Datos[1][15] = NULL;
                for ($f = 1; $f < $Total; $f++) {
                    $TMAC = ((($Datos[$f][1] / $Datos[$f - 1][1]) - 1) * 100);
                    $Datos[$f][14] = round($TMAC, 2);
                }
                for ($f = 2; $f <= $Total; $f++) {
                    $PTMAC = ((($Datos[$f - 1][14] / 100) * $Datos[$f - 1][1]) + $Datos[$f - 1][1]);
                    $Datos[$f][15] = round($PTMAC, 2); // Pronóstico de Tasa Media de Crecimiento
                }

                // Calcular Suavizado Exponencial
                $r = 0;
                $c = 0;
                switch ($PRONOSTICO) {
                    case 'PS':
                        $r = 2;
                        $c = 2;
                        break;
                    case 'PMS':
                        $r = $K + 1;
                        $c = 5;
                        break;
                    case 'PMD':
                        $r = ($K + $J) + 1;
                        $c = 8;
                        break;
                    case 'PMDA':
                        $r = ($K + $J) + 1;
                        $c = 11;
                        break;
                    case 'PTMAC':
                        $r = 3;
                        $c = 15;
                        break;
                }
                for ($f = 0; $f < $r; $f++) {
                    $Datos[$f][18] = NULL;
                }
                for ($f = $r; $f <= $Total; $f++) {
                    $SE = ((($Datos[$f - 1][1] - $Datos[$f - 1][$c]) * $ALFA) + $Datos[$f - 1][$c]);
                    $Datos[$f][18] = round($SE, 2); // Suavizado Exponencial
                }

                // ----------------------------------- ERRORES -----------------------------------
                $Error_Medio = [];
                $Error_Relativo = [];
                $Error_Cuadratico_Medio = [];

                // Calcular Error Absoluto (PS)
                $ErrorABS = 0;
                $Datos[0][3] = NULL;
                for ($f = 1; $f < $Total; $f++) {
                    $ErrorABS = abs($Datos[$f][1] - $Datos[$f][2]);
                    $Datos[$f][3] =  round($ErrorABS, 2);
                }

                // Calcular Error Medio (PS)
                $Suma = 0;
                $ErrorMedio = 0;
                for ($f = 1; $f < $Total; $f++) {
                    $Suma = $Suma + $Datos[$f][3];
                    $ErrorMedio = ($Suma / $f);
                }
                $Error_Medio[0] = round($ErrorMedio, 2);

                // Calcular Error Relativo (PS)
                $ValorPronosticado = $PS;
                $ErrorRelativo = (($ErrorMedio * 100) / $ValorPronosticado);
                $Error_Relativo[0] = round($ErrorRelativo, 2);

                // Calcular Error Cuadrático Medio (PS)
                $Exponente = 0;
                $SumaExp = 0;
                $ErrorCuadraticoMedio = 0;
                $Datos[0][4] = NULL;
                for ($f = 1; $f < $Total; $f++) {
                    $Exponente = $Datos[$f][3] * $Datos[$f][3];
                    $SumaExp = $SumaExp + $Exponente;
                    $Datos[$f][4] = round($Exponente, 2);
                }
                $ErrorCuadraticoMedio = sqrt($SumaExp / ($Total - 1));
                $Error_Cuadratico_Medio[0] = round($ErrorCuadraticoMedio, 2);

                // Calcular Error Absoluto (PMS)
                $ErrorABS = 0;
                for ($f = 0; $f < $K; $f++) {
                    $Datos[$f][6] = NULL;
                    $Datos[$f][7] = NULL;
                }
                for ($f = $K; $f < $Total; $f++) {
                    $ErrorABS = abs($Datos[$f][1] - $Datos[$f][5]);
                    $Datos[$f][6] = round($ErrorABS, 2);
                }

                // Calcular Error Medio (PMS)
                $Suma = 0;
                $ErrorMedio = 0;
                for ($f = $K; $f < $Total; $f++) {
                    $Suma = $Suma + $Datos[$f][6];
                }
                $ErrorMedio = ($Suma / ($Total - $K));
                $Error_Medio[1] = round($ErrorMedio, 2);

                // Calcular Error Relativo (PMS)
                $ValorPronosticado = $PMS;
                $ErrorRelativo = (($ErrorMedio * 100) / $ValorPronosticado);
                $Error_Relativo[1] = round($ErrorRelativo, 2);

                // Calcular Error Cuadrático Medio (PMS)
                $Exponente = 0;
                $SumaExp = 0;
                $ErrorCuadraticoMedio = 0;
                for ($f = $K; $f < $Total; $f++) {
                    $Exponente = $Datos[$f][6] * $Datos[$f][6];
                    $SumaExp = $SumaExp + $Exponente;
                    $Datos[$f][7] = round($Exponente, 2);
                }
                $ErrorCuadraticoMedio = sqrt($SumaExp / ($Total - $K));
                $Error_Cuadratico_Medio[1] = round($ErrorCuadraticoMedio, 2);

                // Calcular Error Absoluto (PMD)
                $ErrorABS = 0;
                for ($f = 0; $f < ($K + $J); $f++) {
                    $Datos[$f][9] = NULL;
                    $Datos[$f][10] = NULL;
                }
                for ($f = ($K + $J); $f < $Total; $f++) {
                    $ErrorABS = abs($Datos[$f][1] - $Datos[$f][8]);
                    $Datos[$f][9] = round($ErrorABS, 2);
                }

                // Calcular Error Medio (PMD)
                $Suma = 0;
                $ErrorMedio = 0;
                for ($f = ($K + $J); $f < $Total; $f++) {
                    $Suma = $Suma + $Datos[$f][9];
                }
                $ErrorMedio = ($Suma / ($Total - ($K + $J)));
                $Error_Medio[2] = round($ErrorMedio, 2);

                // Calcular Error Relativo (PMD)
                $ValorPronosticado = $PMD;
                for ($f = $Total; $f <= ($Total + 1); $f++) {
                    $AcumuladorPMD = 0;
                    for ($i = 1; $i < $J; $i++) {
                        $AcumuladorPMD = $AcumuladorPMD + $Datos[$f - $i][5];
                    }
                }
                $ValorPronosticado2 = (($AcumuladorPMD + $ValorPronosticado) / $J);
                $ErrorRelativo = (($ErrorMedio * 100) / $ValorPronosticado2);
                $Error_Relativo[2] = round($ErrorRelativo, 2);

                // Calcular Error Cuadrático Medio (PMD)
                $Exponente = 0;
                $SumaExp = 0;
                $ErrorCuadraticoMedio = 0;
                for ($f = ($K + $J); $f < $Total; $f++) {
                    $Exponente = $Datos[$f][9] * $Datos[$f][9];
                    $SumaExp = $SumaExp + $Exponente;
                    $Datos[$f][10] = round($Exponente, 2);
                }
                $ErrorCuadraticoMedio = sqrt($SumaExp / ($Total - ($K + $J)));
                $Error_Cuadratico_Medio[2] = round($ErrorCuadraticoMedio, 2);

                // Calcular Error Absoluto (PMDA)
                $ErrorABS = 0;
                for ($f = 0; $f < ($K + $J); $f++) {
                    $Datos[$f][12] = NULL;
                    $Datos[$f][13] = NULL;
                }
                for ($f = ($K + $J); $f < $Total; $f++) {
                    $ErrorABS = abs($Datos[$f][1] - $Datos[$f][11]);
                    $Datos[$f][12] = round($ErrorABS, 2);
                }

                // Calcular Error Medio (PMDA)
                $Suma = 0;
                $ErrorMedio = 0;
                for ($f = ($K + $J); $f < $Total; $f++) {
                    $Suma = $Suma + $Datos[$f][12];
                }
                $ErrorMedio = ($Suma / ($Total - ($K + $J)));
                $Error_Medio[3] = round($ErrorMedio, 2);

                // Calcular Error Relativo (PMDA)
                $ValorPronosticado = $PMDA;
                $ErrorRelativo = (($ErrorMedio * 100) / $ValorPronosticado);
                $Error_Relativo[3] = round($ErrorRelativo, 2);

                // Calcular Error Cuadrático Medio (PMDA)
                $Exponente = 0;
                $SumaExp = 0;
                $ErrorCuadraticoMedio = 0;
                for ($f = ($K + $J); $f < $Total; $f++) {
                    $Exponente = $Datos[$f][12] * $Datos[$f][12];
                    $SumaExp = $SumaExp + $Exponente;
                    $Datos[$f][13] = round($Exponente, 2);
                }
                $ErrorCuadraticoMedio = sqrt($SumaExp / ($Total - ($K + $J)));
                $Error_Cuadratico_Medio[3] = round($ErrorCuadraticoMedio, 2);

                // Calcular Error Absoluto (PTMAC)
                $ErrorABS = 0;
                for ($f = 0; $f < 2; $f++) {
                    $Datos[$f][16] = NULL;
                    $Datos[$f][17] = NULL;
                }
                for ($f = 2; $f < $Total; $f++) {
                    $ErrorABS = abs($Datos[$f][1] - $Datos[$f][15]);
                    $Datos[$f][16] = round($ErrorABS, 2);
                }

                // Calcular Error Medio (PTMAC)
                $Suma = 0;
                $ErrorMedio = 0;
                for ($f = 2; $f < $Total; $f++) {
                    $Suma = $Suma + $Datos[$f][16];
                }
                $ErrorMedio = ($Suma / ($Total - 2));
                $Error_Medio[4] = round($ErrorMedio, 2);

                // Calcular Error Relativo (PTMAC)
                $ValorPronosticado = $PTMAC;
                $ErrorRelativo = (($ErrorMedio * 100) / $ValorPronosticado);
                $Error_Relativo[4] = round($ErrorRelativo, 2);

                // Calcular Error Cuadrático Medio (PTMAC)
                $Exponente = 0;
                $SumaExp = 0;
                $ErrorCuadraticoMedio = 0;
                for ($f = 2; $f < $Total; $f++) {
                    $Exponente = $Datos[$f][16] * $Datos[$f][16];
                    $SumaExp = $SumaExp + $Exponente;
                    $Datos[$f][17] = round($Exponente, 2);
                }
                $ErrorCuadraticoMedio = sqrt($SumaExp / ($Total - 2));
                $Error_Cuadratico_Medio[4] = round($ErrorCuadraticoMedio, 2);

                // Calcular Error Absoluto (SE)
                $ErrorABS = 0;
                for ($f = 0; $f < $r; $f++) {
                    $Datos[$f][19] = NULL;
                    $Datos[$f][20] = NULL;
                }
                for ($f = $r; $f < $Total; $f++) {
                    $ErrorABS = abs($Datos[$f][1] - $Datos[$f][18]);
                    $Datos[$f][19] = round($ErrorABS, 2);
                }

                // Calcular Error Medio (SE)
                $Suma = 0;
                $ErrorMedio = 0;
                for ($f = $r; $f < $Total; $f++) {
                    $Suma = $Suma + $Datos[$f][19];
                }
                $ErrorMedio = ($Suma / ($Total - $r));
                $Error_Medio[5] = round($ErrorMedio, 2);

                // Calcular Error Relativo (SE)
                $ValorPronosticado = $SE;
                $ErrorRelativo = (($ErrorMedio * 100) / $ValorPronosticado);
                $Error_Relativo[5] = round($ErrorRelativo, 2);

                // Calcular Error Cuadrático Medio (SE)
                $Exponente = 0;
                $SumaExp = 0;
                $ErrorCuadraticoMedio = 0;
                for ($f = $r; $f < $Total; $f++) {
                    $Exponente = $Datos[$f][19] * $Datos[$f][19];
                    $SumaExp = $SumaExp + $Exponente;
                    $Datos[$f][20] = round($Exponente, 2);
                }
                $ErrorCuadraticoMedio = sqrt($SumaExp / ($Total - $r));
                $Error_Cuadratico_Medio[5] = round($ErrorCuadraticoMedio, 2);

                // Creación de Tabla
                echo ("<div class='row'><a class='column1' href='./Configuracion.html'>Regresar</a>");
                switch ($TABLA) {
                    case 'Temperatura_Maxima':
                        echo ("<h2 class='column2''>Temperatura Máxima de Querétaro</h2><br>");
                        break;
                    case 'Acciones_Google':
                        echo ("<h2 class='column2''>Acciones de Google</h2><br>");
                        break;
                }
                echo ("</div><table><tr>");
                echo ("  </tr>
            <tr>
                <th>NO.</th>
                <th>PERIODO</th>
                <th>FRECUENCIA</th>
                <th>PROMEDIO SIMPLE (PS)</th>
                <th>ERROR ABSOLUTO (PS)</th>
                <th>CUADRADO (PS)</th>
                <th>PROMEDIO MÓVIL SIMPLE (PMS)</th>
                <th>ERROR ABSOLUTO (PMS)</th>
                <th>CUADRADO (PMS)</th>
                <th>PROMEDIO MÓVIL DOBLE (PMD)</th>
                <th>ERROR ABSOLUTO (PMD)</th>
                <th>CUADRADO (PMD)</th>
                <th>PROMEDIO MÓVIL DOBLE AJUSTADO (PMDA)</th>
                <th>ERROR ABSOLUTO (PMDA)</th>
                <th>CUADRADO (PMDA)</th>
                <th>TASA MEDIA DE CRECIMIENTO (TMAC)</th>
                <th>PRONÓSTICO DE TASA MEDIA DE CRECIMIENTO (PTMAC)</th>
                <th>ERROR ABSOLUTO (PTMAC)</th>
                <th>CUADRADO (PTMAC)</th>
                <th>SUAVIZADO EXPONENCIAL (SE)</th>
                <th>ERROR ABSOLUTO (SE)</th>
                <th>CUADRADO (SE)</th>
            </tr>");

                // Mostrar Matriz
                for ($f = 0; $f < mysqli_num_rows($Result) + 1; $f++) {
                    echo ("<tr><td>");
                    echo ($f + 1); // NÚMERO
                    echo ("</td><td>");
                    echo ($Datos[$f][0]); // PERIODO
                    echo ("</td><td>");
                    echo ($Datos[$f][1]); // FRECUENCIA
                    echo ("</td><td>");
                    echo ($Datos[$f][2]); // PROMEDIO SIMPLE
                    echo ("</td><td>");
                    echo ($Datos[$f][3]); // ERROR ABSOLUTO
                    echo ("</td><td>");
                    echo ($Datos[$f][4]); // CUADRADO
                    echo ("</td><td>");
                    echo ($Datos[$f][5]); // PROMEDIO MÓVIL SIMPLE
                    echo ("</td><td>");
                    echo ($Datos[$f][6]); // ERROR ABSOLUTO
                    echo ("</td><td>");
                    echo ($Datos[$f][7]); // CUADRADO
                    echo ("</td><td>");
                    echo ($Datos[$f][8]); // PROMEDIO MÓVIL DOBLE
                    echo ("</td><td>");
                    echo ($Datos[$f][9]); // ERROR ABSOLUTO
                    echo ("</td><td>");
                    echo ($Datos[$f][10]); // CUADRADO
                    echo ("</td><td>");
                    echo ($Datos[$f][11]); // PROMEDIO MÓVIL DOBLE AJUSTADO
                    echo ("</td><td>");
                    echo ($Datos[$f][12]); // ERROR ABSOLUTO
                    echo ("</td><td>");
                    echo ($Datos[$f][13]); // CUADRADO
                    echo ("</td><td>");
                    echo ($Datos[$f][14]); // TASA MEDIA DE CRECIMIENTO
                    echo ("</td><td>");
                    echo ($Datos[$f][15]); // PRONÓSTICO DE TASA MEDIA DE CRECIMIENTO
                    echo ("</td><td>");
                    echo ($Datos[$f][16]); // ERROR ABSOLUTO
                    echo ("</td><td>");
                    echo ($Datos[$f][17]); // CUADRADO
                    echo ("</td><td>");
                    echo ($Datos[$f][18]); // SUAVIZADO EXPONENCIAL
                    echo ("</td><td>");
                    echo ($Datos[$f][19]); // ERROR ABSOLUTO
                    echo ("</td><td>");
                    echo ($Datos[$f][20]); // CUADRADO
                    echo ("</td></tr>");
                }

                // Mostrar Errores
                echo ("<tr><td>");
                echo ($Total + 2);
                echo ("</td><td></td><td></td><td>Error Medio</td><td>");
                echo ($Error_Medio[0]);
                echo ("</td><td></td><td>Error Medio</td><td>");
                echo ($Error_Medio[1]);
                echo ("</td><td></td><td>Error Medio</td><td>");
                echo ($Error_Medio[2]);
                echo ("</td><td></td><td>Error Medio</td><td>");
                echo ($Error_Medio[3]);
                echo ("</td><td></td><td>Error Medio</td><td>");
                echo ($Error_Medio[4]);
                echo ("</td><td></td><td>Error Medio</td><td>");
                echo ($Error_Medio[5]);
                echo ("</td></tr><tr><td>");
                echo ($Total + 3);
                echo ("</td><td></td><td></td><td>Error Relativo</td><td>");
                echo ($Error_Relativo[0]);
                echo ("</td><td></td><td>Error Relativo</td><td>");
                echo ($Error_Relativo[1]);
                echo ("</td><td></td><td>Error Relativo</td><td>");
                echo ($Error_Relativo[2]);
                echo ("</td><td></td><td>Error Relativo</td><td>");
                echo ($Error_Relativo[3]);
                echo ("</td><td></td><td>Error Relativo</td><td>");
                echo ($Error_Relativo[4]);
                echo ("</td><td></td><td>Error Relativo</td><td>");
                echo ($Error_Relativo[5]);
                echo ("</td></tr><tr><td>");
                echo ($Total + 4);
                echo ("</td><td></td><td></td><td>Error Cuadrático Medio</td><td>");
                echo ($Error_Cuadratico_Medio[0]);
                echo ("</td><td></td><td>Error Cuadrático Medio</td><td>");
                echo ($Error_Cuadratico_Medio[1]);
                echo ("</td><td></td><td>Error Cuadrático Medio</td><td>");
                echo ($Error_Cuadratico_Medio[2]);
                echo ("</td><td></td><td>Error Cuadrático Medio</td><td>");
                echo ($Error_Cuadratico_Medio[3]);
                echo ("</td><td></td><td>Error Cuadrático Medio</td><td>");
                echo ($Error_Cuadratico_Medio[4]);
                echo ("</td><td></td><td>Error Cuadrático Medio</td><td>");
                echo ($Error_Cuadratico_Medio[5]);
                echo ("</td></tr>");

                // Estilos de la Tabla
                echo ("</table><br>");
                echo ("
        <style>
            body {
                font-family: Verdana, Geneva, sans-serif;
                text-align: center;
            }
            table {
                font-weight: 600;
                border-collapse: collapse;
                width: 50%;
                border: 1px solid #372869;
                margin-left: auto;
                margin-right: auto;
            }
            th{
                text-align: center;
                padding: 10px 30px;
                background-color: #372869;
                color: #fff;
            }
            td {
                border: 1px solid #5f27cd;
                text-align: center;
                padding: 15px 7px;
            }
            tr:nth-child(even) {
                background-color: rgba(140, 122, 230, 0.7);
            }
            tr:nth-child(odd) {
                background-color: rgba(156, 136, 255, 0.3);
            }
            .row {
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .column1 {
                flex: 10%;
                padding: 1% 4%;
                margin-left: 5%;
                margin-right: -15%;
                background-color: #372869;
                border: none;
                border-radius: 100px;
                color: #fff;
                font-weight: 600;
                font-size: large;
                text-decoration: none;
            }
            .column2 {
                flex: 150%;
                padding: 30px 0;
                z-index: -1;
            }
            .column1:hover{
                color: white;
                background-color: rgba(140, 122, 230, 0.7);
                color: #000;
                border: white 0px solid;
                cursor: pointer;
            }
            .column1:active{
                padding: 0.8% 3.5%;
                margin-right: -14.5%;
                margin-left: 5.5%;
                color: white;
                background-color: rgba(140, 122, 230, 0.7);
                color: #000;
                border: white 0px solid;
                cursor: pointer;
            }
        </style>
    ");

                $Pronostico = [];
                $Pronostico[0] = array_search(min($Error_Medio), $Error_Medio);
                $Pronostico[1] = array_search(min($Error_Relativo), $Error_Relativo);
                $Pronostico[2] = array_search(min($Error_Cuadratico_Medio), $Error_Cuadratico_Medio);
                for ($i = 0; $i < 3; $i++) {
                    switch ($Pronostico[$i]) {
                        case 0:
                            $Pronostico[$i] = "Promedio Simple";
                            break;
                        case 1:
                            $Pronostico[$i] = "Promedio Móvil Simple";
                            break;
                        case 2:
                            $Pronostico[$i] = "Promedio Móvil Doble";
                            break;
                        case 3:
                            $Pronostico[$i] = "Promedio Móvil Doble Ajustado";
                            break;
                        case 4:
                            $Pronostico[$i] = "Predicción de Tasa Media de Crecimiento";
                            break;
                        case 5:
                            $Pronostico[$i] = "Suavizado Exponencial";
                            break;
                    }
                }

                // Errores Mínimos
                echo ("<br><h4>Error Medio: ");
                echo (min($Error_Medio));
                echo (" - ");
                echo ($Pronostico[0]);
                echo ("</h4><h4>Error Relativo: ");
                echo (min($Error_Relativo));
                echo (" - ");
                echo ($Pronostico[1]);
                echo ("</h4><h4>Error Cuadrático Medio: ");
                echo (min($Error_Cuadratico_Medio));
                echo (" - ");
                echo ($Pronostico[2]);
                echo ("</h4>");

                // Cerrar Conexion
                mysqli_close($Conexion);

                $_SESSION['tabla'] = $TABLA;
                $_SESSION['k'] = $K;
                $_SESSION['j'] = $J;
                $_SESSION['m'] = $M;
                $_SESSION['a'] = $ALFA;
                $_SESSION['pronostico'] = $PRONOSTICO;
                $_SESSION["Datos"] = $Datos;

                // include("./Grafico1.php");
                echo ("<br>");
                include("./Grafico2.php");
            } else {
                echo ("<br>El valor de ALFA es incorrecto<br>");
            }
        } else {
            echo ("<br>El valor de M es incorrecto<br>");
        }
    } else {
        echo ("<br>El valor de J es incorrecto<br>");
    }
} else {
    echo ("<br>El valor de K es incorrecto<br>");
}



// ENVIAR CORREO
require('../Sistema/EnviarCorreo.php');
require('../Sistema/generarPDF.php');

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
analisisPDF($TABLA, $K, $J, $M, $ALFA, $PRONOSTICO, $Correo, $Usuario);
