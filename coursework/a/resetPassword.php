<?php
    session_start();
    include "dbConnection.php";
    include "htmlcode.php";
    $conn = openConnection();

    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){ //check for session
        if(isset($_SESSION['userAccess']) && $_SESSION['userAccess'] == 3){ //check access level
            $userID = $_GET['id'];//get id
            $hashPassword = password_hash('root', PASSWORD_DEFAULT);//create hash of 'root'

            $sql = "UPDATE users SET Password='$hashPassword' WHERE UserID='$userID'";
            //reset password input in database
            if($conn->query($sql)){
                header("Location: users.php");
            }
        } else { //validation for incorrect user access level
            header("Location: users.php?alert=User Access Level 3 Required");
        }
    } else { //validation for no session
        header('Location: ../a.php?alert=Please Log In');
    }
?>
