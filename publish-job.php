<?php
session_start();
include('scripts/config.php');
if(isset($_SESSION['id'])) {
    $requser = $bdd->prepare("SELECT * FROM users WHERE id = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();
    include('scripts/add-job.php');
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/css/style.css" />
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
                        <li class="item-li"><a href="etudiants.php">Étudiants</a></li>
                        <li class="item-li"><a  id="active" href="entreprises.php">Entreprises</a></li>
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
                        <h1><?php if($mode_edition == 1) { ?>Modifier <?php } else { ?>Publier <?php } ?> un job</h1>
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
                            <form action="" method="post" enctype="multipart/form-data">
                                <h3>Informations sur l'entreprise</h3>
                                <label for="icone">Icone de l'entreprise</label>
                                <input style="margin-bottom: 10px;" type="file" name="logo" id="">
                                <input <?php if($mode_edition == 1) { ?>value="<?php echo $edit_job['nom']; ?>"<?php } ?> required name="nom" type="text" placeholder="Nom"><br/>
                                <input <?php if($mode_edition == 1) { ?>value="<?php echo $edit_job['emplacement']; ?>"<?php } ?> required name="emplacement" type="text" placeholder="Emplacement"><br/>
                                <input <?php if($mode_edition == 1) { ?>value="<?php echo $edit_job['site']; ?>"<?php } ?> required name="site" type="text" placeholder="Site internet"><br/>
                                <h3>Informations sur l'offre</h3>
                                <input <?php if($mode_edition == 1) { ?>value="<?php echo $edit_job['titre']; ?>"<?php } ?> required name="titre" type="text" placeholder="Titre"><br/>
                                <select required name="categorie" id="">
                                    <?php if($mode_edition == 1) { ?><option value="<?php echo $edit_job['categorie']; ?>"><?php echo $edit_job['categorie']; ?></option><?php } ?>
                                    <option value="Développement">Développement</option>
                                    <option value="Design">Design</option>
                                </select><br/>
                                <select required name="contrat" id="">
                                    <?php if($mode_edition == 1) { ?><option value="<?php echo $edit_job['contrat']; ?>"><?php echo $edit_job['contrat']; ?></option><?php } ?>
                                    <option value="Stage">Stage</option>
                                    <option value="Alternance">Alternance</option>
                                </select><br/>
                                <select required name="remuneration" id="">
                                    <?php if($mode_edition == 1) { ?><option value="<?php echo $edit_job['remuneration']; ?>"><?php if($edit_job['remuneration'] == 1) { echo "Oui"; } else { echo "Non"; } ?></option><?php } ?>
                                    <option value="1">Oui</option>
                                    <option value="2">Non</option>
                                </select><br/>
                                <textarea required placeholder="Description" name="description" id="" cols="30" rows="10">
                                    <?php if($mode_edition == 1) { echo $edit_job['description']; } ?>
                                </textarea><br/>
                                <input type="submit" value=" <?php if($mode_edition == 1) { ?> Modifier <?php } else { ?> Valider <?php } ?>">
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