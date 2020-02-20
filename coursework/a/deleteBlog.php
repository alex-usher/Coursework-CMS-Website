<?php
    session_start();
    include "dbConnection.php";
    include "htmlcode.php";
    $conn = openConnection();

    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){ //check session
        if(isset($_SESSION['userAccess']) && $_SESSION['userAccess'] == 3){ //check user access
            $anchorId = strip_tags(addslashes($_GET['anchorId'])); //get id to delete
            $sql = "DELETE FROM blog WHERE BlogID = $anchorId"; //set up query

            if($conn->query($sql)){ //query database
                header("Location: blog.php");
            } else {
              echo $conn->error; //if error occurs
            }
        } else { //validation for unauthorised access
            header('Location: blog.php?alert=User Access Level 3 Required');
        }
    } else { //validation for no session
        header('Location: ../a.php?alert=Please Log In');
    }


?>
