<?php
    session_start();
    include "dbConnection.php";
    include "htmlcode.php";
    $conn = openConnection();

    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){//check session
      if(isset($_SESSION['userAccess']) && $_SESSION['userAccess'] > 1){ //check user access
        $pageID = $_GET['id']; //get id
        $sql = "SELECT * FROM blog WHERE BlogID='$pageID'"; //query db

        $result = $conn->query($sql) or die("Could't connnect to db");

        if($result -> num_rows > 0){ //get info from db
          while($row = $result -> fetch_assoc()){
            $blogID = $row['BlogID'];
            $blogTitle = $row['BlogTitle'];
            $blogIntro = $row['BlogIntro'];
            $blogDescription = $row['BlogDescription'];
            $metaTitle = $row['MetaTitle'];
            $metaDescription = $row['MetaDescription'];
            $metaKeywords = $row['MetaKeywords'];
            $navMenu = $row['NavMenu'];
            $footerMenu1 = $row['FooterMenu1'];
            $footerMenu2 = $row['FooterMenu2'];
            $showInRecent = "". $row['showInRecent'];
          }
        }


        if($showInRecent==='1'){//if display in recent marker activated
          $showInRecent = "checked='checked'";
        } else {
          $showInRecent = '';
        }


        //full page content
        $content="<html>
          $head
          <body>
            $nav
            <div id='mainContainer'>
              <div id='headingContainer'><span id='pageTitle'>Blog Basics</span></div>
                <form action='JavaScript:editBlog()' id='pagesForm'>
                    <table id='pagesTable'>
                      <tr>
                        <th>BlogID</th>
                        <td id='blogId'>$blogID</td>
                      </tr>
                      <tr>
                          <th>Blog Title</th>
                          <td><input type='text' value='$blogTitle' id='blogTitle' name='blogTitle' maxlength='60'></td>
                      </tr>
                      <tr>
                          <th>Blog Introduction<p>Maximum Length: 200 characters.</p></th>
                          <td><textarea rows='3' cols='50' name='blogIntro' id='blogIntro' form='pagesForm' maxlength='200'>$blogIntro</textarea></td>
                      </tr>
                      <tr>
                          <th>Blog Description<p>Maximum Length: 200 characters.</p></th>
                          <td><textarea rows='3' cols='50' name='blogDescription' id='blogDescription' form='pagesForm' maxlength='200'>$blogDescription</textarea></td>
                      </tr>
                      <tr>
                          <th>Meta Title<p>Maximum Length: 60 characters.</p></th>
                          <td><textarea rows='3' cols='50' name='metaTitle' id='metaTitle' form='pagesForm' maxlength='60'>$metaTitle</textarea></td>
                      </tr>
                      <tr>
                          <th>Meta Description<p>Maximum Length: 150 characters.</p></th>
                          <td><textarea rows='3' cols='50' name='metaDescription' id='metaDescription' form='pagesForm' maxlength='150'>$metaDescription</textarea></td>
                      </tr>
                      <tr>
                          <th>Meta Keywords<p>Maximum Length: 150 characters.</p></th>
                          <td><textarea rows='3' cols='50' name='metaKeywords' id='metaKeywords' form='pagesForm' maxlength='150'>$metaKeywords</textarea></td>
                      </tr>
                      <tr>
                          <th>Nav Menu<p>Leave blank for no navigation</p></th>
                          <td><input type='number' value='$navMenu' id='navMenu' maxlength='10'></td>
                      </tr>
                      <tr>
                          <th>Footer Menu 1<p>Leave blank for no navigation</p></th>
                          <td><input type='number' value='$footerMenu1' id='footerMenu1' maxlength='10'></td>
                      </tr>
                      <tr>
                          <th>Footer Menu 2<p>Leave blank for no navigation</p></th>
                          <td><input type='number' value='$footerMenu2' id='footerMenu2' maxlength='10'></td>
                      </tr>
                      <tr>
                          <th>Show in Recent Blogs<p>Blog will be included in list of most recent blogs</p></th>
                          <td><input type='checkbox' id='showInRecent' $showInRecent></td>
                      </tr>
                    </table>
                  <input type='submit' name='submitEntry' class='loginSubmit' value='Submit'>
                </form>
            </div>
        </body>
        </html>";

        echo $content; //output content
      }
    } else {
        header('Location: ../a.php?alert=Please Log In');
    }

?>
