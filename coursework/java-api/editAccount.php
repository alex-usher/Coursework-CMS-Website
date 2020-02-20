<?php
  include "dbConnection.php";
  include "checkKey.php";
  $conn = openConnection();
  $key = strip_tags(addslashes($_GET['key']));

  if(checkKey($key, $conn)){//check session
    if(isset($_GET['username'])&&isset($_GET['newUsername'])&&isset($_GET['name'])&&isset($_GET['email'])&&isset($_GET['access'])){//presence check
      if(strlen($_GET['username'])>0&&strlen($_GET['newUsername'])>0&&strlen($_GET['name'])>0&&strlen($_GET['email'])>0&&strlen($_GET['access'])>0){//length check
        $username = strip_tags(addslashes($_GET['username']));//get inputs
        $newUsername = strip_tags(addslashes($_GET['newUsername']));
        $name = strip_tags(addslashes($_GET['name']));
        $email = strip_tags(addslashes($_GET['email']));
        $access = strip_tags(addslashes($_GET['access']));

        $update = true;

        if($username === $newUsername){//checks if username changed
          $update=true;
        } else { //if username changed, check that it doesn't already exist
          $sql = "SELECT * FROM users";
          $result = $conn->query($sql) or die("Couldn't connect");
          while($row=$result->fetch_assoc()){
            if($row['Username']===$newUsername){
              echo "Username already exists";
              $update = false;
            }
          }
        }

        if($update){//if username didn't exist
          $sql = "UPDATE users SET Name='$name', Username='$newUsername', Email='$email', UserAccess='$access' WHERE Username='$username'";
          if($conn->query($sql)){
            echo "Success";
          }
        }
      } else {
        echo "Please complete the form";
      }
    } else {
      echo "Please complete the form.";
    }
  }

  closeConnection($conn);

 ?>
