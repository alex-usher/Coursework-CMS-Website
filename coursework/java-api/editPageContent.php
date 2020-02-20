<?php
include "dbConnection.php";
include "checkKey.php";
$conn = openConnection();
$key = strip_tags(addslashes($_POST['key']));//get key

if(checkKey($key, $conn)){//check session
  if(isset($_POST['id']) && isset($_POST['content'])){//presence check
    if(strlen($_POST['id'])>0 && strlen($_POST['content'])>0){//length check
      $id = strip_tags($_POST['id']);//get inputs
      $content = addslashes($_POST['content']);

      $sql = "UPDATE pages SET PageContent='$content' WHERE PageID='$id'";
      if($conn->query($sql)){//update db
        echo "Success";
      } else {
        echo $conn -> error;
      }
    } else {
      echo "Please complete the form";
    }
  } else {
    echo "Please complete the form";
  }
}

?>
