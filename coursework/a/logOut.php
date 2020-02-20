<?php

    session_start();
    $_SESSION['loggedIn'] = false;
    $_SESSION['username'] = NULL;
    $_SESSION['password'] = NULL;

    if(session_destroy()){//destroy session
        header("Location: ../a.php");
    } else {
        die("Could not log out");
    }

?>
