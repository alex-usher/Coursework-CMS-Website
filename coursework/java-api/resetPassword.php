<?php
include "dbConnection.php";
include "checkKey.php";
$conn=openConnection();
$key = strip_tags(addslashes($_POST['key']));//get key

if(checkKey($key,$conn)){//check session
  $id = strip_tags(addslashes($_GET['id']));//get id
  $password = password_hash("root", PASSWORD_DEFAULT);
  $sql = "UPDATE users SET Password='$password' WHERE UserID='$id'";
  if($conn->query($sql)){//query db
    echo "Success";
  } else {
    echo "couldn't connect";
  }
}

closeConnection($conn);
?>
