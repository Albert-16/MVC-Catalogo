<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Ejemplo con el cargador automático de composer
//require 'vendor\autoload.php';s
//Crear una instancia y pasar true para permitir las excepciones
$mail = new PHPMailer(true);

try {
  $codigo = rand(1000, 9999);
  //Configuración del servidor
  $mail->SMTPDebug = SMTP::DEBUG_SERVER;             //Habilitar los mensajes de depuración para verlos en pantalla.
  $mail->isSMTP();                                   //Enviar usando SMTP
  $mail->Host       = 'smtp.gmail.com';            //Configurar el servidor SMTP
  $mail->SMTPAuth   = true;                          //Habilitar autenticación SMTP
  $mail->Username   = 'carlosardon001@gmail.com';            //Nombre de usuario SMTP
  $mail->Password   = '';                      //Contraseña SMTP
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;   //Habilitar el cifrado TLS
  $mail->Port       = 465;    //Puerto TCP al que conectarse; use 587 si configuró `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
  $mail->CharSet    = PHPMailer::CHARSET_UTF8;

  //Emisor del correo
  $mail->setFrom('carlosardon001@gmail.com', 'Carlos');

  //Destinatarios
  $mail->addAddress($Email, 'Carlos Alberto');     //Añadir un destinatario, el nombre es opcional

/*
    //Archivos adjuntos
    $mail->addAttachment('files/comunicado.pdf', 'Comunicado');         //Agregar archivos adjuntos, nombre opcional
*/

  //Nombre opcional
  $mail->isHTML(true);                         //Establecer el formato de correo electrónico en HTMl
  $mail->Subject = 'Probar envío de correo';
  $mail->Body    = '¡IZI PIZI logré enviar correo <br> Tu codigo de restablecimiento es el siguiente:<br>' . $codigo;
  $mail->AltBody = 'Este es el cuerpo en texto sin formato para clientes de correo que no son HTML';

  $mail->send();    //Enviar correo eletrónico
  echo 'El mensaje ha sido enviado con éxito.';
} catch (Exception $e) {
  echo "No se pudo enviar el mensaje. Error de correo: {$mail->ErrorInfo}";
}

?>
