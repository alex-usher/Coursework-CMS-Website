<?php
include "dbConnection.php";
include "checkKey.php";
$conn = openConnection();
$key = strip_tags(addslashes($_POST['key']));//get key

if(checkKey($key, $conn)){//check session
  $sql = "SELECT * FROM users";//query db
  $result = $conn->query($sql);
  if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
      $UserID = $row['UserID'];//get info
      $Name = $row['Name'];
      $Username = $row['Username'];
      $UserAccess = $row['UserAccess'];

      echo "$UserID/$Name/$Username/$UserAccess<br>";
    }
  }
}

closeConnection($conn);

?>
