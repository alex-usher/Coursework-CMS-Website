<?php
include "dbConnection.php";
include "checkKey.php";
$conn = openConnection();
$key = strip_tags(addslashes($_POST['key']));//get key

if(checkKey($key, $conn)){ //check key
  $sql = "SELECT * FROM menu"; //query db
  $result = $conn->query($sql) or die($conn->error);
  if($result->num_rows>0){ //get query result set
    while($row=$result->fetch_assoc()){
      $MenuID = $row['MenuID']; //getting results
      $MenuName = $row['MenuName'];
      $MenuContents = $row['MenuContents'];
      //output results for app
      echo "$MenuID/$MenuName/$MenuContents<br>";
    }
  }
}

closeConnection($conn);

 ?>
