<?php
namespace Controllers\Sec;
use Controllers\PublicController;
use \Utilities\Validators;
use Exception as Ex;
use \Utilities\Site;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception as ExMailer;
class EmailTry extends PublicController
{
    private $_viewData = array();
    private $txtFrom = "";
    private $txtAddress = "";
    private $txtPasswordKey = "";
    private $txtHost = "smtp.gmail.com";
    private $txtSubject = "Correo de Prueba con clase";
    private $txtMessage = "";
    private $errorEmail = "";
    private $hasErrors = false;
    public function run(): void
    {
        if(isset($_POST["txtEmail"])){
            $this->txtAddress = $_POST["txtEmail"];
        } 
        $this->SendEmail();
    }
    public function SendEmail()
    {
        try{
        //Crear una instancia y pasar true para permitir las excepciones
        $mail = new PHPMailer(true);
        $codigo = rand(1000, 9999);
        //Configuración del servidor
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;             //Habilitar los mensajes de depuración para verlos en pantalla.
        $mail->isSMTP();                                   //Enviar usando SMTP
        $mail->Host       = $this->txtHost;            //Configurar el servidor SMTP
        $mail->SMTPAuth   = true;                          //Habilitar autenticación SMTP
        $mail->Username   = $this->txtFrom;            //Nombre de usuario SMTP
        $mail->Password   = $this->txtPasswordKey;                      //Contraseña SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;   //Habilitar el cifrado TLS
        $mail->Port       = 465;    //Puerto TCP al que conectarse; use 587 si configuró `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->CharSet    = PHPMailer::CHARSET_UTF8;

        //Emisor del correo
        $mail->setFrom($this->txtFrom, 'Carlos');

        //Destinatarios
        $mail->addAddress($this->txtAddress, 'Equipo de Trabajo');

        //Nombre opcional
        $mail->isHTML(true);         //Establecer el formato de correo electrónico en HTMl
        $mail->Subject = $this->txtSubject;
        $mail->Body    = $this->txtMessage . '<br> Tu codigo de restablecimiento es el siguiente:<br>' . $codigo;
        $mail->AltBody = 'Este es el cuerpo en texto sin formato para clientes de correo que no son HTML';
        $mail->send();    //Enviar correo eletrónico
        Site::redirectToWithMsg('index.php?page=sec_pin','Correo Electrónico enviado con éxito.');
        } catch(ExMailer $e){
            echo "No se pudo enviar el mensaje. Error de correo: {$mail->ErrorInfo}";
        }
    }
}
?>



