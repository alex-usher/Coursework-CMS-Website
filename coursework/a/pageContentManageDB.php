<?php
    session_start();
    include "dbConnection.php";
    include "htmlcode.php";
    $conn = openConnection();

    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){
      if(isset($_SESSION['userAccess'])&&$_SESSION['userAccess']>1){
        $id = strip_tags(addslashes($_POST['id']));//get id
        $content = $_POST['content'];

        $sql = "UPDATE pages SET PageContent='".addslashes($content)."' WHERE PageID='$id'";
        //queryd db
        if($conn -> query($sql)){
            header("Location: pages.php");
        } else {
            echo $conn->error;
        }
      }
    } else {
        header('Location: ../a.php?alert=Please Log In');
    }

?>
