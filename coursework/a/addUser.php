<?php
    session_start();

    include "dbConnection.php";
    include "htmlcode.php";
    $conn = openConnection();

    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){//check session
      if(isset($_SESSION['userAccess']) && $_SESSION['userAccess'] == 3){//check user access
        $content = "<html>
    " . $head . "
    <body>
        " . $nav . "
        <div id='mainContainer'>
        <div id='titleContainer'><span id='pageTitle'>Add User</span></div>
        <form action='JavaScript:createUser()' id='signUpForm'>
            Name: <input type='text' id='nameEntry' name='nameEntry' class='loginInput' maxlength='100'>
            <br><br>
            Email: <input type='email' id='emailEntry' name='emailEntry' class='loginInput' maxlength='100'>
            <br><br>
            Access Level: <select id='accessEntry' name='accessEntry' class='formSelection'>
                                <option value='1'>1</option>
                                <option value='2'>2</option>
                                <option value='3'>3</option>
                          </select>
            <br><br>
            Username: <input type='text' id='usernameEntry' name='usernameEntry' class='loginInput' maxlength='100'>
            <br><br>
            Password: <input type='password' id='passwordEntry' name='passwordEntry' class='loginInput' maxlength='100'>
            <br><br>
            <input type='submit' name='submitEntry' class='loginSubmit' value='Create User'>
        </form>
        </div>
    </body>
</html>"; //content

        echo $content;
      } else {
        header("Location: users.php?alert=User Access Level 3 Required");
      }
    } else {
        header('Location: ../a.php?alert=Please Log In');
    }
?>
