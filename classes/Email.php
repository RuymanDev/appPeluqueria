<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token) {
        
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion() {

        // Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
 
        $mail->setFrom('cuentas@appsalon.com'); // Aqui va el dominio donde tengamos el proyecto 
        $mail->addAddress('cliente@appsalon.com', 'AppSalon.com');
        $mail->Subject = 'Confirma tu cuenta';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p>Hola <strong>" . $this->nombre ."</strong> has creado tu cuenta en App Salon, solo debes confirmarla presionando en el siguiente enlace.</p>";
        $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['APP_URL'] .  "/confirmar-cuenta?token=" . $this->token ."'>Confirmar Cuenta</a></p>";
        $contenido .= '<p>Si no solicitaste esta cuenta, puedes ignorar el mensaje.</p>';
        $contenido .= '<html>';

        $mail->Body = $contenido;

        // Enviamos el Email
        $mail->send();
    }

    public function enviarInstrucciones() {
        // Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('cuentas@appsalon.com'); // Aqui va el dominio donde tengamos el proyecto 
        $mail->addAddress('cliente@appsalon.com', 'AppSalon.com');
        $mail->Subject = 'Restablece tu Contraseña';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p>Hola <strong>" . $this->nombre ."</strong>, has solicitado restablecer tu contraseña, sigue el siguiente enlace para hacerlo.</p>";
        $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['APP_URL'] .  "/recuperar?token=" . $this->token ."'>Restablecer Contraseña</a></p>";
        $contenido .= '<p>Si no solicitaste esta cuenta, puedes ignorar el mensaje.</p>';
        $contenido .= '<html>';

        $mail->Body = $contenido;

        // Enviamos el Email
        $mail->send();
    }
}