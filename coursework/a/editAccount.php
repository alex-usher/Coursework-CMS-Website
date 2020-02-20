<?php
    session_start();
    include "dbConnection.php";
    include "htmlcode.php";
    $conn = openConnection();

    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){//check session
        $sql = "SELECT * FROM users WHERE Username='".$_SESSION['username']."'";
        $result = $conn->query($sql) or die("Couldn't connect to db");//query db

        while($row = $result -> fetch_assoc()){
            $userID = $row['UserID'];//get info
            $email = $row['Email'];
        }

        $toEcho = "<tr class='tableRow'>
                            <td class='tableData' id='UserID'>$userID</td>
                            <td class='tableData' id='Name'><input class='formInput' type='text' id='NameInput' value='".$_SESSION['name']."'></td>
                            <td class='tableData' id='Username'><input class='formInput' type='text' id='UsernameInput' value='".$_SESSION['username']."'></td>
                            <td class='tableData' id='Email'><input class='formInput' type='text' id='EmailInput' value='$email'></td>
                            <td class='tableData' id='UserAccess'>".$_SESSION['userAccess']."</td>
                            <td class='tableData'><a href='changePassword.php' target='_self' class='tableAnchor' id='changePassword'>Change Password</a></td>
                        </tr>";//generate content

        $content = "<html>
    $head
    <body>
        $nav
            <div id='mainContainer'>
        <div id='titleContainer'><span id='pageTitle'>Edit Account</span></div>
          <div id='userContainer'>
                <form action='' id='editUserForm'>
                    <table id='usersTable'>
                        <tr class='tableRow'>
                            <th class='tableHeading'>User ID</th>
                            <th class='tableHeading'>Name</th>
                            <th class='tableHeading'>Username</th>
                            <th class='tableHeading'>Email</th>
                            <th class='tableHeading'>User Access</th>
                            <th class='tableHeading'>Change Password</th>
                        </tr>
                            $toEcho
                        </table>
                    <button onclick='editAccount()' type='button' class='formSubmit' id='formSubmit'>Submit</button>
                </form>
            </div>
</div>
</html>";

        echo $content;
    } else {
        header('Location: ../a.php?alert=Please Log In');
    }
?>
