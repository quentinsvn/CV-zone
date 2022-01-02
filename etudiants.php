<?php
session_start();
include('scripts/config.php');
$cv = $bdd->query('SELECT * FROM cv ORDER BY id DESC');
if(isset($_SESSION['id'])) {
    $requser = $bdd->prepare("SELECT * FROM users WHERE id = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();
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
                        <li class="item-li"><a id="active" href="etudiants.php">Étudiants</a></li>
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
                        <h1>Derniers CV publiés</h1>
                    </div>
                    <div class="head_publish">
                        <a class="btn-login" style="color: white; text-decoration: none;" href="publish-cv.php">Publier un CV</a>
                    </div>
                </div>

                <div class="jobs-content">
                    <div class="job-list">
                        <!-- Etudiant -->
                        <?php while($c = $cv->fetch()) { 
                                $phpdate = strtotime( $c['date'] );
                                $mysqldate = date( 'd/m/Y', $phpdate );
                        ?>
                        <div class="job-card">
                            <div class="flex-start">
                                <div class="logo-company">
                                    <img src="assets/img/etudiant.jpg" alt="">
                                </div>
                                <div class="details-job">
                                    <h4 style="margin-bottom: 0; color:brown;">Publié le <?php echo  $mysqldate ?></h4>
                                    <h1 style="margin-top: 0;"><?php echo $c['prenom'] ?> <?php echo $c['nom'] ?></h1>
                                    <ul class="job-labels">
                                        <li><?php echo $c['contrat'] ?></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="job-apply">
                                <a class="btn-login" style="color: white; text-decoration: none;" href="cv.php?id=<?php echo $c['id']; ?>">Consulter</a>
                            </div>
                        </div>
                        <?php } ?>

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