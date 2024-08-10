<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

// Instancia de PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'ces4rglez17@gmail.com';
    $mail->Password   = 'desdecero123'; // Aquí debe ir tu contraseña de Gmail
    $mail->SMTPSecure = 'ssl'; // Usar ssl o tls según tu configuración
    $mail->Port       = 465; // Puerto SSL: 465, Puerto TLS/STARTTLS: 587
    $mail->CharSet    = 'UTF-8';

    // Establecer idioma
    $mail->setLanguage("es");

    // Datos del formulario
    $emailUser = isset($_REQUEST['emailUser']) ? trim($_REQUEST['emailUser']) : '';

    // Contenido del correo
    $mail->setFrom('programadorphp2017@gmail.com', 'Parking');
    $mail->addAddress($emailUser); // Destinatario principal
    $mail->addReplyTo('info@alcvaletparking.com', 'Information');
    $mail->addCC('urian1213viera@gmail.com'); // Copia oculta

    // Configuración del contenido HTML
    $mail->isHTML(true);
    $mail->Subject = 'Bienvenida a Parking';
    
    // Cuerpo del correo
    $mail->Body = "<html><body>";
    $mail->Body .= "<p>En <strong style='color:#ff6d0c;'>Parking</strong> le damos la bienvenida y estamos encantados de tenerte como nuestro cliente.</p>";
    $mail->Body .= "<p>Tu cuenta se ha creado exitosamente.</p>";
    $mail->Body .= "<p>Para acceder a la plataforma, haz clic en el siguiente enlace:</p>";
    $mail->Body .= "<p><a href='https://parking.com/app/' style='background: #ff6d0c; font-size:15px; padding: 10px 20px; border-radius: 25px;text-decoration: none; color:#fff;'>Acceder Ahora</a></p>";
    $mail->Body .= "<p>Gracias por elegir <strong style='color:#ff6d0c;'>Parking</strong>.</p>";
    $mail->Body .= "<p>Si tienes alguna pregunta o necesitas asistencia, no dudes en contactarnos.</p>";
    $mail->Body .= "<p>¡Esperamos que tengas una experiencia increíble!</p>";
    $mail->Body .= "</body></html>";

    if (!$mail->send()) {
        header("Location: ../?successC=1");
    } else {
        header("Location: ../?successC=1");
        exit;
    }
} catch (Exception $e) {
    header("Location: ../?successC=1");
}
?>
