<?php
include "dbConnection.php";
include "checkKey.php";
$conn = openConnection();
$key = strip_tags(addslashes($_GET['key']));

if(checkKey($key, $conn)){//check session
  $id = strip_tags(addslashes($_GET['id']));//get id
  $sql = "DELETE FROM pages WHERE PageID='$id'";
  //query db
  if($conn->query($sql)){
    echo "Success";
  } else {
    echo $conn->error;
  }
}

closeConnection($conn);
?>
