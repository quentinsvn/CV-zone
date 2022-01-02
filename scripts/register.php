<?php
    if(isset($_POST['inscription'])) {

        $prenom = htmlspecialchars($_POST['prenom']);
        $nom = htmlspecialchars($_POST['nom']);
        $email = htmlspecialchars($_POST['email']);
        $mdp = sha1($_POST['password']);
        $confirm_mdp = sha1($_POST['confirm_password']);

        if(!empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['email']) AND !empty($_POST['password']) AND !empty($_POST['confirm_password'])) {
            if($mdp == $confirm_mdp) {
                if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $reqidmail = $bdd->prepare("SELECT * FROM users WHERE email = ?");
                    $reqidmail->execute(array($email));
                    $mailidexist = $reqidmail->rowCount();
                    if($mailidexist == 0) {
                        $insertmbr = $bdd->prepare("INSERT INTO users(date_inscription,prenom,nom,email,mdp) VALUES (now(),?,?,?,?)");
                        $insertmbr->execute(array($prenom, $nom, $email, $mdp));
                        $message = "<div class='successMsg'>Votre compte a bien été créer !</div>";
                    } else {
                        $message = "<div class='errorMsg'>Adresse email déjà utilisée !</div>";
                    }
                } else {
                    $message = "<div class='errorMsg'>Votre adresse email n'est pas valide !</div>";
                }
            } else {
                $message = "<div class='errorMsg'>Les mots de passes ne correspondent pas!</div>";
            }
        } else {
            $message = "<div class='errorMsg'>Tous les champs doivent être complétés !</div>";
        }
    }
?>