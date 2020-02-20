<?php
include "dbConnection.php";
include "checkKey.php";
$conn = openConnection();
$key = strip_tags(addslashes($_GET['key']));

if(checkKey($key, $conn)){//check session
  $id = strip_tags(addslashes($_GET['id']));//get id
  $sql = "SELECT BlogContent FROM blog WHERE BlogID='$id'";
  $result = $conn->query($sql) or die("Couldn't get content");//query db
  if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
      echo $row['BlogContent'];//output content
    }
  } else {
    echo "Blog does not exist";
  }
}

closeConnection($conn);

 ?>
