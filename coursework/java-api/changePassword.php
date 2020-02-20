<?php
include "dbConnection.php";
include "checkKey.php";
$conn=openConnection();
$key = strip_tags(addslashes($_GET['key']));

if(checkKey($key, $conn)){//check session
  if(isset($_GET['username'])&&isset($_GET['currentPassword'])&&isset($_GET['checkPassword'])&&isset($_GET['newPassword'])){//presence check
    if(strlen($_GET['username'])>0&&strlen($_GET['currentPassword'])>0&&strlen($_GET['checkPassword'])>0&&strlen($_GET['newPassword'])>0){//length check
      $username = strip_tags(addslashes($_GET['username']));//get input
      $current = strip_tags(addslashes($_GET['currentPassword']));
      $check = strip_tags(addslashes($_GET['checkPassword']));
      $new = strip_tags(addslashes($_GET['newPassword']));

      if($new === $check){//checking passwords the same
        $sql = "SELECT Password FROM users WHERE Username='$username'";
        $result = $conn->query($sql) or die("Couldn't connect to database");//query db
        if($result->num_rows >0){
          while($row=$result->fetch_assoc()){
            if(password_verify($current, $row['Password'])){
              $pword = password_hash($new, PASSWORD_DEFAULT);
              $sql = "UPDATE users SET Password='$pword' WHERE Username='$username'";
              if($conn->query($sql)){
                echo "Success";
              } else {
                echo "Failed";
              }
            } else {
              echo "Current password incorrect";
            }
          }
        } else {
          echo "User does not exist";
        }
      } else {
        echo "Passwords do not match";
      }
    } else {
      echo "Please complete the form";
    }
  } else {
    echo "Please complete the form";
  }
}

closeConnection($conn);
?>
