<?php

namespace Core;

use PHPMailer\PHPMailer\PHPMailer;
use Repository\ConfigurationRepository;
use Symfony\Component\Dotenv\Dotenv;

class mail
{
    public function __construct()
    {

    }

    public function send($user, $subject, $message)
    {
        $mail = new PHPMailer(true);

        try {
            $dotenv = new Dotenv();
            $dotenv->load(__DIR__.'../../../.env');
            $configurationRepository = new ConfigurationRepository();
            $configuration = $configurationRepository->findById(1);
            $host = $_ENV['DB_HOST'];
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host       = $_ENV['MAILER_URL'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $_ENV['MAILER_LOGIN'];
            $mail->Password   = $_ENV['MAILER_PASSWORD'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = $_ENV['MAILER_PORT'];

            //Recipients
            $mail->setFrom($_ENV['MAILER_FROM'], $configuration->getFullname());
            $mail->addAddress($user->getEmail(), $user->getPseudo());     //Add a recipient//Name is optional
            //Attachments
            $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

}