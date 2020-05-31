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

    $id = $_POST['id'];
    $new_text = $_POST['new_text'];
   
                $stmt = $mysqli->prepare("UPDATE comments SET comment=? WHERE username=? AND id=?");
                if(!$stmt){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                }
                $stmt->bind_param('ssi', $new_text, $username, $id);
                $stmt->execute();
                $stmt->close();
        
    header('Location: found.php');
?>