<?php
    session_start();
    include "dbConnection.php";
    include "htmlcode.php";
    $conn = openConnection();

    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){//check session
      if(isset($_SESSION['userAccess']) && $_SESSION['userAccess'] >= 2){ //check user access

         $content="<html>
    $head
    <body>
        $nav
        <div id='mainContainer'>
            <div id='headingContainer'><span id='pageTitle'>Page Basics</span></div>
            <form action='JavaScript:addPage()' id='pagesForm'>
                <table id='pagesTable'>
                    <tr>
                        <th>Page Name</th>
                        <td><input type='text' value='' id='pageName' maxlength='30'></td>
                    </tr>
                    <tr>
                        <th>Name in Navigation<p>Maximum Length: 20 characters.</p></th>
                        <td><textarea rows='3' cols='50' id='nameNav' form='pagesForm' maxlength='20'></textarea></td>
                    </tr>
                    <tr>
                        <th>Meta Title<p>Maximum Length: 60 characters.</p></th>
                        <td><textarea rows='3' cols='50' id='metaTitle' form='pagesForm' maxlength='60'></textarea></td>
                    </tr>
                    <tr>
                        <th>Meta Description<p>Maximum Length: 150 characters.</p></th>
                        <td><textarea rows='3' cols='50' id='metaDescription' form='pagesForm' maxlength='150'></textarea></td>
                    </tr>
                    <tr>
                        <th>Meta Keywords<p>Maximum Length: 150 characters.</p></th>
                        <td><textarea rows='3' cols='50' id='metaKeywords' form='pagesForm' maxlength='150'></textarea></td>
                    </tr>
                    <tr>
                        <th>Nav Menu<p>Leave blank for no navigation</p></th>
                        <td><input type='number' value='' id='navMenu' maxlength='10'></td>
                    </tr>
                    <tr>
                        <th>Footer Menu 1<p>Leave blank for no navigation</p></th>
                        <td><input type='number' value='' id='footerMenu1' maxlength='10'></td>
                    </tr>
                    <tr>
                        <th>Footer Menu 2<p>Leave blank for no navigation</p></th>
                        <td><input type='number' value='' id='footerMenu2' maxlength='10'></td>
                    </tr>
                    <tr>
                        <th>Display Blogs</th>
                        <td><input type='checkbox' id='displayBlog'></td>
                    </tr>
                    <tr>
                        <th>Home Page<p>N.B. There can only be one index page</p></th>
                        <td><input type='checkbox' id='index'></td>
                    </tr>
                </table>
                <input type='submit' name='submitEntry' class='loginSubmit' value='Submit'>
            </form>
        </div>
    </body>
</html>"; //content

    echo $content;
  } else {
    header("Location: pages.php?alert=User Access Level 2 required");
  }
    } else {
        header('Location: ../a.php?alert=Please Log In');
    }
?>
