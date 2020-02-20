<?php
include "dbConnection.php";
$conn = openConnection();

$username = strip_tags(addslashes($_GET['Username'])); //get username
$sql = "SELECT * FROM users WHERE Username='$username'";
$result = $conn->query($sql) or die($conn->error);

if($result->num_rows>0){ //checking username exists
  while($row=$result->fetch_assoc()){
    if(password_verify($_GET['Password'], $row['Password'])){ //check password
      $userAccess = $row['UserAccess'];
      $key = generateKey(); //generate key
      $sql = "INSERT INTO javaaccess(SessionCode, OnUpdate) VALUES('$key', '1')";
      //update db
      if($conn->query($sql)){
        echo "$key/$userAccess";
      } else {
        echo $conn->error;
      }
    } else {
      echo "Password incorrect.";
    }
  }
} else {
  echo "Username not found.";
}

closeConnection($conn);

function generateKey(){
    $key = "";
    //loop concatenates ranndom digits into string
    for($i=0; $i<20; $i++){
        $key .= mt_rand(0, 9);
    }

    return $key;
}

?>
