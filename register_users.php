<!DOCTYPE html>
<html lang="en">
  <head>
    <title>New User</title>
  </head>
  <body>
    <?php
      session_start();
      require 'mydatabase.php';
      $new_user = $_POST['new_user'];
      $pwd = $_POST['new_password'];
      $amount = $_POST['amount'];
      $pwd_hash;
      $stmt = $mysqli->prepare("SELECT COUNT(*) FROM users WHERE username=?");
      $stmt->bind_param('s', $new_user);
      $stmt->execute();
      $stmt->bind_result($cnt);
      $stmt->fetch();
      $stmt->close();
      if($cnt > 0) {
        header('Location: fail_register.html');
      } else if( !preg_match('/^[\w_\.\-]+$/', $new_user) ){
        header('Location: fail_register.html');
      } else if (strlen($pwd) > 20 || strlen($pwd) < 4){
        header('Location: invalid_password.html');
        echo "Password length is invalid. Please choose a password between 4 and 20 characters.";
      } else {
        $pwd_hash = password_hash($pwd, PASSWORD_DEFAULT);
        $to_insert = $mysqli->prepare("INSERT into users (username, hashed_password) values (?, ?)");
        if(!$to_insert){
          printf("Query Prep Failed: %s\n", $mysqli->error);
          exit;
        }
        $to_insert->bind_param('ss', $new_user, $pwd_hash);
        $to_insert->execute();
        $to_insert->close();
        header('Location: success_register.php');
      }
    ?>
  </body>
</html>
