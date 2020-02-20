<?php
  include "dbConnection.php";
  include "checkKey.php";
  $conn=openConnection();
  $key = strip_tags(addslashes($_GET['key']));

  if(isset($_GET['id']) && isset($_GET['username']) && isset($_GET['newUsername']) && isset($_GET['name'])
  && isset($_GET['email']) && isset($_GET['access'])){//presence check
    if(strlen($_GET['newUsername'])>0 && strlen($_GET['name'])>0 && strlen($_GET['email'])>0){//length check
      if(checkKey($key, $conn)){//check session
        $id = strip_tags(addslashes($_GET['id']));//get inputs, validate
        $username = strip_tags(addslashes($_GET['username']));
        $newUsername = strip_tags(addslashes($_GET['newUsername']));
        $name = strip_tags(addslashes($_GET['name']));
        $email = strip_tags(addslashes($_GET['email']));
        $access = strip_tags(addslashes($_GET['access']));

        $update = true;

        if($username===$newUsername){//checking if username has been changed
          $update=true;
        } else { //checking if username already exists, if changed
          $sql = "SELECT Username FROM users";
          $result = $conn->query($sql) or die("Couldn't connect to database");
          while($row=$result->fetch_assoc()){
            if($row['Username']===$newUsername){
              $update = false;
              echo "Username already exists";
            }
          }
        }

        if($update){//update db
          $sql = "UPDATE users SET Name='$name', Username='$newUsername', Email='$email', UserAccess='$access' WHERE UserID='$id'";
          if($conn->query($sql)){
            echo "Success";
          } else {
            echo "Couldn't update";
          }
        }
      }
    } else {
      echo "Please complete the form";
    }
  } else {
    echo "Please complete the form";
  }

  closeConnection($conn);
 ?>
