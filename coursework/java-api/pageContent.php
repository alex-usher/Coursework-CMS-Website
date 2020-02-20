<?php
include "dbConnection.php";
include "checkKey.php";
$conn = openConnection();
$key = strip_tags(addslashes($_POST['key']));//get key

if(checkKey($key, $conn)){//check session
  $id = strip_tags(addslashes($_GET['id']));//get id
  $sql = "SELECT PageContent FROM pages WHERE PageID='$id'";
  $result = $conn->query($sql) or die("Couldn't get content");
  if($result->num_rows>0){//query db to get content
    while($row=$result->fetch_assoc()){
      echo $row['PageContent'];
    }
  } else {
    echo "Page does not exist";
  }
}

closeConnection($conn);

 ?>
