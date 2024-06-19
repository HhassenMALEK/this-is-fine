<?php
include 'menu.php';
?>
<!doctype html>
<html lang="fr">
    <body>

        <?php
        /**
         * Etape 1: Ouvrir une connexion avec la base de donnée.
         */
        // on va en avoir besoin pour la suite

        ?>
        <div id="wrapper" class='admin'>
            <aside>
                <h2>Mots-clés</h2>
                <?php
                /*
                 * Etape 2 : trouver tous les mots clés
                 */
                $folderName = "adminTags"; 
                $laQuestionEnSql = request($folderName); 
                $lesInformations = connexion($laQuestionEnSql);
                /*
                 * Etape 3 : @todo : Afficher les mots clés en s'inspirant de ce qui a été fait dans news.php
                 * Attention à ne pas oublier de modifier tag_id=321 avec l'id du mot dans le lien
                 */
                while ($tag = $lesInformations->fetch_assoc())
                {
                    //echo "<pre>" . print_r($tag, 1) . "</pre>";
                    ?>
                    <article>
                        <h3>#<?php echo$tag['tag_label']?></h3>
                        <p>id:<?php echo$tag['tag_id']?></p>
                        <nav>
                            <a href="tags.php?tag_id=<?php echo$tag['tag_id']?>">Messages</a>
                        </nav>
                    </article>
                <?php } ?>
            </aside>
            <main>
                <h2>Utilisatrices</h2>
                <?php
                /*
                 * Etape 4 : trouver tous les mots clés
                 * PS: on note que la connexion $mysqli à la base a été faite, pas besoin de la refaire.
                 */
                $folderName = "adminUsers"; 
                $laQuestionEnSql = request($folderName); 
                $lesInformations = connexion($laQuestionEnSql);

                /*
                 * Etape 5 : @todo : Afficher les utilisatrices en s'inspirant de ce qui a été fait dans news.php
                 * Attention à ne pas oublier de modifier dans le lien les "user_id=123" avec l'id de l'utilisatrice
                 */
                while ($tag = $lesInformations->fetch_assoc())
                {
                    //echo "<pre>" . print_r($tag, 1) . "</pre>";
                    ?>
                    <article>
                        <h3><?php echo$tag['user_alias']?></h3>
                        <p>id:<?php echo$tag['user_id']?></p>
                        <nav>
                            <a href="wall.php?user_id=<?php echo$tag['user_id']?>">Mur</a>
                            &nbsp <a href="feed.php?user_id=<?php echo$tag['user_id']?>">Flux</a>
                            &nbsp <a href="settings.php?user_id=<?php echo$tag['user_id']?>">Paramètres</a>
                            &nbsp <a href="followers.php?user_id=<?php echo$tag['user_id']?>">Suiveurs</a>
                            &nbsp <a href="subscriptions.php?user_id=<?php echo$tag['user_id']?>">Abonnements</a>
                        </nav>
                    </article>
                <?php } ?>
            </main>
        </div>
    </body>
</html>
