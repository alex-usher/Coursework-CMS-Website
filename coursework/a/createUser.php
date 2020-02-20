<?php
session_start();
include "dbConnection.php";
$conn = openConnection();

if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']==true){ //check form complete & session exists
  if(isset($_SESSION['userAccess'])&&$_SESSION['userAccess']===3){
    if(isset($_GET["nameEntry"]) && isset($_GET["usernameEntry"]) && isset($_GET["emailEntry"]) && isset($_GET["passwordEntry"]) && isset($_GET["accessEntry"])) {//presence check
      if(strlen($_GET['nameEntry']) > 0 && strlen($_GET['usernameEntry']) > 0 && strlen($_GET['emailEntry']) > 0 && strlen($_GET['passwordEntry']) > 0 && strlen($_GET['accessEntry']) > 0){//length check
        $name = strip_tags(addslashes($_GET['nameEntry'])); //getting user inputs
        $username = strip_tags(addslashes($_GET['usernameEntry']));
        $email = strip_tags(addslashes($_GET['emailEntry']));
        $password = strip_tags(addslashes($_GET['passwordEntry']));
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $access = strip_tags(addslashes($_GET['accessEntry']));
        $date = date("Y-m-d");

        $createUser = TRUE;
        $sql = "SELECT * FROM users";

        $result = $conn -> query($sql) or die("Could not get database info");
        //query db
        while($row = $result -> fetch_assoc()){
            if($row['Username'] == $username){
                $createUser = FALSE; //checking if username already exists
            }
        }

        if($createUser == TRUE){//if username not existing already
          $sql = "INSERT INTO users(Name, Email, Username, Password, UserAccess, DateCreated) VALUES ('$name', '$email', '$username', '$hashPassword', '$access', '$date');";
          //insert information into database
          if ($conn -> query($sql) === TRUE) {
            header("Location: users.php"); //redirect back to main users page
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
        } else { //validation for existing username
            header("Location: addUser.php?alert=Username already exists");
        }
    } else {
      header("Location: addUser.php?alert=Please complete the form");
    }
    } else { //validation for incomplete form
      header("Location: addUser.php?alert=Please complete the form");
    }
    closeConnection($conn);
  } else {
    header("Location: users.php?alert=A higher user access level is required");
  }

} else{ //validation for invalid session
    header("Location: ../a.php?alert='Please Log In'");
}

?>
