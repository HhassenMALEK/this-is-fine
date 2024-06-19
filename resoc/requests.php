<?php
$userId = -1;
$tagId = -1;

if (isset($_GET['user_id'])) {
    $userId =intval($_GET['user_id']);
}

if (isset($_GET['tag_id'])) {
    $tagId =intval($_GET['tag_id']);
}

$news = "
SELECT posts.content,
posts.created,
users.alias as author_name,  
count(likes.id) as like_number,  
GROUP_CONCAT(DISTINCT tags.label) as taglist 
FROM posts
JOIN users ON  users.id=posts.user_id
LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
LEFT JOIN likes      ON likes.post_id  = posts.id 
GROUP BY posts.id
ORDER BY posts.created DESC  
LIMIT 5
";


$adminTags = "
SELECT tags.id AS tag_id, tags.label AS tag_label FROM `tags` LIMIT 50";


$adminUsers = "SELECT users.id AS user_id, users.alias AS user_alias FROM `users` LIMIT 50";
$feedUsers = "SELECT * FROM `users` WHERE id= '$userId' ";
$feedPosts = "
SELECT posts.content,
posts.created,
users.alias as author_name,  
count(likes.id) as like_number,  
GROUP_CONCAT(DISTINCT tags.label) AS taglist 
FROM followers 
JOIN users ON users.id=followers.followed_user_id
JOIN posts ON posts.user_id=users.id
LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
LEFT JOIN likes      ON likes.post_id  = posts.id 
WHERE followers.following_user_id='$userId' 
GROUP BY posts.id
ORDER BY posts.created DESC  
";

$followersUsers = "
SELECT users.*
FROM followers
LEFT JOIN users ON users.id=followers.following_user_id
WHERE followers.followed_user_id='$userId'
GROUP BY users.id
";

$settingsUsers = "
SELECT users.*, 
count(DISTINCT posts.id) as totalpost, 
count(DISTINCT given.post_id) as totalgiven, 
count(DISTINCT recieved.user_id) as totalrecieved 
FROM users 
LEFT JOIN posts ON posts.user_id=users.id 
LEFT JOIN likes AS given ON given.user_id=users.id 
LEFT JOIN likes AS recieved ON recieved.post_id=posts.id 
WHERE users.id = '$userId' 
GROUP BY users.id
";

$subscriptionsUsers = "
SELECT users.* 
FROM followers 
LEFT JOIN users ON users.id=followers.followed_user_id 
WHERE followers.following_user_id='$userId'
GROUP BY users.id
";

$tagsId = "SELECT * FROM tags WHERE id= '$tagId' ";
$tagsPosts = "
SELECT posts.content,
posts.created,
users.alias as author_name,  
count(likes.id) as like_number,  
GROUP_CONCAT(DISTINCT tags.label) AS taglist 
FROM posts_tags as filter 
JOIN posts ON posts.id=filter.post_id
JOIN users ON users.id=posts.user_id
LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
LEFT JOIN likes      ON likes.post_id  = posts.id 
WHERE filter.tag_id = '$tagId' 
GROUP BY posts.id
ORDER BY posts.created DESC  
";

$wallId = "
SELECT * FROM users WHERE id= '$userId' ";

$wallPosts = "
SELECT posts.content, posts.created, users.alias as author_name, 
COUNT(likes.id) as like_number, GROUP_CONCAT(DISTINCT tags.label) AS taglist 
FROM posts
JOIN users ON  users.id=posts.user_id
LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
LEFT JOIN likes      ON likes.post_id  = posts.id 
WHERE posts.user_id='$userId' 
GROUP BY posts.id
ORDER BY posts.created DESC  
";

$requests = array("news"=>$news,"adminTags"=> $adminTags, "adminUsers"=> $adminUsers, "followersUsers"=> $followersUsers, "feedUsers"=> $feedUsers, "feedPosts"=> $feedPosts, "settingsUsers"=>$settingsUsers, "subscriptionsUsers"=>$subscriptionsUsers, "tagsId"=>$tagsId, "tagsPosts"=>$tagsPosts, "wallId"=>$wallId, "wallPosts"=>$wallPosts);


function request($folderName){
    global $requests;
    foreach($requests as $key => $value){
            if ($folderName == $key) {
                $laQuestionEnSql = $value;
                return $laQuestionEnSql;
            }
    }
}
?>