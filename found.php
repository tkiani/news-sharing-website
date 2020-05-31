<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Post</title>
    <link rel="stylesheet" type="text/css" href="Dashboard.css" />
    <link href="https://fonts.googleapis.com/css?family=Playball" rel="stylesheet">

    <?php
        session_start(); 
       $username = $_SESSION['user'];
     ?>

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
          <li><a href="newPost.html">Make a Post</a></li>
          <li><a href="search_page.html">Search Posts by a User</a></li>
          <li><a href="signout.php">Signout</a></li>
          </ul>

      </div>
    </div>


    <h1><?php echo "Welcome ".ucfirst($username).'!' ?></h1>
  
    <div id="container">
    <div id="sidebar">

      <form name="new_comment" action="comment.php" method="POST" class = "new_comment">
          <h2>Enter the Post Id on which you want to comment</h2>
          <h2>.<input type="text" name="post_id" id="post_id" placeholder="Type Here"/></h2>
          <h2>Comment</h2>
          <h2>.<input type="text" name="comment" id="comment" placeholder="Type Here"/></h2>
          <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
          <h3>.<input type="submit" value="Post Comment" /></h3>
       </form>

       <form name="input" action="deleteComment.php" method="POST">
        <h2> <label for="id">Enter the comment ID that you want to delete</label></h2>
        <h2> <input type="text" name="id" id="id" /></h2>
        <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>"  />
        <h2><input type="submit" value="Delete Comment" /></h2>
       </form>

       <form name="input" action="deletePost.php" method="POST">
        <h2> <label for="id">Enter the post ID that you want to delete</label></h2>
        <h2> <input type="text" name="id" id="id" /></h2>
         <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
        <h2> <input type="submit" value="Delete Post" /></h2>
       </form>

       <form name="input" action="editComment.php" method="POST">
       <h2>  <label for="id">Enter the comment ID that you want to edit</label></h2>
       <h2>        <input type="text" name="id" id="id" /></h2>
       <h2>        <label for="new_text">New Comment</label></h2>
       <h2>        <input type="text" name="new_text" id="new_text" /></h2>
       <h2>        <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" /></h2>
       <h2>          <input type="submit" value="Edit Comment" /></h2>
        </form>

        <form name="input" action="editPost.php" method="POST">
       <h2>  <label for="id">Enter the post ID that you want to edit</label></h2>
       <h2>  <input type="text" name="id" id="id" /></h2>
       <h2>  <label for="new_text">New Post</label></h2>
       <h2>  <input type="text" name="new_text" id="new_text" /></h2>
       <h2>  <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" /></h2>
       <h2>  <input type="submit" value="Edit Post" /></h2>
        </form>

        </div>
        </div>

    <div id="container2">
    <?php
    require 'mydatabase.php';
    $stmt = $mysqli->prepare("SELECT post.id, comments.comment, post.username, comments.username, post.link, post.text, comments.id, post.body from
    post left join comments on (comments.post_id = post.id) order by post.id");
    if(!$stmt) {
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->execute();
    $stmt->bind_result($post_id, $comment, $post_username, $comment_username, $link, $text, $comment_id, $post_body);
    $temp = null;
    while($stmt->fetch()){
        if ($comment == null) {
            echo '<h3>'.ucfirst(htmlentities($text)).'</h3>';
            echo "<h4>Post link: </h4> <a href='$link'>$link</a>";
            echo '<h4>Post id: </h4>'.htmlentities($post_id);
            echo "<h4>Post by:</h4> ".ucfirst(htmlentities($post_username)).'<br>';
            if ($post_body != null) {
            echo '<br><i>'.htmlentities($post_body).'</i><br>';
            }
        }
        else if ($post_id != $temp) {
            echo '<h3>'.ucfirst(htmlentities($text)).'</h3>';
            echo "<h4> Post link: </h4> <a href='$link'>$link</a>";
            echo '<h4>Post ID: </h4>'.htmlentities($post_id);
            echo "<h4>Posted by: </h4>".ucfirst(htmlentities($post_username)).'<br>';
            if ($post_body != null) {
              echo '<br><i>'.htmlentities($post_body).'</i><br>';
            }
            echo '<hr>';
            echo htmlentities($comment_id)." | <b>".ucfirst(htmlentities($comment_username))."</b>"." | ".htmlentities($comment);
            echo '<br>';
        }
        else {
            echo htmlentities($comment_id)." | <b>".ucfirst(htmlentities($comment_username))."</b>"." | ".htmlentities($comment);
            echo '<br>';

        }
        $temp = $post_id;
    }
    $stmt->close();

    ?>



</div>
</body>
</html>
