<?php
$mode_edition = 0;
if(isset($_GET['edit']) AND !empty($_GET['edit'])) {
   $mode_edition = 1;
   $edit_id = htmlspecialchars($_GET['edit']);
   $edit_job = $bdd->prepare('SELECT * FROM job WHERE id = ?');
   $edit_job->execute(array($edit_id));
   if($edit_job->rowCount() == 1) {
      $edit_job = $edit_job->fetch();
   } else {
      die('Erreur : le job n\'existe pas ou plus...');
   }
}
if(isset($_POST['nom'], $_POST['emplacement'], $_POST['site'], $_POST['titre'], $_POST['categorie'], $_POST['contrat'], $_POST['remuneration'], $_POST['description'])) {
   if(!empty($_POST['nom']) AND !empty($_POST['emplacement']) AND !empty($_POST['site']) AND !empty($_POST['titre']) AND !empty($_POST['categorie']) AND !empty($_POST['contrat']) AND !empty($_POST['remuneration']) AND !empty($_POST['description'])) {

      $nom = htmlspecialchars($_POST['nom']);
      $emplacement = htmlspecialchars($_POST['emplacement']);
      $site = htmlspecialchars($_POST['site']);
      $titre = htmlspecialchars($_POST['titre']);
      $categorie = htmlspecialchars($_POST['categorie']);
      $contrat = htmlspecialchars($_POST['contrat']);
      $remuneration = htmlspecialchars($_POST['remuneration']);
      $description = $_POST['description'];
      $utilisateur = $_SESSION['id'];

      if($mode_edition == 0) {
         $ins = $bdd->prepare('INSERT INTO job (date, utilisateur, nom, emplacement, site, titre, categorie, contrat, remuneration, description) VALUES (NOW(),?,?,?,?,?,?,?,?,?)');
         $ins->execute(array($utilisateur, $nom, $emplacement, $site, $titre, $categorie, $contrat, $remuneration, $description));
         /*
         $lastid = $bdd->lastInsertId();
         if(isset($_FILES['logo']) AND !empty($_FILES['logo']['name'])) {
            if(exif_imagetype($_FILES['logo']['tmp_name']) == 2) {
               $chemin = '../assets/img/logos/'.$lastid.'.jpg';
               move_uploaded_file($_FILES['logo']['tmp_name'], $chemin);
            } else {
               $message = '<div class="errorMsg">Votre image doit être au format jpg</div>';
            }
         }
         */
         $message = '<div class="successMsg">Votre job a bien été posté !</div>';
      } else {
         $update = $bdd->prepare('UPDATE job SET date_edition = NOW(), nom = ?, emplacement = ?, site = ?, titre = ?, categorie = ?, contrat = ?, remuneration = ?, description = ? WHERE id = ?');
         $update->execute(array($nom, $emplacement, $site, $titre, $categorie, $contrat, $remuneration, $description, $edit_id));
         header('Location: job.php?id='.$edit_id);
         $message = '<div class="successMsg">Votre job a bien été mis à jour !</div>';
      }
   } else {
      $message = '<div class="errorMsg">Veuillez remplir tous les champs</div>';
   }
}
?>