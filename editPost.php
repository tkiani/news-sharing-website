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
 

                $stmt1 = $mysqli->prepare("UPDATE post SET body=? WHERE username=? AND id=?");
                if(!$stmt1){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                }
                $stmt1->bind_param('ssi', $new_text, $username, $id);
                $stmt1->execute();
                $stmt1->close();
    header('Location: found.php');
?>