<?php
require 'mydatabase.php';
    session_start();
    $username = $_SESSION['user'];
    $link = $_POST['link'];
    $text = $_POST['title'];
    $body = $_POST['body'];
    if ($username == null) {
        // header('Location: dashboard.php');
        echo"Empty Username";
        exit;
    }
    // if(!hash_equals($_SESSION['token'], $_POST['token'])){
    //     die("Request forgery detected");
    // }
    $stmt = $mysqli->prepare("INSERT into post (username, link, text, body) values (?, ?, ?, ?)");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    if (strlen ($link) > 256 || strlen ($text) > 256) {
        printf("Text and/or link is too many characters long.");
        exit;
    }
    $stmt->bind_param('ssss', $username, $link, $text, $body);
    $stmt->execute();
    $stmt->close();
    header('Location: found.php');
?>
