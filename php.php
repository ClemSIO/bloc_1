<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-6.9.1/src/Exception.php';
require '../PHPMailer-6.9.1/src/SMTP.php';
require '../PHPMailer-6.9.1/src/PHPMailer.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $objet = $_POST['objet'];
}
    // Instancier la classe PHPMailer
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'clementpapillon61@gmail.com';                     //SMTP username
        $mail->Password   = 'tcmp sfew vkxv zrbf';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
   
        // Destinataire et expéditeur
        $mail->setFrom($email, $objet);
        $mail->addAddress('clement.papillon@sts-sio-caen.info'); // Remplacez par l'adresse e-mail du destinataire

        // Contenu du message
        $mail->isHTML(true);
        $mail->Subject = $email;
        $mail->Body = $message;

        // Envoyer le message
        $mail->send();

        // Rediriger vers une page de succès
        echo "Mail envoyé !";
        exit();
    } catch (Exception $e) {
        // En cas d'erreur, rediriger vers une page d'erreur
        echo "Erreur d'envoi du mail. Rééssaye encore !";
        exit();
    }
?>