<?php

function openConnection() {
  $file = fopen("../setup/db.txt", "r");//get file
  $dbInfo = array_fill(0, 4, "");//initialise array
  $i = 0;
  while(!(feof($file)) && $i<4){//get file contents
    $test = fgets($file);
    if($test != false){//split file contents into individual elements
        $dbInfo[$i] = addslashes(substr($test, 0, strlen($test)-1));
    }
    $i++;
  }

$conn = mysqli_connect($dbInfo[1]/*dbhost*/, $dbInfo[2]/*dbuser*/, $dbInfo[3]/*dbpwd*/, $dbInfo[0]/*dbname*/);
  return $conn; //return connection
}

function closeConnection($conn){
    $conn -> close(); //close connection
}

?>
