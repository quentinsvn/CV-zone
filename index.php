<?php
session_start();
include('scripts/config.php');
$job = $bdd->query('SELECT * FROM job ORDER BY id DESC'); 
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
                        <li class="item-li"><a id="active" href="index.php">Accueil</a></li>
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

        <section class="cover">
            
            <div class="cover-content">
                <h1>CV-zone, votre job au bout de doigts !</h1>
                <p>Description brève de ton site</p>
                <div class="search-container">
                    <form action="/search" class="search-container w-form">
                        <input type="search" class="search-input w-input" maxlength="256" name="query" placeholder="Rechercher un job..." id="search" required=""><br/>
                        <input type="submit" value="Rechercher" class="button-primary search w-button">
                    </form>
                </div>
            </div>

        </section>

        <section class="latest-jobs">
            <div class="container">
                <div class="head">
                    <div class="head_title">
                        <h1>Derniers jobs</h1>
                    </div>
                    <div class="head_publish">
                        <a class="btn-login" style="color: white; text-decoration: none;" href="publish-job.php">Publier un job</a>
                    </div>
                </div>

                <div class="jobs-content">
                    <div class="job-list">
                        <!-- Job -->
                        <?php while($j = $job->fetch()) { 
                                $phpdate = strtotime( $j['date'] );
                                $mysqldate = date( 'd/m/Y', $phpdate );
                        ?>
                        <div class="job-card">
                            <div class="flex-start">
                                <div class="logo-company">
                                    <img src="assets/img/travail.png" alt="">
                                </div>
                                <div class="details-job">
                                    <h4><?php echo $j['nom']; ?></h4>
                                    <h1><?php echo $j['titre']; ?></h1>
                                    <ul class="job-labels">
                                        <li><?php echo $j['categorie']; ?></li>
                                        <li><?php echo $j['contrat']; ?></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="job-apply">
                                <a class="btn-login" style="color: white; text-decoration: none;" href="job.php?id=<?php echo $j['id']; ?>">Postuler</a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="job-filter">
                        <div class="job-search">
                            <h3>Rechercher</h3>
                            <input type="search" class="form-search" placeholder="Rechercher...">
                        </div>
                        <div class="job-categories">
                            <div class="card-categories">
                                <h2>Categories</h2>
                                <div class="menu-categories">
                                    <ul>
                                        <a href=""><li>Business</li></a>
                                        <li><a href="">Design</a></li>
                                        <li><a href="">Développement</a></li>
                                        <li><a href="">Marketing</a></li>
                                        <li><a href="">Support</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="job-companies">
                            <div class="card-categories">
                                <h2>Entreprises</h2>
                                <div class="card-entreprise-item">
                                    <div class="logo-entreprise">
                                        <img src="https://www.facebook.com/images/fb_icon_325x325.png" alt="">
                                    </div>
                                    <div class="infos-entreprise">
                                        <h3>Facebook</h3>
                                        <p>Réseaux sociaux</p>
                                    </div>
                                </div>

                                <div class="card-entreprise-item">
                                    <div class="logo-entreprise">
                                        <img src="https://www.facebook.com/images/fb_icon_325x325.png" alt="">
                                    </div>
                                    <div class="infos-entreprise">
                                        <h3>Facebook</h3>
                                        <p>Réseaux sociaux</p>
                                    </div>
                                </div>

                                <div class="card-entreprise-item">
                                    <div class="logo-entreprise">
                                        <img src="https://www.facebook.com/images/fb_icon_325x325.png" alt="">
                                    </div>
                                    <div class="infos-entreprise">
                                        <h3>Facebook</h3>
                                        <p>Réseaux sociaux</p>
                                    </div>
                                </div>
                            </div>
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