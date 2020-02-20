<?php
    session_start();
    include "dbConnection.php";
    include "htmlcode.php";
    $conn = openConnection();

    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){// check session
        if(isset($_GET["submitEntry"]) && isset($_GET["current"]) && isset($_GET["new"]) && isset($_GET['check'])){//presence check
          if(strlen($_GET['current'])>0 && strlen($_GET['new'])>0 && strlen($_GET['check'])>0){//length check
            $currentPassword = $_GET['current'];//get current password
            $passwordMatch = password_verify($currentPassword, $_SESSION['password']);

            if($passwordMatch){
                $newPassword = password_hash($_GET['new'], PASSWORD_DEFAULT);//get new password & hash
                $checkPassword = $_GET['check'];//get check password

                if(password_verify($checkPassword, $newPassword)){//if new & check passwords match
                  $sql = "UPDATE users SET Password='$newPassword' WHERE Username='".$_SESSION['username']."'";

                  if($conn->query($sql)){ //query db
                      $_SESSION['password'] = $newPassword;
                      header("Location: account.php");
                  } else {
                      echo "Error: " . $sql . "<br>" . $conn->error;
                  }
                } else {
                  header("Location: changePassword.php?alert=Passwords did not match");
                }
            } else {
                header("Location: changePassword.php?alert=Current Password Incorrect");
            }
          } else {
            header("Location: changePassword.php?alert=Please complete the form");
          }
        } else {
            header("Location: changePassword.php?alert=Complete all fields");
        }
    } else {
        header('Location: ../a.php?alert=Please Log In');
    }
?>
