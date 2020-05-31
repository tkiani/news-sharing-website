<?php
    require 'mydatabase.php';
    session_start();
    $username = $_SESSION['user'];

    if ($username == null) {
        header('Location: login.php');
        exit;
    }

    if(!hash_equals($_SESSION['token'], $_POST['token'])){
        die("Request forgery detected");
    }

    $username = $_SESSION['user'];
    $id = $_POST['id'];
   
                $stmt2 = $mysqli->prepare("DELETE from post where id=? and username=?");
                if(!$stmt2){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                }
                $stmt2->bind_param('is', $id, $username);
                $stmt2->execute();
                $stmt2->bind_result($count_);
                $stmt2->close();
                if ($count_ == 0) {
                    header('Location: found.php');
                    exit;
                }

    header('Location: found.php');
?>
