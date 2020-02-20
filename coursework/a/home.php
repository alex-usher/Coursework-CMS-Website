<?php
    session_start();
    include "dbConnection.php";
    include "htmlcode.php";
    $conn = openConnection();

    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){//check session
        $content = "<html>".$head."<body>".$nav."<div id='mainContainer'><div id='headingContainer'><span id='pageTitle'>Home</span></div><div id='userContainer'>
                    <table id='usersTable'>
                        <tr class='tableRow'>
                            <th class='tableHeading'>Name</th>
                            <th class='tableHeading'>Username</th>
                            <th class='tableHeading'>User Access</th>
                        </tr>
                        <tr class='tableRow'>
                            <td class='tableData'>".$_SESSION['name']."</td>
                            <td class='tableData'>".$_SESSION['username']."</td>
                            <td class='tableData'>".$_SESSION['userAccess']."</td></tr>
                    </table>
        </div></div></body></html>";//content

        echo $content;
    } else {
        header('Location: ../a.php?alert=Please Log In');
    }
?>
