<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>NEWS Website</title>
    <link href="https://fonts.googleapis.com/css?family=Playball" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="NEWS.css" />
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
          <li><a href="news.php">Home</a></li>
          <li><a href="Login.html">Login</a></li>
          <li><a href="Signin.html">Sign-up</a></li>
          </ul>

      </div>
    </div>

    <div class="wrapper">
      <div class="slider">
        <h1 class="title">Trending</h1>
        <div class="post-wrapper">
          <div class="post">
          <p><a href="https://source.wustl.edu/2020/02/arrokoth-close-up-reveals-how-planetary-building-blocks-were-constructed/">
          <img src="1.jpg" alt="" class="slider-image">
          <div class="post-info">
          <h4><a href="https://source.wustl.edu/2020/02/arrokoth-close-up-reveals-how-planetary-building-blocks-were-constructed/">Arrokoth close-up reveals how planetary building blocks were constructed</a><br></a></p>
          The farthest, most primitive object in the solar system ever to be visited by a spacecraft ..</h4>
          </div>
          </div>
          <div class="post">
          <p><a href="https://source.wustl.edu/2020/02/tale-of-two-cities-day-of-dialogue-action-session-to-explore-building-a-stronger-st-louis-for-all/">
          <img src="2.jpg" alt="" class="slider-image">
          <div class="post-info">
          <h4><a href="https://source.wustl.edu/2020/02/tale-of-two-cities-day-of-dialogue-action-session-to-explore-building-a-stronger-st-louis-for-all/">‘Tale of Two Cities’ — Day of Dialogue & Action session to explore building a stronger St. Louis for all</a><br></a></p>
          Incomes in the City of St. Louis have been rising — but only for white residents...</h4>
          </div>
          </div>
          <div class="post">
          <p><a href="https://source.wustl.edu/2020/02/collaboration-lets-researchers-read-proteins-for-new-properties/">
          <img src="3.jpg" alt="" class="slider-image">
          <div class="post-info">
          <h4><a href="https://source.wustl.edu/2020/02/collaboration-lets-researchers-read-proteins-for-new-properties/">Collaboration lets researchers ‘read’ proteins for new properties</a><br></a></p>
          Clumps of proteins inside cells are a common thread in many neurodegenerative diseases...</h4>
          </div>
          </div>

        </div>
        </div>
        </div>
    

      <div id="container">
        
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
