<?php
    session_start();
    include "dbConnection.php";
    include "htmlcode.php";
    $conn = openConnection();

    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){//check session
        if(isset($_SESSION['userAccess']) && $_SESSION['userAccess'] == 3){//check user access

          $anchorId = strip_tags(addslashes($_GET['anchorId']));//get id
            $sql = "DELETE FROM menu WHERE MenuID ='$anchorId';";//query db
            if($conn -> query($sql)){
              header("Location: menu.php");
            } else {//if error
              echo("Couldn't get info: " . $conn -> error);
            }
        } else {
            header('Location: menu.php?alert=User Access Level 3 Required');
        }
    } else {
        header('Location: ../a.php?alert=Please Log In');
    }
?>
