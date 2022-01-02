<?php
session_start();
include('scripts/config.php');
include('scripts/login.php');
if(isset($_SESSION['id'])) {
    header("Location: index.php");
}
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
                        <h1>Formulaire de connexion</h1>
                    </div>
                </div>
                <?php 
                    if(isset($message)) {
                        echo $message;
                    }
                ?>
                <div class="contact-content">

                    <div class="card-content">

                        <div class="contact-form"  style="padding: 30px;">
                            <form action="" method="post">
                                <input name="email" type="email" placeholder="Adresse e-mail"><br/>
                                <input name="mdp" type="password" placeholder="Mot de passe"><br/>
                                <p>Pas encore inscrit ? <a href="register.php">Créer un compte !</a></p>
                                <input type="submit" name="login" value="Se connecter">
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
                    <li><a href="">Menu 1</a></li>
                    <li><a href="">Menu 2</a></li>
                    <li><a href="">Menu 3</a></li>
                </ul>
            </div>
            <div class="menu_footer_3">
                <ul>
                    <li><a href="">Menu 1</a></li>
                    <li><a href="">Menu 2</a></li>
                    <li><a href="">Menu 3</a></li>
                </ul>
            </div>
            <div class="menu_footer_4">
                <ul>
                    <li><a href="">Menu 1</a></li>
                    <li><a href="">Menu 2</a></li>
                    <li><a href="">Menu 3</a></li>
                </ul>
            </div>
        </div>
    </footer>
</body>
</html>