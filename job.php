<?php
    session_start();
    include('scripts/config.php');
    include('scripts/show-job.php');
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
    <script src="https://kit.fontawesome.com/7a293f3dad.js" crossorigin="anonymous"></script>
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
                        <li class="item-li"><a id="active" href="entreprises.php">Entreprises</a></li>
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
                <div class="job-details">
                    <div class="job-card-details">
                        <div class="job-card-details-item">
                            <div class="flex-start">
                                <div class="logo-entreprise-job">
                                    <img src="assets/img/google.png" alt="">
                                </div>
                                <div class="job-title">
                                    <h3><?php echo $job['nom']; ?></h3>
                                    <h1><?php echo $job['titre']; ?></h1>
                                    <span><?php echo $job['categorie']; ?></span>
                                </div>
                            </div>
                            <div class="job-apply-section">
                                <p>Le <?php echo $mysqldate; ?></p>
                                <a class="btn-login" style="color: white; text-decoration: none;" href="">Postuler</a>
                            </div>
                        </div>
                        <div class="contrat-details">
                            <ul>
                                <li><span><i class="fas fa-file-contract"></i> <?php echo $job['contrat']; ?></span></li>
                                <li><span>|</span></li>
                                <li><span><i class="fas fa-map-marker-alt"></i> <?php echo $job['emplacement']; ?></span></li>
                                <li><span>|</span></li>
                                <li><span><i class="fas fa-money-bill-wave"></i> <?php if($job['remuneration'] == 1) { echo "Rémunéré "; } else { echo "Non-rémunéré"; }; ?></span></li>
                            </ul>
                        </div>
                        <div class="job-description">
                            <h1>Description</h1>
                            <p><?php echo $job['description']; ?></p>
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