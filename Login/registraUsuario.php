<?php

    // PROYECTO FINAL
    // MATERIA: Inteligencia de Negocios 
    // INTEGRANTES: 
    //     - García Vargas Michell Alejandro - 259663
    //     - Jiménez Elizalde Andrés - 259678
    //     - León Paulin Daniel - 260541

    // Recibir las variables del formulario
    $FUsuario = $_POST['Usuario'];
    $FCorreo = $_POST['Correo'];
    $FPassword = $_POST['Password'];

    session_start();

    $Con = mysqli_connect("127.0.0.1", "root", "", "login");

    $SQL = "INSERT INTO Usuarios 
            (NombreUsuario, Correo, Password) 
            VALUES ('$FUsuario', '$FCorreo', '$FPassword');";

    echo $SQL;

    $Result = mysqli_query($Con, $SQL);

    if ($Result == 1) {
        print("Usuario registrado");
        $_SESSION["Usuario"] = $FCorreo; // Sesión
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
    
?>