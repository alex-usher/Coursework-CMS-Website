<?php
    include "dbConnection.php";
    $_SESSION['loggedIn'] = false; //ensuring no active session variables
    $_SESSION['username'] = NULL;
    $_SESSION['password'] = NULL;

    //checking form is complete
    if(isset($_GET["usernameEntry"]) && isset($_GET["passwordEntry"])){
      $conn = openConnection(); // connect to DB
        $usernameInput = strip_tags(addslashes($_GET['usernameEntry'])); //get & validate input
        $passwordInput = strip_tags(addslashes($_GET['passwordEntry']));
        //query DB
        $sql = "SELECT Name, Username, Password, UserAccess FROM users WHERE Username='$usernameInput'";
        $result = $conn->query($sql) or die($conn->error);

        if($result -> num_rows > 0){
          while($row = $result -> fetch_assoc()){
            $dbPassword = $row['Password']; //getting info from DB
            $dbUsername = $row['Username'];
            $dbName = $row['Name'];
            $dbAccess = $row['UserAccess'];
          }
        } else { //if username doesn't exist
          header("Location: ../a.php?alert=Your login details were incorrect");
        }
        //checking inputs against DB credentials
        if($dbUsername === $usernameInput && password_verify($passwordInput, $dbPassword)){
          session_start();
          $_SESSION['loggedIn'] = true; //create session
          $_SESSION['name'] = $dbName;
          $_SESSION['username'] = $dbUsername;
          $_SESSION['password'] = $dbPassword;
          $_SESSION['userAccess'] = $dbAccess;
          header("Location: home.php");
        } else {
          session_destroy();
          $_SESSION['loggedIn'] = false; // destroy session
          $_SESSION['name'] = NULL;
          $_SESSION['username'] = NULL;
          $_SESSION['password'] = NULL;
          $_SESSION['userAccess'] = NULL;
          header("Location: ../a.php?alert=Your login details were incorrect");
          exit;
        }
  } else {
    header("Location: ../a.php?alert=Please enter details in all fields");
  }
?>
