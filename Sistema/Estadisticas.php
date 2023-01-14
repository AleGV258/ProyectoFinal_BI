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
<html lang="es" charset="UTF-8">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Estadísiticas</title>
    </head>
    <body>
        <div class='row'>
            <a class='column1' href='../ETL/CargarArchivo.html'>Regresar</a>
            <label class="column2">Estadísiticas (Todavia no termino con los estilos)</label><br><br>
        </div>
        <!-- <div id="titulo">Estadísticas</div> -->
        <div class="estadistica">
            Nombre del archivo: <?php echo("<a style='color: rgba(140, 122, 230, 0.7);'>".$NombreArchivo."</a>"); ?><br>
        </div>
        <div class="estadistica">
            Tipo de archivo: <?php echo("<a style='color: rgba(140, 122, 230, 0.7);''>.".$TipoArchivo."</a>"); ?><br>
        </div>



        <div id="nombre">
            <!-- <div id="dato">
                <a href="../ETL/FFiltro.html ">
                    <input id="filtro" type="button" value="Aplicar Filtro" />
                </a>
            </div> -->
        </div>



        <div class="insertados">
            <div class="insertadosPorcentaje"><?php echo($Total); ?></div>
            <div class="insertadosTexto">Total de Datos Insertados Correctamente</div>
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
        <!-- <div>
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
        </div> -->
    </body>
</html>
<style>
    body {
        background-color: #372869;
        font-family: Verdana, Geneva, sans-serif;
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
        padding: 1% 0;
    }
    form {
        display: grid;
        grid-template-columns: 40%; 
        justify-content: center;
        align-self: center;
    }
    .title{
        margin-top: 8%;
    }
    .inputdata{
        font-size: large;
        font-weight: 600;
        padding: 3% 0.8%;
        margin: 2% 0 2% 0;
        border-radius: 10px;
        text-align: center;
        outline: none;
        border: none;
        cursor: pointer;
    }
    .insertados{
        width: 60%;
        display: grid;
        grid-template-columns: 30% 50%;
        justify-content: center;
        align-items: center;
        text-align: center;
        background-color: red;
    }
    .insertadosPorcentaje{
        float: left;
    }
    .insertadosTexto{
        float: left;
    }





    .inputdata:hover{
        background-color: rgba(140, 122, 230, 0.7);
    }
    input[type="submit"]:hover{
        background-color: rgba(140, 122, 230, 0.7);
    }
    input[type="submit"]:active{
        color: white;
    }
    input[type="file"]{
        display: none;
    }
    .uploadLabel {
        border: 1px solid #ccc;
        display: inline-block;
        padding: 7px 15px;
        cursor: pointer;
        border-radius: 5px;
        text-align: center;
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
        .row { grid-template-columns: repeat(1, 1fr); }
        .column1 { margin-left: 0; padding: 3% 0% }
        .column2 { padding-right: 0; }
        .column1:active{ color: white; background-color: rgba(140, 122, 230, 0.7); }
    }
</style>
<?php
    // } else {
    //     header('Location: Login.html');
    // }
?>