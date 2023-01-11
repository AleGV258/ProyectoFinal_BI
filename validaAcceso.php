<?php
//Recibir las variables del formulario
$FCorreo = $_POST['Correo'];
$FPassword = $_POST['Password'];
session_start();


$Servidor = "127.0.0.1";
$Usuario = "root";
$Password = "";
$BD = "cucage";
$Con = mysqli_connect($Servidor, $Usuario, $Password, $BD);

$SQL = "SELECT * 
        FROM Usuarios
        WHERE Correo = '$FCorreo';";

$Result = mysqli_query($Con, $SQL);

$Existe = mysqli_num_rows($Result);

if ($Existe == 1) { //Valida si el usuario existe
    $Fila = mysqli_fetch_row($Result);
    if ($FPassword == $Fila[3]) { //valida la conraseña
        if ($Fila[5] == 0) { //valida que el usuario no este bloqueado
            print("Acceso Correcto");
            //Actualizar intentos a 0
            $SQL2 = "UPDATE Usuarios
                        SET Intentos = 0
                        WHERE Correo = '$FCorreo';";

            $Result = mysqli_query($Con, $SQL2);
            $_SESSION["Usuario"] = $FCorreo; //sesion

            if ($Fila[4] == "A") { //Valida si el usuario es admin o no
                header('Location: menuPrincipal.php');
            } else { //no es admin
                header('Location: menuPrincipal.php');
            }
        } else {
            print("Usuario Bloqueado");
        }
    } else {
        print("Contraseña Incorrecta");
        if ($Fila[6] < 3 and $Fila[5] == 0) { //verificar que los intentos sean menor a 3
            $SQL2 = "UPDATE Usuarios 
                    SET Intentos = Intentos + 1
                    WHERE Correo = '$FCorreo';";
            $Result = mysqli_query($Con, $SQL2);
            if ($Fila[6] == 2) { //cambiar a bloqueado e intentos a 0
                $SQL2 = "UPDATE Usuarios 
                        SET bloqueado = 1,
                        Intentos = 0
                    WHERE Correo = '$FCorreo';";
                $Result = mysqli_query($Con, $SQL2);
                print("Usuario bloqueado");
            }
        }
    }
} else {
    print("Usuario no existe");
}

mysqli_close($Con);
