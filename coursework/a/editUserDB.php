<?php
    session_start();
    include "dbConnection.php";
    include "htmlcode.php";
    $conn = openConnection();

    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){ //check session
        if(isset($_SESSION['userAccess']) && $_SESSION['userAccess'] == 3){ //check user access level
            //get user inputs
            $name = strip_tags(addslashes($_GET['NameInput']));
            $username = strip_tags(addslashes($_GET['UsernameInput']));
            $email = strip_tags(addslashes($_GET['EmailInput']));
            $access = strip_tags(addslashes($_GET['AccessEntry']));
            $userID = strip_tags(addslashes($_GET['userid']));

            $sql = "SELECT * FROM users";
            $result = $conn -> query($sql) or die("Could not get database info");

            $editUser = TRUE;

            while($row = $result -> fetch_assoc()){
                if($row['UserID'] == $userID){
                    continue; // doesn't check user being edited
                } else if($row['Username'] == $username){
                    $editUser = FALSE; //checking for indentical usernames
                }
            }

            if($editUser == TRUE){//if username doesn't exist
                $sql = "UPDATE users SET Name = '$name', Username = '$username', Email = '$email', UserAccess = '$access' WHERE UserID = '$userID'";
                if($conn->query($sql)){
                    header("Location: users.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                header("Location: users.php?alert=Username Taken");
            }

        } else {
            header("Location: users.php?alert=User Access Level 3 Required");
        }
    } else {
        header('Location: ../a.php?alert=Please Log In');
    }
?>
