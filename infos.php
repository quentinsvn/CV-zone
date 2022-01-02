<?php
session_start();
include('scripts/config.php');
if(isset($_SESSION['id'])) {
    $requser = $bdd->prepare("SELECT * FROM users WHERE id = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();
    include('scripts/edit-profil.php');
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
                        <li class="item-li"><a href="etudiants.php">Étudiants</a></li>
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
                        <h1>Mon compte</h1>
                    </div>
                </div>

                <div class="menu-account">
                    <div class="menu-account-elements">
                        <ul>
                            <a href="account.php"><li>Mon CV</li></a>
                            <a href="my-jobs.php"><li>Mes jobs</li></a>
                            <a href="infos.php"><li class="active-menu">Informations personnelles</li></a>                    
                        </ul>
                    </div>
                </div>

                <div class="contact-content">

                    <div class="card-content">

                        <div class="contact-form">
                            <form action="" method="post">
                                <h3>Informations personnelles</h3>
                                <input value="<?php echo $user['prenom']; ?>" name="prenom" type="text" placeholder="Prenom"><br/>
                                <input value="<?php echo $user['nom']; ?>" name="nom" type="text" placeholder="Nom"><br/>
                                <input value="<?php echo $user['email']; ?>" name="email" type="email" placeholder="Adresse e-mail"><br/>
                                <input name="mdp" type="password" placeholder="Mot de passe"><br/>
                                <input name="valider" type="submit" value="Modifier">
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
                    <li><a href="">Étudiants</a></li>
                    <li><a href="">Entreprises</a></li>
                    <li><a href="">Contact</a></li>
                </ul>
            </div>
            <div class="menu_footer_3">
                <ul>
                    <li><a href="">Publier un job</a></li>
                    <li><a href="">Publier un CV</a></li>
                    <li><a href="">Mon compte</a></li>
                </ul>
            </div>
            <div class="menu_footer_4">
                <ul>
                    <li><a href="">Université de Rouen</a></li>
                    <li><a href="">Onisep</a></li>
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