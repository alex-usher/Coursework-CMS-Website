<?php
    session_start();
    include "dbConnection.php";
    include "htmlcode.php";
    $conn = openConnection();

    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){ //check session
      if(isset($_SESSION['userAccess']) && $_SESSION['userAccess'] > 1){ //check user access
        $pageID = strip_tags(addslashes($_GET['id'])); //get id
        $sql = "SELECT * FROM pages WHERE PageID='$pageID'";

        $result = $conn->query($sql) or die("Could't connnect to db"); //query db

        if($result -> num_rows > 0){ //get info from db
          while($row = $result -> fetch_assoc()){
            $pageName = $row['PageName'];
            $navName = $row['NavName'];
            $metaTitle = $row['MetaTitle'];
            $metaDescription = $row['MetaDescription'];
            $metaKeywords = $row['MetaKeywords'];
            $navMenu = $row['NavMenu'];
            $footerMenu1 = $row['FooterMenu1'];
            $footerMenu2 = $row['FooterMenu2'];
            $displayBlog = "". $row['DisplayBlog'];
            $index = "" . $row['IsIndex'];
          }
        }

        if($displayBlog==='1'){
          $displayBlog = "checked='checked'";
        } else {
          $displayBlog = '';
        }

        if($index==='1'){
          $index = "checked='checked'";
        } else {
          $index = '';
        }

      //full page content
      $content="<html>
      $head
      <body>
          $nav
          <div id='mainContainer'>
              <div id='headingContainer'><span id='pageTitle'>Page Basics</span></div>
              <form action='JavaScript:editPage()' id='pagesForm'>
                  <table id='pagesTable'>
                      <tr>
                          <th>PageID</th>
                          <td id='pageID'>$pageID</td>
                      </tr>
                      <tr>
                          <th>Page Name<p>This will be the title of the page</p></th>
                          <td><input type='text' value='$pageName' id='pageName' name='pageName' maxlength='50'></td>
                      </tr>
                      <tr>
                          <th>Name in Navigation<p>Maximum Length: 20 characters.</p></th>
                          <td><textarea rows='3' cols='50' name='nameNav' id='nameNav' form='pagesForm' maxlength='20'>$navName</textarea></td>
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
                          <th>Display Blogs</th>
                          <td><input type='checkbox' id='displayBlog' $displayBlog></td>
                      </tr>
                      <tr>
                          <th>Home Page<p>N.B. There can only be one index page</p></th>
                          <td><input type='checkbox' $index id='index'></td>
                      </tr>
                  </table>
                  <input type='submit' name='submitEntry' class='loginSubmit' value='Submit'>
              </form>
          </div>
      </body>
  </html>";

      echo $content; //output content
      } else {
        header("Location: pages.php?alert=User Access Level 2 or Higher Required");
      }
    } else {
        header('Location: ../a.php?alert=Please Log In');
    }

?>
