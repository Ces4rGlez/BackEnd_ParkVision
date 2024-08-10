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
    $mail->Username   = 'urian1213viera@gmail.com';
    $mail->Password   = '4825';
    $mail->SMTPSecure = 'tls'; // Usar tls para Gmail
    $mail->Port       = 587; // Puerto tls: 587

    // Establecer idioma
    $mail->setLanguage("es");

    // Datos del formulario
    $emailUser = isset($_REQUEST['emailUser']) ? trim($_REQUEST['emailUser']) : '';
    $IdReserva = isset($_REQUEST['IdReserva']) ? trim($_REQUEST['IdReserva']) : '';
    $email_info = "info@alcvaletparking.com";

    // Contenido del correo
    $mail->setFrom('programadorphp2017@gmail.com', 'Parking');
    $mail->addAddress($emailUser); // Destinatario principal
    $mail->addReplyTo($email_info, 'Information');
    $mail->addCC('urianwebdeveloper@gmail.com'); // Copia oculta

    // Configuración del contenido HTML
    $mail->isHTML(true);
    $mail->Subject = 'Detalles de tu reserva - Parking';

    // Cuerpo del correo
    $mail->Body = "<html><body>";
    $mail->Body .= "<p>En <strong style='color:#ff6d0c;'>Parking</strong> le damos la bienvenida y estamos encantados de tenerte como nuestro cliente.</p>";
    $mail->Body .= "<p>Para acceder a tu reserva y obtener más detalles, haz clic en el siguiente enlace:</p>";
    $mail->Body .= "<p><a href='https://parking.com/app/dashboard/DetallesReserva.php?idReserva=" . $IdReserva . "' style='background: #ff6d0c; font-size:15px; padding: 10px 20px; border-radius: 25px; text-decoration: none; color:#fff;'>Acceder a la Reserva</a></p>";
    $mail->Body .= "<p>Gracias por elegir <strong style='color:#ff6d0c;'>Parking</strong>.</p>";
    $mail->Body .= "<p>Si tienes alguna pregunta o necesitas asistencia, no dudes en contactarnos.</p>";
    $mail->Body .= "</body></html>";

    // Configuración del cuerpo alternativo (para clientes de correo que no soportan HTML)
    $mail->AltBody = "En Parking le damos la bienvenida y estamos encantados de tenerte como nuestro cliente.\n";
    $mail->AltBody .= "Para acceder a tu reserva y obtener más detalles, visita: https://parking.com/app/dashboard/DetallesReserva.php?idReserva=" . $IdReserva . "\n";
    $mail->AltBody .= "Gracias por elegir Parking.\n";
    $mail->AltBody .= "Si tienes alguna pregunta o necesitas asistencia, no dudes en contactarnos.";

    if (!$mail->send()) {
        header("Location: ../dashboard/?successR=1");
    } else {
        header("Location: ../dashboard/?successR=1");
        exit;
    }
} catch (Exception $e) {
    header("Location: ../dashboard/?successR=1");
}
?>
