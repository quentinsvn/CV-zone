<?php
session_start();
include('scripts/config.php');
if(isset($_SESSION['id'])) {
    $requser = $bdd->prepare("SELECT * FROM users WHERE id = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();
    include('scripts/add-cv.php');
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/img/logo.ico" />
    <title>CV-zone</title>
</head>
<body>
    
    <header>
        <div class="topbar_white">
            <div class="flx">
                <div class="topbar_content">
                    <a href="/"><img src="assets/img/logo3.png" alt="" class="header-logo"></a>
                </div>
                <div class="menu-items">
                    <ul class="ul-menu">
                        <li class="item-li"><a href="index.php">Accueil</a></li>
                        <li class="item-li"><a  id="active" href="etudiants.php">Étudiants</a></li>
                        <li class="item-li"><a href="entreprises.php">Entreprises</a></li>
                        <li class="item-li"><a href="contacts.php">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="menu-account">
                <ul class="ul-account">
                    <?php if(isset($_SESSION['id'])) { ?>
                        <a href="account.php"><li class="btn-account">Mon compte</li></a>
                    <?php } else { ?>
                        <a href="login.php"><li class="btn-login">Se connecter</li></a>
                    <?php } ?>

                    <?php if(isset($_SESSION['id'])) { ?>
                        <a href="scripts/logout.php"><li class="btn-logout">Se déconnecter</li></a>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </header>

    <main>

        <section class="latest-jobs">
            <div class="container">
                <div class="head">
                    <div class="head_title">
                        <h1><?php if($mode_edition == 1) { ?>Modifier <?php } else { ?>Publier <?php } ?> un CV</h1>
                    </div>
                </div>
                
                <?php 
                    if(isset($message)) {
                        echo $message;
                    }
                ?>

                <div class="contact-content">

                    <div class="card-content">

                        <div class="contact-form">
                            <form action="" method="post">
                                <h3>Description du profil</h3>
                                <input value='<?php echo $user["prenom"]; ?>' type="hidden" name="prenom" placeholder="Prenom" id=""><br/>
                                <input value='<?php echo $user["nom"]; ?>' type="hidden" name="nom" placeholder="Nom" id=""><br/>
                                <input <?php if($mode_edition == 1) { ?>value="<?php echo $edit_cv['age']; ?>"<?php } ?> required type="number" name="age" placeholder="Age" id=""><br/>
                                <input <?php if($mode_edition == 1) { ?>value="<?php echo $edit_cv['ecole']; ?>"<?php } ?> required type="text" name="ecole" placeholder="Ecole" id=""><br/>
                                <input <?php if($mode_edition == 1) { ?>value="<?php echo $edit_cv['ville']; ?>"<?php } ?> required type="text" name="ville" placeholder="Ville" id=""><br/>
                                <input required value='<?php echo $user["email"]; ?>' type="email" name="email" placeholder="Email" id="">
                                <h3>Contenu</h3>
                                <select required name="contrat" id="">
                                    <?php if($mode_edition == 1) { ?><option value="<?php echo $edit_cv['contrat']; ?>"><?php echo $edit_cv['contrat']; ?></option><?php } ?>
                                    <option value="Stage">Stage</option>
                                    <option value="Alternance">Alternance</option>
                                </select><br/>
                                <textarea required placeholder="Décrire mon profil, mes diplomes, mes expériences professionnelles, loisirs..." name="description" style="height: 200px;" id="" cols="30" rows="10">
                                    <?php if($mode_edition == 1) { echo $edit_cv['description']; } ?>
                                </textarea><br/>
                                <h3 for="">Ajouter un fichier</h3>
                                <input type="file" name="fichier" id=""><br/>
                                <input name="add" type="submit" <?php if($mode_edition == 1) { ?>value="Modifier"<?php } else { ?>value="Valider"<?php } ?>>
                            </form>
                        </div>

                    </div>

                </div>

            </div>
        </section>

    </main>

    <footer>
        <div class="footer-content">
            <div class="menu_footer_1">
                <img src="assets/img/logo3.png" alt="">
            </div>
            <div class="menu_footer_2">
                <ul>
                    <li><a href="etudiants.php">Étudiants</a></li>
                    <li><a href="entreprises.php">Entreprises</a></li>
                    <li><a href="contacts.php">Contact</a></li>
                </ul>
            </div>
            <div class="menu_footer_3">
                <ul>
                    <li><a href="publish-job.php">Publier un job</a></li>
                    <li><a href="publish-cv.php">Publier un CV</a></li>
                    <li><a href="account.php">Mon compte</a></li>
                </ul>
            </div>
            <div class="menu_footer_4">
                <ul>
                    <li><a href="https://www.univ-rouen.fr/">Université de Rouen</a></li>
                    <li><a href="https://www.onisep.fr/">Onisep</a></li>
                </ul>
            </div>
        </div>
    </footer>
</body>
</html>
<?php
} else {
    header('Location: login.php');
}
?>