<?php
    if(isset($_POST['login'])) {
        $email = htmlspecialchars($_POST['email']);
        $mdp = sha1($_POST['mdp']);
        if(!empty($email) AND !empty($mdp)) {
            $requser = $bdd->prepare("SELECT * FROM users WHERE email = ? AND mdp = ?");
            $requser->execute(array($email,$mdp));
            $userexist = $requser->rowCount();
            if ($userexist == 1) {
                $userinfo = $requser->fetch();
                $_SESSION['id'] = $userinfo['id'];
                $_SESSION['email'] = $userinfo['email'];
                header("Location: ../index.php");
            }
            else {
                $message = "<div class='errorMsg'>Identifiants incorrects !</div>";
            }
        }
        else {
            $message = "<div class='errorMsg'>Tous les champs doivent être complétés !</div>";
        }
    }

?>