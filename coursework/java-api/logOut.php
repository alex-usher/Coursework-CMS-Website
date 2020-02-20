<?php
include "dbConnection.php";
include "checkKey.php";
$conn = openConnection();
$key = strip_tags(addslashes($_POST['key']));//get key

if(checkKey($key, $conn)){//check key
  $sql = "SELECT * FROM javaaccess WHERE SessionCode='$key'";
  $results = $conn->query($sql) or die($conn->error);//query db
  if($results->num_rows>0){//delete user
    $sql = "DELETE FROM javaaccess WHERE SessionCode='$key'";
    if($conn->query($sql)){//query db
      echo "Logged out successfully";
    } else {
      $conn->error;
    }
  }
}
closeConnection($conn);
?>
