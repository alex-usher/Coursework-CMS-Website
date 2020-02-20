<?php

function openConnection($db, $dbHost, $dbUser, $dbPwd) {
  //connecting to database
  $conn = mysqli_connect($dbHost, $dbUser, $dbPwd, $db) or header("Location: index.php?alert=Database information incorrect");
  return $conn; //return connection
}

function closeConnection($conn){
    $conn -> close(); //close connection
}

?>
