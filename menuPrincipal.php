<?php
session_start();
if (isset($_SESSION['Usuario'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        PAGINA PRINCIPAL
        <BR>OPCIONES
        <br>
        <br>
        <a class="nav-link" href="cierraSesion.php">Cerrar Sesión</a>
    </body>

    </html>
<?php
} else {
    header('Location: Login.html');
}
?>