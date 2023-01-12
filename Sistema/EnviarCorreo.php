<?php
// composer require phpmailer/phpmailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function enviarArchivoCorreo($archivoPDF)
{
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0; //2 muestra logs  //0 no muestra
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'world.consultory.services@gmail.com';
        $mail->Password   = 'wsyhniwframfjolg';
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;



        $mail->setFrom('world.consultory.services@gmail.com', 'Inteligencia de negocios');

        $Con = mysqli_connect("127.0.0.1", "root", "", "login");
        $SQL = "SELECT * 
            FROM Usuarios
            WHERE Tipo = 'A';";

        $Result = mysqli_query($Con, $SQL);
        $Total = mysqli_num_rows($Result);
        for ($f = 0; $f < $Total; $f++) {
            $Fila = mysqli_fetch_row($Result);

            $mail->addAddress($Fila[2]);  //Envia correo a todos los Admin

        }

        $mail->addAttachment($archivoPDF);  //Agrega el archivoPDF al correo

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Proyecto Final de Inteligencia de Negocios';
        $mail->Body    = 'Este es un mensaje prueba de envio de reporte';
        $mail->AltBody = 'AltBody';

        $mail->send();
        // echo 'Correo Enviado';

        // Eliminar archivo para no mantenerlo localmente
        unlink($archivoPDF);
    } catch (Exception $e) {
        echo "Error de envio de correo. Error: {$mail->ErrorInfo}";
    }
}
