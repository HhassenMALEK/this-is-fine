<?php include 'session.php'; 
  include 'connexionSQL.php';
  include 'tagslist.php';
  include 'requests.php';

$actualId = strval($_SESSION['connected_id']);

?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Actualités</title> 
        <meta name="author" content="Julien Falconnet">
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <header>
            <a href='admin.php'><img src="resoc.jpg" alt="Logo de notre réseau social"/></a>
            <nav id="menu">
                <a href="news.php">Actualités</a>
                <a href="wall.php?user_id=<?php echo $actualId?>">Mur</a>
                <a href="feed.php?user_id=<?php echo $actualId?>">Flux</a>
                <a href="tags.php">Mots-clés</a>
            </nav>
            <nav id="user">
                <a href="#">▾ Profil</a>
                <ul>
                    <li><a href="settings.php?user_id=<?php echo $actualId?>">Paramètres</a></li>
                    <li><a href="followers.php?user_id=<?php echo $actualId?>">Mes suiveurs</a></li>
                    <li><a href="subscriptions.php?user_id=<?php echo $actualId?>">Mes abonnements</a></li>
                    <li><a href="login.php">Se déconnecter</a></li>
                </ul>
            </nav>
        </header>
</body>
</html>