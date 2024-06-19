<?php
include 'menu.php';
?>
<!doctype html>
<html lang="fr">
    <body>
        <div id="wrapper">
            <?php
            /**
             * Cette page est similaire à wall.php ou feed.php 
             * mais elle porte sur les mots-clés (tags)
             */
            /**
             * Etape 1: Le mur concerne un mot-clé en particulier
             */
            ?>


            <aside>
                <?php
                /**
                 * Etape 3: récupérer le nom du mot-clé
                 */
                $folderName ="tagsId";
                $laQuestionEnSql = request($folderName);
                $lesInformations = connexion($laQuestionEnSql);
                $tag = $lesInformations->fetch_assoc();
                /* @todo: afficher le résultat de la ligne ci dessous, remplacer XXX par le label et effacer la ligne ci-dessous */
                // echo "<pre>" . print_r($tag, 1) . "</pre>";
                ?>
                <img src="user.jpg" alt="Portrait de l'utilisatrice"/>
                <section>
                    <h3>Présentation</h3>
                    <p>Sur cette page vous trouverez les derniers messages comportant
                        le mot-clé <?php echo $tag['label'] ?>
                        (n° <?php echo $tagId ?>)
                    </p>

                </section>
            </aside>
            <main>
                <?php
                /**
                 * Etape 3: récupérer tous les messages avec un mot clé donné
                 */
                $folderName = "tagsPosts";
                $laQuestionEnSql = request($folderName);
                $lesInformations = connexion($laQuestionEnSql);

                /**
                 * Etape 4: @todo Parcourir les messsages et remplir correctement le HTML avec les bonnes valeurs php
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
                           
                            <?php displayTags($tags);
                            ?>
                        </footer>
                    </article>
                <?php } ?>
            </main>
        </div>
    </body>
</html>