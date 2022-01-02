<?php
$mode_edition = 0;
if(isset($_GET['edit']) AND !empty($_GET['edit'])) {
   $mode_edition = 1;
   $edit_id = htmlspecialchars($_GET['edit']);
   $edit_cv = $bdd->prepare('SELECT * FROM cv WHERE id = ?');
   $edit_cv->execute(array($edit_id));
   if($edit_cv->rowCount() == 1) {
      $edit_cv = $edit_cv->fetch();
   } else {
      die('Erreur : le CV n\'existe pas...');
   }
}
if(isset($_POST['prenom'], $_POST['nom'], $_POST['age'], $_POST['ecole'], $_POST['ville'], $_POST['email'], $_POST['contrat'], $_POST['description'])) {
   if(!empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['age']) AND !empty($_POST['ecole']) AND !empty($_POST['ville']) AND !empty($_POST['email']) AND !empty($_POST['contrat']) AND !empty($_POST['description'])) {
      $etudiant = $_SESSION['id'];
      $prenom = htmlspecialchars($_POST['prenom']);
      $nom = htmlspecialchars($_POST['nom']);
      $age = htmlspecialchars($_POST['age']);
      $ecole = htmlspecialchars($_POST['ecole']);
      $ville = htmlspecialchars($_POST['ville']);
      $email = htmlspecialchars($_POST['email']);
      $contrat = htmlspecialchars($_POST['contrat']);
      $description = $_POST['description'];
      if($mode_edition == 0) {
         $ins = $bdd->prepare('INSERT INTO cv (date, etudiant, prenom, nom, age, ecole, ville, email, contrat, description) VALUES (NOW(),?,?,?,?,?,?,?,?,?)');
         $ins->execute(array($etudiant, $prenom, $nom, $age, $ecole, $ville, $email, $contrat, $description));
         $message = '<div class="successMsg">Votre CV a bien été posté !</div>';
      } else {
         $update = $bdd->prepare('UPDATE cv SET date_edition = NOW(), age = ?, ecole = ?, ville = ?, email = ?, contrat = ?, description = ? WHERE id = ?');
         $update->execute(array($age, $ecole, $ville, $email, $contrat, $description, $edit_id));
         header('Location: cv.php?id='.$edit_id);
         $message = '<div class="successMsg">Votre CV a bien été mis à jour !</div>';
      }
   } else {
      $message = '<div class="errorMsg">Veuillez remplir tous les champs</div>';
   }
}
?>