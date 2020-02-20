<?php
include "dbConnection.php";
include "checkKey.php";
$conn = openConnection();
$key = strip_tags(addslashes($_POST['key']));//get key
$username = strip_tags(addslashes($_GET['username']));

if(checkKey($key, $conn)){//check session
  $sql = "SELECT * FROM users WHERE Username='$username'";
  $result = $conn->query($sql) or die($conn->error);
  if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
      $username = $row['Username'];//get info
      $name = $row['Name'];
      $userAccess = $row['UserAccess'];
      $email = $row['Email'];

      echo "$name/$username/$email/$userAccess";
    }
  }
}

closeConnection($conn);

?>
