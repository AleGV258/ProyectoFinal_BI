<?php

    // PROYECTO FINAL
    // MATERIA: Inteligencia de Negocios 
    // INTEGRANTES: 
    //     - García Vargas Michell Alejandro - 259663
    //     - Jiménez Elizalde Andrés - 259678
    //     - León Paulin Daniel - 260541

    // Recibir las variables del formulario
    $FCorreo = $_POST['Correo'];
    $FPassword = $_POST['Password'];
    session_start();

    $Con = mysqli_connect("127.0.0.1", "root", "", "login");

    $SQL = "SELECT * 
            FROM Usuarios
            WHERE Correo = '$FCorreo';";

    $Result = mysqli_query($Con, $SQL);

    $Existe = mysqli_num_rows($Result);

    if ($Existe == 1) { // Valida si el usuario existe
        $Fila = mysqli_fetch_row($Result);
        if ($FPassword == $Fila[3]) { // Valida la contraseña
            if ($Fila[5] == 0) { // Valida que el usuario no este bloqueado
                print("Acceso Correcto");
                // Actualizar intentos a 0
                $SQL2 = "UPDATE Usuarios
                            SET Intentos = 0
                            WHERE Correo = '$FCorreo';";

                $Result = mysqli_query($Con, $SQL2);
                $_SESSION["Usuario"] = $FCorreo; // Sesión
                $_SESSION["Nombre"] = $Fila[1]; // Usuario

                if ($Fila[4] == "A") { // Valida si el usuario es admin o no
                    header('Location: ../Sistema/MenuPrincipal.php');
                } else { // No es admin
                    header('Location: ../Sistema/MenuPrincipal.php');
                }
            } else {
?>
                <script>alert("Lo sentimos, el Usuario esta Bloqueado"); window.location.href = "../index.html";</script>
<?php
            }
        } else {
?>
            <script>alert("Contraseña Incorrecta"); window.location.href = "../index.html";</script>
<?php
            if ($Fila[6] < 3 and $Fila[5] == 0) { // Verificar que los intentos sean menor a 3
                $SQL2 = "UPDATE Usuarios 
                        SET Intentos = Intentos + 1
                        WHERE Correo = '$FCorreo';";
                $Result = mysqli_query($Con, $SQL2);
                if ($Fila[6] == 2) { // Cambiar a bloqueado e intentos a 0
                    $SQL2 = "UPDATE Usuarios 
                            SET bloqueado = 1,
                            Intentos = 0
                        WHERE Correo = '$FCorreo';";
                    $Result = mysqli_query($Con, $SQL2);
?>
                    <script>alert("El Usuario ha sido Bloqueado"); window.location.href = "../index.html";</script>
<?php
                }
            }
        }
    } else {
?>
        <script>alert("Usuario Incorrecto"); window.location.href = "../index.html";</script>
<?php
    }

    mysqli_close($Con);
    
?>
