<?php
// Fonction pour générer un captcha simple
function generateCaptcha() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $captcha = '';
    $length = 5; // Longueur du captcha

    for ($i = 0; $i < $length; $i++) {
        $captcha .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $captcha;
}

// Initialiser le captcha
$captchaValue = generateCaptcha();

// Vérifier le formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $objet = $_POST["objet"];
    $message = $_POST["message"];
    $captchaUser = $_POST["captcha"];

    // Vérifier le captcha
    if ($captchaUser != $captchaValue) {
        $error = "Captcha incorrect. Veuillez réessayer.";
    } else {
        // En-têtes pour l'envoi de l'e-mail
        $to = "destinataire@example.com"; // Remplacez par votre adresse e-mail
        $subject = "Nouveau message de contact: " . $objet;
        $messageBody = "Nom de l'expéditeur: " . $nom . "\n";
        $messageBody .= "Adresse de courriel de l'expéditeur: " . $email . "\n";
        $messageBody .= "Objet du message: " . $objet . "\n";
        $messageBody .= "Contenu du message:\n" . $message;

        // Envoyer l'e-mail
        if (mail($to, $subject, $messageBody)) {
            $success = "Votre message a été envoyé avec succès.";
        } else {
            $error = "Une erreur s'est produite lors de l'envoi du message. Veuillez réessayer plus tard.";
        }
    }
}
?>

<?php
    if (isset($error)) {
        echo "<p style='color: red;'>Erreur: " . $error . "</p>";
    } elseif (isset($success)) {
        echo "<p style='color: green;'>" . $success . "</p>";
    }
    ?>