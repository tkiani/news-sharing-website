<?php
require 'mydatabase.php';
    session_start();
    $username = $_SESSION['user'];
    if ($username == null) {
        header('Location: found.php');
        exit;
    
    }
    if(!hash_equals($_SESSION['token'], $_POST['token'])){
        die("Request forgery detected");
    }

    $post_id = $_POST['post_id'];
    $comment = $_POST['comment'];
    $stmt = $mysqli->prepare("INSERT into comments (username, post_id, comment) values (?, ?, ?)");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    if (strlen ($comment) > 256) {
        printf("Comment is too many characters long. Please limit to 256 characters.");
        exit;
    }
    $stmt->bind_param('sis', $username, $post_id, $comment);
    $stmt->execute();
    $stmt->close();
    header('Location: found.php');
?>
