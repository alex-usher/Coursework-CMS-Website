<?php
    session_start();
    include "dbConnection.php";
    include "htmlcode.php";
    $conn = openConnection();

    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){//check session
      if(isset($_SESSION['userAccess']) && $_SESSION['userAccess'] >= 2){//check user access

    $content="<html>
    $head
    <body>
        $nav
        <div id='mainContainer'>
            <div id='headingContainer'><span id='pageTitle'>Create Blog</span></div>
            <form action='JavaScript:addBlog()' id='pagesForm'>
                <table id='pagesTable'>
                    <tr>
                        <th>Blog Title</th>
                        <td><input type='text' value='' id='blogTitle' name='blogTitle' maxlength='30'></td>
                    </tr>
                    <tr>
                        <th>Blog Introduction<p>Maximum Length: 150 characters.</p></th>
                        <td><textarea rows='3' cols='50' name='blogIntro' id='blogIntro' form='pagesForm' maxlength='150'></textarea></td>
                    </tr>
                    <tr>
                        <th>Blog Description<p>Maximum Length: 150 characters.</p></th>
                        <td><textarea rows='3' cols='50' name='blogDescription' id='blogDescription' form='pagesForm' maxlength='150'></textarea></td>
                    </tr>
                    <tr>
                        <th>Meta Title<p>Maximum Length: 60 characters.</p></th>
                        <td><textarea rows='3' cols='50' name='metaTitle' id='metaTitle' form='pagesForm' maxlength='60'></textarea></td>
                    </tr>
                    <tr>
                        <th>Meta Description<p>Maximum Length: 150 characters.</p></th>
                        <td><textarea rows='3' cols='50' name='metaDescription' id='metaDescription' form='pagesForm' maxlength='150'></textarea></td>
                    </tr>
                    <tr>
                        <th>Meta Keywords<p>Maximum Length: 150 characters.</p></th>
                        <td><textarea rows='3' cols='50' name='metaKeywords' id='metaKeywords' form='pagesForm' maxlength='150'></textarea></td>
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
                        <th>Show in Recent Blogs<p>Blog will be included in list of most recent blogs</p></th>
                        <td><input type='checkbox' id='showInRecent'></td>
                    </tr>
                </table>
                <input type='submit' name='submitEntry' class='loginSubmit' value='Submit'>
            </form>
        </div>
    </body>
</html>";

    echo $content;

  } else {
    header("Location: blog.php?alert=User Access Level 2 Required");
  }
} else {
  header('Location: ../a.php?alert=Please Log In');
}

?>
