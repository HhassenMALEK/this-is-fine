<?php 
function displayTags($tags){
    for($i=0;$i<count($tags);$i++) {
        echo <<<HTML
        <a href="">#$tags[$i] </a>
        HTML;
     }
}
?>