<?php 
$cv = null;
if(isset($_GET['id']) AND !empty($_GET['id'])) {
    $get_id = htmlspecialchars($_GET['id']);

    $cv = $bdd->prepare("SELECT * FROM cv WHERE id = ?");
    $cv->execute(array($get_id));

    if($cv->rowCount() == 1) {
        $cv = $cv->fetch();
        $prenom = $cv['prenom'];
        $nom = $cv['nom'];
        $age = $cv['age'];
        $ecole = $cv['ecole'];
        $ville = $cv['ville'];
        $date = $cv['date'];
        $contrat = $cv['contrat'];
        $description = $cv['description'];
        $email = $cv['email'];

        $phpdate = strtotime( $cv['date'] );
        $mysqldate = date( 'd/m/Y', $phpdate );
    } else {
        header('Location: index.php');
    }

} else {
    header('Location: index.php');
}

?>