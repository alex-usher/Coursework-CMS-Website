<?php

function openConnection() {
  $file = fopen("../setup/db.txt", "r");//open file
  $dbInfo = array_fill(0, 4, "");//array for info
  $i = 0;
  while(!(feof($file)) && $i<4){//get info from file
    $test = fgets($file);
    if($test != false){
        $dbInfo[$i] = addslashes(substr($test, 0, strlen($test)-1));
    }
    $i++;
  }
//connect to db
$conn = mysqli_connect($dbInfo[1]/*dbhost*/, $dbInfo[2]/*dbuser*/, $dbInfo[3]/*dbpwd*/, $dbInfo[0]/*dbname*/);
  return $conn; //return connection
}

function closeConnection($conn){
    $conn -> close(); //close connection
}

?>
