<?php
    session_start();
    include "dbConnection.php";
    include "htmlcode.php";
    $conn = openConnection();

    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){
      //get account info
        $sql = "SELECT * FROM users WHERE Username='".$_SESSION['username']."'";
        $result = $conn->query($sql) or die("Couldn't connect to db");
        //query db
        while($row = $result -> fetch_assoc()){
            $userID = $row['UserID'];//assign info to variabless
            $email = $row['Email'];
        }
        //create content
        $content = "<html>".$head."<body>".$nav."<div id='mainContainer'><div id='headingContainer'><span id='pageTitle'>Account</span></div><div id='userContainer'>
                    <table id='usersTable'>
                        <tr class='tableRow'>
                            <th class='tableHeading'>User ID</th>
                            <th class='tableHeading'>Name</th>
                            <th class='tableHeading'>Username</th>
                            <th class='tableHeading'>Email</th>
                            <th class='tableHeading'>User Access</th>
                        </tr>
                        <tr class='tableRow'>
                            <td class='tableData'>$userID</td>
                            <td class='tableData'>".$_SESSION['name']."</td>
                            <td class='tableData'>".$_SESSION['username']."</td>
                            <td class='tableData'>$email</td>
                            <td class='tableData'>".$_SESSION['userAccess']."</td></tr>
                    </table>
            <div id='anchorContainer'><a class='tableAnchor' href='editAccount.php' target='_self'>Edit Account</a></div>
        </div></div></body></html>";

        echo $content;
    } else {
        header('Location: ../a.php?alert=Please Log In');
    }
?>
