<?php
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Host = 'ADRESSE SMTP DE TA BOITE MAIL';
$mail->Port = 2525;
$mail->SMTPAuth = true;
$mail->Username = 'IDENTIFIANT DE TA BOITE MAIL';
$mail->Password = 'MOT DE PASSE DE TA BOITE MAIL';
if(isset($_POST['nom'], $_POST['email'], $_POST['sujet'], $_POST['message'])) {
    if(!empty($_POST['nom']) AND !empty($_POST['email']) AND !empty($_POST['sujet']) AND !empty($_POST['message'])) {
        // Adresse e-mail et nom de l'expéditeur
        $mail->setFrom($_POST['email'], $_POST['nom']);
        $mail->addReplyTo($_POST['email'], $_POST['nom']);
        // Adresse e-mail et nom du destinataire
        $mail->addAddress('TON ADRESSE MAIL', 'TON NOM');
        // Contenu du mail
        $mail->Subject = 'Contact CV-Zone - '. $_POST['sujet'];
        // Envoi du message au format html si souhaité
        //$mail->msgHTML(file_get_contents('message.html'), __DIR__);
        $mail->Body = $_POST['message'];
        // pièce jointe si souhaité
        //$mail->addAttachment('test.txt');
        if (!$mail->send()) {
            echo 'Erreur de Mailer : ' . $mail->ErrorInfo;
        } else {
            $message = '<div class="successMsg">Message envoyé avec succès !</div>';
        }
    } else  {
        $message = '<div class="errorMsg">Veuillez remplir tous les champs</div>';
    }
}
?>