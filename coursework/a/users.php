<?php
    session_start();
    include "dbConnection.php";
    include "htmlcode.php";
    $conn = openConnection(); // connect to database

    $pageTitle = 'Manage Users';
    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){ //checks for session
        $sql = "SELECT * FROM users"; //getting users from database
        $result = $conn -> query($sql) or die("Couldn't get info" . $conn -> error);

        $toEcho = "";
        if($result -> num_rows > 0){
            $count = 1;
            while($row = $result -> fetch_assoc()){ //creating table of users
                $toEcho .= "<tr class='tableRow'>
                            <td class='tableData' id='Name".$count."'>".$row['Name']."</td>
                            <td class='tableData' id='Username".$count."'>".$row['Username']."</td>
                            <td class='tableData' id='Email".$count."'>".$row['Email']."</td>
                            <td class='tableData' id='UserAccess".$count."'>".$row['UserAccess']."</td>
                            <td class='tableData'><a href='editUser.php?id=".$row['UserID']."' target='_self' class='tableAnchor' id='Edit".$count."'>Edit</a></td>
                            <td class='tableData'><a href='deleteUser.php?id=".$row['UserID']."' target='_self' class='tableAnchor' id='Delete".$count."'>Delete</a></td>
                     </tr>";
                $count++;
            }
        }
        //all content
        $content = "<html>
    $head
    <body>
        $nav
        <div id='mainContainer'>
            <div id='titleContainer'><span id='pageTitle'>$pageTitle</span></div>
            <div id='userContainer'>
                <table id='usersTable'>
                    <tr class='tableRow'>
                        <th class='tableHeading'>Name</th>
                        <th class='tableHeading'>Username</th>
                        <th class='tableHeading'>Email</th>
                        <th class='tableHeading'>User Access</th>
                        <th class='tableHeading'>Edit</th>
                        <th class='tableHeading'>Delete</th>
                    </tr>
                    $toEcho

                </table>
                <div id='anchorContainer'><a class='tableAnchor' href='addUser.php' target='_self'>Add User</a></div>
            </div>
        </div>
    </body>
</html>";

        echo $content; //output content
    } else {
        header('Location: ../a.php?alert=Please Log In');
    }

?>
