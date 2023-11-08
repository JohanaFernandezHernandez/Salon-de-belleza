<?php 

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{
    public $email;
    public $nombre;
    public $token;



    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion(){
        //crear el objeto de Email
        $mail =new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '849148c6c745d4';
        $mail->Password = 'e9d7accf207c98';

        $mail->setFrom('cuentas@appsalon.com'); //este es el correo de quien lo envia
        $mail->addAddress('cuentas@appsalon.com', 'Appsalon.com');
        $mail->Subject = 'Confirma tu cuenta';

        //set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UFT-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola" . $this->nombre . "</strong> Has creado tu cuenta en
        Appsalon, solo debes confirmarla presionando el siguiente enlace</P>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:8300/confirmar-cuenta?token=" 
        . $this->token . "'>Confirmar Cuenta</a> </p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";
        $mail->Body =$contenido;

        // Enviar el Email
        $mail->send();

    }
}


?>