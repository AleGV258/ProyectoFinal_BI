<?php
//Recibir las variables del formulario
$FUsuario = $_POST['Usuario'];
$FCorreo = $_POST['Correo'];
$FPassword = $_POST['Password'];

session_start();


$Servidor = "127.0.0.1";
$Usuario = "root";
$Password = "";
$BD = "cucage";
$Con = mysqli_connect($Servidor, $Usuario, $Password, $BD);

$SQL = "INSERT INTO Usuarios 
        (NombreUsuario, Correo, Password) 
        VALUES ('$FUsuario', '$FCorreo', '$FPassword');";

echo $SQL;

$Result = mysqli_query($Con, $SQL);

if ($Result == 1) {
    print("Usuario registrado");
    $_SESSION["Usuario"] = $FCorreo; //sesion
    echo ("
    <script>
        alert('Usuario Registrado Correctamente'); 
        window.location.href = 'menuPrincipal.php'; 
    </script>
    ");
} else {
    echo ("
    <script>
        alert('Error en registro'); 
        window.location.href = 'register.html'; 
    </script>
    ");
}

mysqli_close($Con);
