<?php

namespace Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Repository\ConfigurationRepository;
use Symfony\Component\Dotenv\Dotenv;


class Mail
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
            $mail->SMTPAuth   = true;
            $mail->Host       = $_ENV['MAILER_URL'];
            $mail->Username   = $_ENV['MAILER_LOGIN'];
            $mail->Password   = $_ENV['MAILER_PASSWORD'];
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->Port       = $_ENV['MAILER_PORT'];

            //Recipients
            $mail->setFrom($_ENV['MAILER_FROM'], $configuration->getFullname());
            $mail->addAddress($user->getEmail(), $user->getPseudo());     //Add a recipient//Name is optional

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