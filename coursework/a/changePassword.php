<?php
    session_start();
    include "dbConnection.php";
    include "htmlcode.php";
    $conn = openConnection();

    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){//check session
        $content="<html>
    $head
    <body>
        $nav
        <div id='mainContainer'>
        <div id='titleContainer'><span id='pageTitle'>Change Password</span></div>
        <form id='editUserForm' action='changePasswordDB.php'>
            <table id='usersTable'>
                <tr class='tableRow'>
                    <th class='tableHeading'>Current Password</th>
                    <th class='tableHeading'>New Password</th>
                    <th class='tableHeading'>Check Password</th>
                </tr>
                <tr class='tableRow'>
                    <td class='tableData'><input class='formInput' name='current' value='' type='password'></td>
                    <td class='tableData'><input class='formInput' name='new' value='' type='password'></td>
                    <td class='tableData'><input class='formInput' name='check' value='' type='password'></td>
                </tr>
            </table>
            <input type='submit' name='submitEntry' class='loginSubmit' value='Submit'>
        </form>
        </div>
    </body>
</html>";//content

        echo $content;
    } else {
        header('Location: ../a.php?alert=Please Log In');
    }
?>
