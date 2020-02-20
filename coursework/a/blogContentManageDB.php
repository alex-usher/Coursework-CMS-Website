<?php
    session_start();
    include "dbConnection.php";
    include "htmlcode.php";
    $conn = openConnection();

    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){//check session
      if(isset($_SESSION['userAccess'])&&$_SESSION['userAccess']>=2){//check user access
        $id = strip_tags(addslashes($_POST['id']));//get content & id
        $content = $_POST['content'];

        $sql = "UPDATE blog SET BlogContent='".addslashes($content)."' WHERE BlogID='$id'";

        if($conn -> query($sql)){
            header("Location: blog.php");
        } else {
            echo $conn->error;
        }
      } else {
        header("Location: blog.php?alert=A higher user access level is required.");
      }
    } else {
        header('Location: ../a.php?alert=Please Log In');
    }

?>
