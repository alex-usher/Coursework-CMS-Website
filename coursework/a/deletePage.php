<?php
    session_start();
    include "dbConnection.php";
    include "htmlcode.php";
    $conn = openConnection();

    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){ //check session
        if(isset($_SESSION['userAccess']) && $_SESSION['userAccess'] == 3){ //check user access
            $anchorId = strip_tags(addslashes($_GET['anchorId'])); //get id

            $sql = "DELETE FROM pages WHERE PageID = $anchorId"; //set up query

            if($conn->query($sql)){ //query db
              header("Location: pages.php");
            } else {
              echo $conn->error; //in case of error
            }

        } else { //validation for unauthorised access
            header('Location: pages.php?alert=User Access Level 3 Required');
        }
    } else { //validation for no session
        header('Location: ../a.php?alert=Please Log In');
    }


?>
