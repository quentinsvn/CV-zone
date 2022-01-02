<?php
try {
    $user = 'IDENTIFIANT DE LA BDD';
    $pass = 'MOT DE PASSE DE LA BDD';
    $bdd = new PDO('mysql:host=HOST DE LA BDD;dbname=NOM DE LA BDD', $user, $pass);
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>