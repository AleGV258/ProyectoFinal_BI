<?php

    // PROYECTO FINAL
    // MATERIA: Inteligencia de Negocios 
    // INTEGRANTES: 
    //     - García Vargas Michell Alejandro - 259663
    //     - Jiménez Elizalde Andrés - 259678
    //     - León Paulin Daniel - 260541

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'vendor/autoload.php';

    function enviarArchivoCorreo($archivoPDF)
    {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 0; // 2 muestra logs // 0 no muestra
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = '***';
            $mail->Password = '***';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('world.consultory.services@gmail.com', 'Inteligencia de Negocios - Reporte de Sistema');

            $Con = mysqli_connect("127.0.0.1", "root", "", "login");
            $SQL = "SELECT * 
                FROM Usuarios
                WHERE Tipo = 'A';";

            $Result = mysqli_query($Con, $SQL);
            $Total = mysqli_num_rows($Result);
            for ($f = 0; $f < $Total; $f++) {
                $Fila = mysqli_fetch_row($Result);
                $mail->addAddress($Fila[2]); // Envia correo a todos los Administradores
            }
            $mail->addAttachment(utf8_decode($archivoPDF)); // Agrega el archivoPDF al correo

            // Content
            date_default_timezone_set('America/Mexico_City'); 
            $DateAndTime = date('d-m-Y h:i:s a', time());  
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = "Proyecto Final - Inteligencia de Negocios";
            $mail->Body    = "<h2>Reporte del Sistema del {$DateAndTime}</h2><h4><strong>Integrantes:</strong><br>- García Vargas Michell Alejandro - 259663<br>- Jiménez Elizalde Andrés - 259678<br>- León Paulin Daniel - 260541</h4>";
            $mail->AltBody = 'AltBody';

            $mail->send();
            // Eliminar archivo para no mantenerlo localmente
            unlink($archivoPDF);
        } catch (Exception $err) {
            echo "{$err} - Error de envio de correo. Error: {$mail->ErrorInfo}";
        }
    }

?>
