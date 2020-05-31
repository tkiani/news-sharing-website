<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Search page</title>
    <link rel="stylesheet" type="text/css" href="NEWS.css" />
    <link href="https://fonts.googleapis.com/css?family=Playball" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="Post.css" />

  </head>

  <body>
    <div class="header">
    <div class="logo"><img src="SEASlogo_728px.jpg">
    <div class="logo1"><img src="download.jpeg">
    </div>
    </div>

    <div class="menu">
      <div class="container">
        <ul>
          <li><a href="found.php">DashBoard</a></li>
          <li><a href="signout.php">Signout</a></li>
          </ul>

      </div>
    </div>

   

<?php
session_start();

$username = $_POST['search'];
echo'<h1 class = "newsfeed">'.ucfirst($username).'&#8217;s Posts</h1>';
echo '</div>';
echo '<div class = "user_posts">';
?>

<?php
require 'mydatabase.php';
$stmt = $mysqli->prepare("SELECT id, link, username, text, body from post where username = ? order by id");
if(!$stmt) {
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->bind_param('s', $username);
$stmt->execute();
$stmt->bind_result($post_id, $post_link, $post_username, $post_text, $post_body);

while($stmt->fetch()){
echo '<h3>'.ucfirst(htmlentities($post_text)).'</h3>';
echo "<h4> Post link: </h4> <a href='$post_link'>$post_link</a>";
echo '<h4>Post ID: </h4>'.htmlentities($post_id);
echo "<h4>Posted by: </h4>".ucfirst(htmlentities($post_username)).'<br>';
echo '<br><i>'.htmlentities($post_body).'</i><br>';
}

$stmt->close();

?>

  </body>
</html>