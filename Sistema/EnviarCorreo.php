<?php

// composer require phpmailer/phpmailer


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output  //2 muestra logs  //0 no muestra
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'world.consultory.services@gmail.com';                     //SMTP username
    $mail->Password   = 'wsyhniwframfjolg';                               //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`



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

    // $mail->addAddress('laxterdos@gmail.com', 'Daniel');     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Proyecto Final de Inteligencia de Negocios';
    $mail->Body    = 'Este es un mensaje prueba de envio de reporte';
    $mail->AltBody = 'AltBody';

    $mail->send();
    echo 'Mensaje ENviado';
} catch (Exception $e) {
    echo "Error de envio. Error: {$mail->ErrorInfo}";
}
