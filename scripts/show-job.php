<?php 
$cv = null;
if(isset($_GET['id']) AND !empty($_GET['id'])) {
    $get_id = htmlspecialchars($_GET['id']);

    $job = $bdd->prepare("SELECT * FROM job WHERE id = ?");
    $job->execute(array($get_id));

    if($job->rowCount() == 1) {
        $job = $job->fetch();
        $nom = $job['nom'];
        $emplacement = $job['emplacement'];
        $site = $job['site'];
        $categorie = $job['categorie'];
        $contrat = $cv['contrat'];
        $description = $cv['description'];

        $phpdate = strtotime( $job['date'] );
        $mysqldate = date( 'd/m/Y', $phpdate );
    } else {
        header('Location: index.php');
    }

} else {
    header('Location: index.php');
}

?>