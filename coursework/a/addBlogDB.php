<?php
  session_start();
  include "dbConnection.php";
  include "htmlcode.php";
  $conn = openConnection();

  if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){ //check session
    //presence check
    if(isset($_GET['blogTitle']) && isset($_GET['blogIntro']) && isset($_GET['blogDescription']) && isset($_GET['metaTitle']) && isset($_GET['metaDescription']) && isset($_GET['metaKeywords'])){
      //length check
      if(strlen($_GET['blogTitle'])>0 && strlen($_GET['blogIntro'])>0 && strlen($_GET['blogDescription'])>0 && strlen($_GET['metaTitle'])>0 && strlen($_GET['metaDescription'])>0 && strlen($_GET['metaKeywords'])>0){
        if(isset($_SESSION['userAccess']) && $_SESSION['userAccess'] >= 2){ // check user access
          $blogTitle = strip_tags(addslashes($_GET['blogTitle']));//get inputs, validate
          $blogIntro = strip_tags(addslashes($_GET['blogIntro']));
          $blogDescription = strip_tags(addslashes($_GET['blogDescription']));
          $metaTitle = strip_tags(addslashes($_GET['metaTitle']));
          $metaDescription = strip_tags(addslashes($_GET['metaDescription']));
          $metaKeywords = strip_tags(addslashes($_GET['metaKeywords']));
          $navMenu = strip_tags(addslashes($_GET['nm']));
          $footerMenu1 = strip_tags(addslashes($_GET['fm1']));
          $footerMenu2 = strip_tags(addslashes($_GET['fm2']));
          $showInRecent = strip_tags(addslashes($_GET['sir']));

          if($showInRecent==='true'){ //if show in recent
            $showInRecent = 1;
          } else {
            $showInRecent = 0;
          }

          $menus = [$navMenu, $footerMenu1, $footerMenu2]; //all menus as id
          for($i=0;$i<count($menus);$i++){//iterate through array of menus
            if(strlen($menus[$i])>0){//if input not blank
              //search for menu of respective id
              $sql = "SELECT * FROM menu WHERE MenuID='".$menus[$i]."'";
              $results = $conn->query($sql) or die($conn->error);
              if(!($results->num_rows>0)){//if menu doesn't exist
                $menus[$i] = "";//erase value of id
              }
            }
          }
          $navMenu = $menus[0]; $footerMenu1 = $menus[1]; $footerMenu2 = $menus[2];

          //insert into db
          $sql = "INSERT INTO blog(BlogTitle, BlogDescription, BlogIntro, MetaTitle, MetaDescription, MetaKeywords, NavMenu, FooterMenu1, FooterMenu2, showInRecent)
          VALUES('$blogTitle', '$blogDescription', '$blogIntro', '$metaTitle', '$metaDescription', '$metaKeywords', '$navMenu', '$footerMenu1', '$footerMenu2', '$showInRecent')";

          if($conn -> query($sql)){
              header("Location: blog.php");//redirect if successful
          } else {
              echo $conn->error;
          }
        } else {//validation for no access
          header("Location: blog.php?alert=Unauthorised access");
        }
      } else { //Validation for incomplete form
        header("Location: addBlog.php?alert=Please complete the form");
      }
    } else {
      header("Location: addBlog.php?alert=Please complete the form");
    }
  } else {//validation for no session
      header('Location: ../a.php?alert=Please Log In');
  }

?>
