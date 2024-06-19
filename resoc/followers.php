<?php
include 'menu.php';
?>
<!doctype html>
<html lang="fr">

    <body>
        <div id="wrapper">          
            <aside>
                <img src = "user.jpg" alt = "Portrait de l'utilisatrice"/>
                <section>
                    <h3>Présentation</h3>
                    <p>Sur cette page vous trouverez la liste des personnes qui
                        suivent les messages de l'utilisatrice
                        n° <?php echo intval($_GET['user_id']) ?></p>

                </section>
            </aside>
            <main class='contacts'>
                <?php
                // Etape 1: récupérer l'id de l'utilisateur
                // Etape 2: se connecter à la base de donnée

                // $mysqli = new mysqli("localhost", "root", "root", "socialnetwork");
                // Etape 3: récupérer le nom de l'utilisateur
                $folderName = "followersUsers";
                $laQuestionEnSql = request($folderName);
                $lesInformations = connexion($laQuestionEnSql);
                // Etape 4: à vous de jouer
                //@todo: faire la boucle while de parcours des abonnés et mettre les bonnes valeurs ci dessous 
                while($users = $lesInformations -> fetch_assoc()){
                    ?>
                    <article>
                        <img src="user.jpg" alt="blason"/>
                        <h3><?php echo $users['alias']?></h3>
                        <p><?php echo $users['id']?></p>                    
                    </article>
                    <?php }?>
            </main>
        </div>
    </body>
</html>
