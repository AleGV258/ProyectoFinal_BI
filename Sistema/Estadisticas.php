<?php

    // PROYECTO FINAL
    // MATERIA: Inteligencia de Negocios 
    // INTEGRANTES: 
    //     - García Vargas Michell Alejandro - 259663
    //     - Jiménez Elizalde Andrés - 259678
    //     - León Paulin Daniel - 260541

    session_start();
    $array = $_SESSION['arrayEstadisticas'];
    $NombreArchivo = $array[0]; // Nombre del archivo
    $TipoArchivo = $array[1]; // Tipo de archivo
    $Total = $array[2]; // Cantidad total de filas que estaban en el archivo
    $Insertados = $array[3]; // Cantidad de inserts correctos
    $Errores = $array[4]; // Cantidad de errores encontrados

    $PorcentajeInsertados = intval($Insertados / $Total * 100); // PorcentajeInsertados de datos insertados
    $PorcentajeErrores = intval($Errores / $Total * 100); // PorcentajeInsertados de datos no insertados

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Estadísiticas</title>
    </head>

    <body>
        <div id="titulo">Estadísticas</div>
        <br>
        <div id="nombre">
            <div id="dato">
                Nombre del archivo: <strong><?php echo $NombreArchivo; ?></strong>
            </div>
            <div id="dato">
                Tipo de archivo: <strong><?php echo $TipoArchivo; ?></strong>
            </div>
            <!-- <div id="dato">
                <a href="../ETL/FFiltro.html ">
                    <input id="filtro" type="button" value="Aplicar Filtro" />
                </a>
            </div> -->


        </div>
        <br>
        <div id="total">
            <div id="totalValor">
                <?php echo $Total; ?>
            </div>
            <div id="totalTexto">Total de datos Insertados correctamente</div>
        </div>
        <br>
        <div>
            <div id="porcentajes">
                <div id="circulo1">
                    <?php echo $PorcentajeInsertados; ?>%
                </div>
                <div id="circulo2">
                    <?php echo $Errores; ?>%
                </div>
            </div>
            <div id="info">
                <strong>Datos Insertados correctamente</strong>
                <br>
                Se han insertado <strong><?php echo $Insertados; ?></strong> datos correctamente a la base de datos.
                <br>
                <br>
                <br>
                <strong>Datos no insertados</strong>
                <br>
                Se han detectado <strong><?php echo $Errores; ?></strong> datos que no se pudieron insertar correctamente a la base de datos.

            </div>
        </div>
        <div>
            <form action="./AplicarFiltro.php" method="post">

                <label for="">Selecciona los filtros que serán aplicados</label><br><br>

                <input type="checkbox" name="CVE_ENT" id="CVE_ENT">
                <label for="CVE_ENT"> CVE_ENT </label><br>

                <input type="checkbox" name="AMBITO" id="AMBITO">
                <label for="AMBITO"> AMBITO </label><br>

                <input type="checkbox" name="MAPA" id="MAPA">
                <label for="MAPA"> MAPA </label><br>

                <input type="checkbox" name="CVE_MUN" id="CVE_MUN">
                <label for="CVE_MUN"> CVE_MUN </label><br>

                <input type="checkbox" name="CVE_LOC" id="CVE_LOC">
                <label for="CVE_LOC"> CVE_LOC </label><br>

                <input type="checkbox" name="ALTITUD" id="ALTITUD">
                <label for="ALTITUD"> ALTITUD </label><br>

                <input type="checkbox" name="LAT_DECIMAL" id="LAT_DECIMAL">
                <label for="LAT_DECIMAL"> LAT_DECIMAL </label><br>

                <input type="checkbox" name="LONG_DECIMAL" id="LONG_DECIMAL">
                <label for="LONG_DECIMAL"> LONG_DECIMAL </label><br>

                <input type="checkbox" name="NOM_ENT" id="NOM_ENT">
                <label for="NOM_ENT"> NOM_ENT </label><br>

                <input type="checkbox" name="NOM_ABR" id="NOM_ABR">
                <label for="NOM_ABR"> NOM_ABR </label><br><br>

                <input type="submit" value="Continuar">
            </form>
        </div>
        <style>
            #filtro {
                border: 10px solid blue;
                border-radius: 7px;
            }

            #info {
                width: 900px;
                float: left;
                /* margin-left: 40%;
                margin-top: 30%; */
                margin-left: 450px;
                margin-top: 220px;
                font-size: 40px;
                text-align: left;
                position: absolute;
            }

            #nombre {
                width: 100%;
                font-size: 30px;
                text-align: center;
                position: absolute;
            }

            #dato {
                float: left;
                margin-left: 15%;
            }

            #total {
                box-sizing: border-box;
                position: absolute;
                width: 80%;
                height: 17%;
                left: 10%;
                margin-top: 2%;
                background: #EFEFEF;
                border: 10px solid #D0D0D0;
                border-radius: 20px;
            }

            #titulo {
                font-family: 'Inter';
                font-size: 64px;
                line-height: 77px;
                text-align: center;
            }

            #totalValor {
                font-family: 'Inter';
                box-sizing: border-box;
                position: absolute;
                height: 80%;
                top: 10%;
                left: 20px;
                background: #D9D9D9;
                border: 7px solid #037E3C;
                border-radius: 16px;
                text-align: center;
                font-size: 60px;
                vertical-align: text-top;
                padding-left: 20px;
                padding-right: 20px;
            }

            #totalTexto {
                position: absolute;
                font-family: 'Inter';
                font-style: normal;
                font-weight: 400;
                font-size: 32px;
                line-height: 39px;
                color: #000000;
                text-align: left;
                padding-left: 25%;
                top: 25%;
                vertical-align: text-top;
            }

            #porcentajes {
                box-sizing: border-box;
                margin-top: 170px;
                margin-left: 10%;
                position: absolute;
                width: 246px;
                /* height: 55%; */
                background: #EFEFEF;
                border: 10px solid #D0D0D0;
                border-radius: 60px;
                float: left;
            }

            #circulo1 {
                box-sizing: border-box;
                font-size: 70px;
                text-align: center;
                padding-top: 20%;
                /* position: absolute; */
                width: 185.16px;
                height: 185.16px;
                margin: 20px;
                /* left: 234px;
                top: 546px; */
                border-radius: 100%;
                background: #FFFFFF;
                border: 9px solid #000AFF;
                float: left;

            }

            #circulo2 {
                box-sizing: border-box;
                float: left;
                font-size: 70px;
                text-align: center;
                padding-top: 20%;
                /* position: absolute; */
                width: 185.16px;
                height: 185.16px;
                margin: 20px;
                /* left: 234px;
                top: 546px; */
                border-radius: 100%;
                background: #FFFFFF;
                border: 9px solid red;
            }
        </style>


    </body>

    </html>
<?php
    // } else {
    //     header('Location: Login.html');
    // }
?>