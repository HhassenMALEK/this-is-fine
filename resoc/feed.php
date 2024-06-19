<?php
include 'menu.php';
?>
<!doctype html>
<html lang="fr">
    <body>
        
        <div id="wrapper">
            <?php
            /**
             * Cette page est TRES similaire à wall.php. 
             * Vous avez sensiblement à y faire la meme chose.
             * Il y a un seul point qui change c'est la requete sql.
             */
            /**
             * Etape 1: Le mur concerne un utilisateur en particulier
             */
            ?>
            <?php
            /**
             * Etape 2: se connecter à la base de donnée
             */
            // $mysqli = new mysqli("localhost", "root", "root", "socialnetwork");
            ?>

            <aside>
                <?php
                /**
                 * Etape 3: récupérer le nom de l'utilisateur
                 */
                $folderName = "feedUsers"; 
                $laQuestionEnSql = request($folderName); 
                $lesInformations = connexion($laQuestionEnSql);
                $user = $lesInformations->fetch_assoc();
                //@todo: afficher le résultat de la ligne ci dessous, remplacer XXX par l'alias et effacer la ligne ci-dessous
                //echo "<pre>" . print_r($user, 1) . "</pre>";
                ?>
                <img src="user.jpg" alt="Portrait de l'utilisatrice"/>
                <section>
                    <h3>Présentation</h3>
                    <p>Sur cette page vous trouverez tous les message des utilisatrices
                        auxquel est abonnée l'utilisatrice <?php echo $user['alias']?>
                        (n° <?php echo $userId ?>)
                    </p>

                </section>
            </aside>
            <main>
                <?php
                /**
                 * Etape 3: récupérer tous les messages des abonnements
                 */
                $folderName = "feedPosts"; 
                 $laQuestionEnSql = request($folderName); 
                $lesInformations = connexion($laQuestionEnSql);
                // if ( ! $lesInformations)
                // {
                //     echo("Échec de la requete : " . $mysqli->error);
                // }

                /**
                 * Etape 4: @todo Parcourir les messsages et remplir correctement le HTML avec les bonnes valeurs php
                 * A vous de retrouver comment faire la boucle while de parcours...
                 */
                while ($post = $lesInformations->fetch_assoc())
                {
                    $tags = explode(',', $post['taglist']);
                   // echo "<pre>" . print_r($post, 1) . "</pre>";
                    ?>                
                    <article>
                        <h3>
                            <time ><?php echo $post['created'] ?></time>
                        </h3>
                        <address><?php echo $post['author_name']?></address>
                        <div>
                            <p><?php echo $post['content']?></p>
                        </div>                                            
                        <footer>
                            <small>♥ <?php echo $post['like_number']?></small>
                           
                            <?php 
                            displayTags($tags);
                            ?>
                        </footer>
                    </article>
                <?php } ?>
            </main>
        </div>
    </body>
</html>
