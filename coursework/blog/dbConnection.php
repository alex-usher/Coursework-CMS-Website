<?php

function openConnection() {

  $file = fopen("../setup/db.txt", "r");
  $dbInfo = array_fill(0, 4, "");
  $i = 0;
  while(!(feof($file)) && $i<4){
    $test = fgets($file);
    if($test != false){
        $dbInfo[$i] = substr($test, 0, strlen($test)-1);
    }
    $i++;
  }

  $conn = mysqli_connect($dbInfo[1], $dbInfo[2], $dbInfo[3], $dbInfo[0]) or die($conn -> error);
  return $conn; //return connection
}

function closeConnection($conn){
    $conn -> close(); //close connection
}

?>
