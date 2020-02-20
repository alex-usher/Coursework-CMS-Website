<?php //testConnection.php
include "dbConnection.php"; //include database connection file

$conn = openConnection(); //connect
echo "Successfully Opened Connection";
//select information
$result = $conn -> query("SELECT * FROM test") or die("<br>Couldn't send query");
echo "<br>Query sent";
if($result->num_rows>0){ //checking query successful
  $row = $result -> fetch_assoc();
  echo "<br>DB Output: " . $row['TestID'];
  echo "<br>DB Output: " . $row['TestName']; //output information
} else {
  echo "<br>Query returned null";
}

closeConnection($conn); //close
echo "<br>Successfully closed connection";
 ?>
