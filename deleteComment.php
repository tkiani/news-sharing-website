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
    $type = $_POST['type'];
    $id = $_POST['id'];
 
                $stmt = $mysqli->prepare("DELETE from comments where id=? and username=?");
                if(!$stmt){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                }
                $stmt->bind_param('is', $id, $username);
                $stmt->execute();
                $stmt->close();

    header('Location: found.php');
?>
