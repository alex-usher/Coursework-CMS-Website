<?php
    session_start();
    include "dbConnection.php";
    include "htmlcode.php";
    $conn = openConnection();

    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){ //check for session
        $sql = "SELECT * FROM blog";
        //query db
        $result = $conn -> query($sql) or die("Couldn't connect to database");
        $toEcho = "";

        if($result -> num_rows > 0){ //get information from database
            $count = 1;
            while($row = $result -> fetch_assoc()){ //creating table row for each blog post
                 $toEcho .= "<tr class='tableRow'>
                    <td class='tableData' id='blogID$count.'>".$row['BlogID']."</td>
                    <td class='tableData' id='blogTitle$count'>".$row['BlogTitle']."</td>
                    <td class='tableData'><a href='editBlogBasics.php?id=".$row['BlogID']."' target='_self' class='tableAnchor' id='Basics$count'>Basic Details</a> | <a href='blogContentManage.php?id=".$row['BlogID']."' target='_self' class='tableAnchor' id='Content$count'>Content</a></td>
                    <td class='tableData'><a href='deleteBlog.php?anchorId=".$row['BlogID']."' target='_self' class='tableAnchor' id='Delete$count'>Delete</a></td>
                </tr>";
                $count++;
            }
        }
        //complete content
        $content = "<html>
    $head
    <body>
        $nav
        <div id='mainContainer'>
            <div id='titleContainer'><span id='pageTitle'>Blog Posts</span></div>
            <div id='userContainer'>
                <table id='usersTable'>
                    <tr class='tableRow'>
                        <th class='tableHeading'>BlogID</th>
                        <th class='tableHeading'>Blog Title</th>
                        <th class='tableHeading'>Edit Blog</th>
                        <th class='tableHeading'>Delete</th>
                    </tr>
                    $toEcho

                </table>
                <div id='anchorContainer'><a class='tableAnchor' href='addBlog.php' target='_self'>Create Blog</a></div>
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
