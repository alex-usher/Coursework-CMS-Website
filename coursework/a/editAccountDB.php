<?php
    session_start();
    include "dbConnection.php";
    include "htmlcode.php";
    $conn = openConnection();

    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){//check session
      if(isset($_GET['NameInput']) && isset($_GET['UsernameInput']) && isset($_GET['EmailInput']) && isset($_GET['AccessEntry']) && isset($_GET['userid'])){
        if(strlen($_GET['NameInput'])>0 && strlen($_GET['UsernameInput'])>0 && strlen($_GET['EmailInput'])>0 && strlen($_GET['AccessEntry'])>0 && strlen($_GET['userid'])>0){
          $name = strip_tags(addslashes($_GET['NameInput']));//get inputs
          $username = strip_tags(addslashes($_GET['UsernameInput']));
          $email = strip_tags(addslashes($_GET['EmailInput']));
          $access = strip_tags(addslashes($_GET['AccessEntry']));
          $userID = strip_tags(addslashes($_GET['userid']));

          $sql = "SELECT * FROM users";//query db
          $result = $conn -> query($sql) or die("Could not get database info");

          $editUser = TRUE;

          while($row = $result -> fetch_assoc()){
              if($row['UserID'] == $userID){//checking username doesn't exist
                  continue;
              } else if($row['Username'] == $username){
                  $editUser = FALSE;
              }
          }

          if($editUser == TRUE){//update db if username not found
              $sql = "UPDATE users SET Name = '$name', Username = '$username', Email = '$email', UserAccess = '$access' WHERE UserID = '$userID'";
              if($conn->query($sql)){
                  $_SESSION['name'] = $name;
                  $_SESSION['username'] = $username;
                  $_SESSION['userAccess'] = $access;
                  header("Location: account.php");
              } else {
                  echo "Error: " . $sql . "<br>" . $conn->error;
              }
          } else {
              header("Location: users.php?alert=Username Taken");
          }

        } else {
            header("Location: editAccount.php?alert=Please complete the form");
        }
      } else {
        header("Location: editAccount.php?alert=Please complete the form");
      }
    } else {
        header('Location: ../a.php?alert=Please Log In');
    }
?>
