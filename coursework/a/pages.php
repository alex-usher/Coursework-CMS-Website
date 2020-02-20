<?php
    session_start();
    include "dbConnection.php";
    include "htmlcode.php";
    $conn = openConnection();

    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){ //check session
        $sql = "SELECT * FROM pages";
        $result = $conn -> query($sql) or die("Couldn't get info" . $conn -> error);
        //query db
        $toEcho = "";
        if($result -> num_rows > 0){ //getting info from database
            $count = 1;

            while($row = $result -> fetch_assoc()){
                //create table row for each page
                $toEcho .= "<tr class='tableRow'>
                    <td class='tableData' id='pageID$count.'>".$row['PageID']."</td>
                    <td class='tableData' id='pageName$count'>".$row['PageName']."</td>
                    <td class='tableData'><a href='editPageBasics.php?id=".$row['PageID']."' target='_self' class='tableAnchor' id='Basics$count'>Basic Details</a> | <a href='pageContentManage.php?id=".$row['PageID']."' target='_self' class='tableAnchor' id='Content$count'>Content</a></td>
                    <td class='tableData'><a href='deletePage.php?anchorId=".$row['PageID']."' target='_self' class='tableAnchor' id='Delete$count'>Delete</a></td>
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
            <div id='titleContainer'><span id='pageTitle'>Pages</span></div>
            <div id='userContainer'>
                <table id='usersTable'>
                    <tr class='tableRow'>
                        <th class='tableHeading'>PageID</th>
                        <th class='tableHeading'>Page Name</th>
                        <th class='tableHeading'>Edit Page</th>
                        <th class='tableHeading'>Delete</th>
                    </tr>
                    $toEcho

                </table>
                <div id='anchorContainer'><a class='tableAnchor' href='addPage.php' target='_self'>Add Page</a></div>
            </div>
        </div>
    </body>
</html>";
      //output content
      echo $content;
    } else {
        header('Location: ../a.php?alert=Please Log In');
    }
?>
