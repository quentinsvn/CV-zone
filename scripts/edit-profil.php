<?php
    if(isset($_POST['prenom']) AND !empty($_POST['prenom']) AND $_POST['prenom'] != $user['prenom']) {
        $prenom = htmlspecialchars($_POST['prenom']);
        $insertprenom = $bdd->prepare("UPDATE users SET prenom = ? WHERE id = ?");
        $insertprenom->execute(array($prenom, $_SESSION['id']));
        header('Location: infos.php');
     }

    if(isset($_POST['nom']) AND !empty($_POST['nom']) AND $_POST['nom'] != $user['nom']) {
        $nom = htmlspecialchars($_POST['nom']);
        $insertnom = $bdd->prepare("UPDATE users SET nom = ? WHERE id = ?");
        $insertnom->execute(array($nom, $_SESSION['id']));
        header('Location: infos.php');
     }

     if(isset($_POST['email']) AND !empty($_POST['email']) AND $_POST['email'] != $user['email']) {
        $mail = htmlspecialchars($_POST['email']);
        $insertmail = $bdd->prepare("UPDATE users SET email = ? WHERE id = ?");
        $insertmail->execute(array($mail, $_SESSION['id']));
        header('Location: infos.php');
     }

     if(isset($_POST['mdp']) AND !empty($_POST['mdp']) AND $_POST['mdp'] != $user['mdp']) {
        $mdp = sha1($_POST['mdp']);
        $insertmdp = $bdd->prepare("UPDATE users SET mdp = ? WHERE id = ?");
        $insertmdp->execute(array($mdp, $_SESSION['id']));
        header('Location: infos.php');
     }
?>