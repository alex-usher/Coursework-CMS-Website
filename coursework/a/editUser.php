<?php
    session_start();

    include "dbConnection.php";
    include "htmlcode.php";
    $conn = openConnection();

    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){//check session
        if(isset($_SESSION['userAccess']) && $_SESSION['userAccess'] == 3){//check user access

            $userID = strip_tags(addslashes($_GET['id']));//get id
            $sql = "SELECT * FROM users";//query db
            $result =  $conn -> query($sql) or die("Couldn't get info" . $conn -> error);

            if($result -> num_rows > 0){
              while($row = $result -> fetch_assoc()){
                  if($row['UserID'] == $userID){
                      $toEcho = "<tr class='tableRow'>
                            <td class='tableData' id='UserID'>$userID</td>
                            <td class='tableData' id='Name'><input class='formInput' type='text' id='NameInput' value='".$row['Name']."' maxlength='100'></td>
                            <td class='tableData' id='Username'><input class='formInput' type='text' id='UsernameInput' value='".$row['Username']."' maxlength='100'></td>
                            <td class='tableData' id='Email'><input class='formInput' type='email' id='EmailInput' value='".$row['Email']."' maxlength='100'></td>
                            <td class='tableData' id='UserAccess'><select name='accessEntry' class='formSelection' id='AccessEntry'>
                                <option value='1'>1</option>
                                <option value='2'>2</option>
                                <option value='3'>3</option>
                          </select></td>
                            <td class='tableData'><a href='resetPassword.php?id=$userID' target='_self' class='tableAnchor' id='reset'>Reset Password</a></td>
                        </tr>";//query db 
                  }
                }
            } else {
                $toEcho = "<p>User not found</p>";
            }

           $content = "<html>
    ".$head."
    <body>
        ".$nav."
            <div id='mainContainer'>
        <div id='titleContainer'><span id='pageTitle'>Edit User</span></div>
          <div id='userContainer'>
                <form action='JavaScript:editUser()' id='editUserForm'>
                    <table id='usersTable'>
                        <tr class='tableRow'>
                            <th class='tableHeading'>User ID</th>
                            <th class='tableHeading'>Name</th>
                            <th class='tableHeading'>Username</th>
                            <th class='tableHeading'>Email</th>
                            <th class='tableHeading'>User Access</th>
                            <th class='tableHeading'>Reset Password</th>
                        </tr>
                    ".$toEcho."
                        </table>
                    <input type='submit' name='submitEntry' class='loginSubmit' value='Edit User'>
                </form>
            </div>
</div>
</html>";

           echo $content;
        } else {
            header("Location: users.php?alert=User Access Level 3 Required");
        }
    } else {
        header('Location: ../a.php?alert=Please Log In');
    }
?>
