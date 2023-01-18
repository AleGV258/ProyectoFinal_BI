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
            <label class="column2">Estadísiticas</label><br><br>
        </div>
        <!-- <div id="titulo">Estadísticas</div> -->
        <div class="estadistica">
            Nombre del archivo: <?php echo("<a class='textoPre'>".$NombreArchivo."</a>"); ?><br>
        </div>
        <div class="estadistica">
            Tipo de archivo: <?php echo("<a class='textoPre'>.".$TipoArchivo."</a>"); ?><br>
        </div>
        <div class="insertados">
            <div class="insertadosPorcentaje"><?php echo($Total); ?></div>
            <div class="insertadosTexto">Total de Datos Insertados Correctamente.</div>
        </div>
        <div class="insertados">
            <div class="insertadosPorcentaje insertadosCorrecto"><?php echo($PorcentajeInsertados); ?>%</div>
            <div class="insertadosTexto">
                Datos Insertados Correctamente:<br>
                <a class="textoPre">Se han Insertado <?php echo($Insertados); ?> Datos correctamente a la Base de Datos.</a>
            </div>
        </div>
        <div class="insertados">
            <div class="insertadosPorcentaje insertadosIncorrecto"><?php echo($PorcentajeErrores); ?>%</div>
            <div class="insertadosTexto">
                Datos Erroneos Insertados:<br>
                <a class="textoPre">Se han detectado <?php echo($Errores); ?> Datos que no se pudieron Insertar correctamente a la Base de Datos.</a>
            </div>
        </div><br><br>
        <?php include("../ETL/FFiltro.html"); ?>
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
        height: 74vh;
        background-image: url("./images/Footer.jpg");
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
        grid-template-columns: 5% 20%; 
        grid-row-gap: 5%;
        justify-content: center;
        align-self: center;
        
    }
    .textoPre{
        color: #9980FA;
    }
    .inputdata{
        font-size: x-large;
        font-weight: 600;
        padding: 8% 0;
        margin: 2% -30% 2% -40%;
        border-radius: 10px;
        outline: none;
        border: none;
        cursor: pointer;
    }
    .insertados{
        width: 60%;
        margin: 2% 20%;
        display: grid;
        grid-template-columns: 15% 75%;
        gap: 4%;
        padding: 1% 0;
        justify-content: center;
        align-items: center;
        text-align: center;
        border: solid 5px rgba(140, 122, 230, 0.7);
        border-radius: 10px;
        font-size: large;
    }
    .insertadosPorcentaje{
        font-weight: 600;
        color: #fff;
        padding: 35% 0;
        border: solid 5px #009432;
        border-radius: 100px;
    }
    .insertadosPorcentaje:hover{
        background-color: #44bd32;
        cursor: cell;
    }
    .insertadosTexto{
        font-size: x-large;
        color: #fff;
    }
    .insertadosCorrecto{
        border: solid 5px #0652DD;
    }
    .insertadosCorrecto:hover{
        background-color: #4b7bec;
    }
    .insertadosIncorrecto{
        border: solid 5px #EA2027;
    }
    .insertadosIncorrecto:hover{
        background-color: #e84118;
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
    input[type="checkbox"] {
        height: 30px;
        width: 30px;
        margin-right: 15px;
        accent-color: rgba(140, 122, 230, 1.0);
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