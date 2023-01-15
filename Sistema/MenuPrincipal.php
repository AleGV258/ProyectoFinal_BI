<?php

    // PROYECTO FINAL
    // MATERIA: Inteligencia de Negocios 
    // INTEGRANTES: 
    //     - García Vargas Michell Alejandro - 259663
    //     - Jiménez Elizalde Andrés - 259678
    //     - León Paulin Daniel - 260541

    session_start();
    if (isset($_SESSION['Usuario'])) {
?>
    <html lang="es" charset="UTF-8">
        <head>
            <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Menú Principal</title>
        </head>
        <body>
            <div class="usuario">
                Bienvenido 
<?php
                echo("<a style='color: rgba(140, 122, 230, 0.7);'>".$_SESSION['Nombre']."</a>");
?>
                al sistema de Inteligencia de Negocios
            </div>
            <div class="cards">
                <div class="card">
                    <a class="opcion" href="../BI/Configuracion.html">Análisis</a>
                </div>
                <div class="card">
                    <a class="opcion" href="../ETL/CargarArchivo.html">Integración</a>
                </div>
                <div class="card">
                    <a class="opcion" href="./Autores.html">Autores</a>
                </div>
                <div class="card">
                    <a class="opcion" href="../Login/CierraSesion.php">Cerrar Sesión</a>
                </div>
            </div>
        </body>
        <footer></footer>
    </html>
    <style>
        body{
            background-color: #372869;
            font-family: Verdana, Geneva, sans-serif;
            margin: 0;
            padding: 0;
            overflow-y: hidden;
        }
        footer{
            width: 100%;
            height: 77vh;
            margin: -20% 0 0 0;
            background-image: url("./images/Footer.jpg");
        }
        .usuario{
            width: 100%;
            background: #000;
            color: #fff;
            font-size: x-large;
            font-weight: 600;
            text-align: center;
            padding: 2% 0;
        }
        .cards{
            display: grid;
        }
        .card{
            justify-content: center;
            align-items: center;
            text-align: center;
            margin: 3.5% 30% 0 30%;
            padding: 2% 0;
            white-space: nowrap;
        }
        .opcion{
            padding: 4% 30%;
            border: none;
            border-radius: 10px;
            color: #000;
            font-weight: 600;
            font-size: x-large;
            text-decoration: none;
            background-color: aliceblue;
        }
        .opcion:hover{
            color: white;
            background-color: rgba(140, 122, 230, 0.7);
            color: #000;
            border: white 0px solid;
            cursor: pointer;
        }
        .opcion:active{
            padding: 3.6% 28%;
            margin: 0.2 0 0 1%;
            background-color: rgba(140, 122, 230, 0.7);
            color: white;
            border: white 0px solid;
        }
        @media (min-width: 300px) and (max-width: 800px) {
            body { overflow-y: visible; }
            .card{
                justify-content: center;
                align-items: center;
                text-align: center;
                margin: 10% 10% 0 10%;
                padding: 2% 0;
                white-space: nowrap;
            }
        }
    </style>

<?php
    } else {
        header('Location: ../index.html');
    }

?>