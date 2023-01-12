<?php
// session_start();
// if (isset($_SESSION['Usuario'])) {

// EJEMPLO LINK: http://localhost/ETL/estadisticas.php?NombreArchivo=ArchivoX&Errores=10&Insertados=90&Total=100&TipoArchivo=SDS
$NombreArchivo = $_GET['NombreArchivo']; //Nombre del archivo
$TipoArchivo = $_GET['TipoArchivo']; //Tipo de archivo
$Errores = $_GET['Errores']; //Cantidad de errores encontrados
$Insertados = $_GET['Insertados']; //Cantidad de inserts correctos
$Total = $_GET['Total']; //Cantidad total de filas que estaban en el archivo



$PorcentajeInsertados = intval($Insertados / $Total * 100); //PorcentajeInsertados de datos insertados
$PorcentajeErrores = intval($Errores / $Total * 100); //PorcentajeInsertados de datos no insertados
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
        <div id="dato">
            <button id="filtro"> Aplicar Filtro</button>
        </div>


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