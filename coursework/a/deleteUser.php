<?php
    session_start();
    include "dbConnection.php";
    include "htmlcode.php";
    $conn = openConnection();

    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){ //check session
        if(isset($_SESSION['userAccess']) && $_SESSION['userAccess'] == 3){ //check access level
            $id = $_GET['id']; //get id of user

            $sql = "DELETE FROM users WHERE UserID = $id";

            if($conn->query($sql)){ //delete user
              header("Location: users.php");
            } else {
              echo $conn->error; //in case of error
            }
        } else {
            header('Location: users.php?alert=User Access Level 3 Required');
        }
    } else {
        header('Location: ../a.php?alert=Please Log In');
    }
?>
