<?php
    session_start();
    include "dbConnection.php";
    include "htmlcode.php";
    $conn = openConnection();

    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){//check session
      if(isset($_SESSION['userAccess']) && $_SESSION['userAccess']>1){ //check user access
        //check form complete
        if(isset($_GET['id']) && isset($_GET['blogTitle'])  && isset($_GET['blogDescription']) && isset($_GET['blogIntro'])  && isset($_GET['metaTitle'])  && isset($_GET['metaDescription'])  && isset($_GET['metaKeywords'])){
          //length checks
          if(strlen($_GET['id'])>0 && strlen($_GET['blogTitle'])>0 && strlen($_GET['blogDescription'])>0 && strlen($_GET['blogIntro'])>0 && strlen($_GET['metaTitle'])>0 && strlen($_GET['metaDescription'])>0
          && strlen($_GET['metaKeywords'])>0){
            $id = strip_tags(addslashes($_GET['id'])); //get inputs
            $blogTitle = strip_tags(addslashes($_GET['blogTitle']));
            $blogDescription = strip_tags(addslashes($_GET['blogDescription']));
            $blogIntro = strip_tags(addslashes($_GET['blogIntro']));
            $metaTitle = strip_tags(addslashes($_GET['metaTitle']));
            $metaDescription = strip_tags(addslashes($_GET['metaDescription']));
            $metaKeywords = strip_tags(addslashes($_GET['metaKeywords']));
            $navMenu = strip_tags(addslashes($_GET['nm']));
            $footerMenu1 = strip_tags(addslashes($_GET['fm1']));
            $footerMenu2 = strip_tags(addslashes($_GET['fm2']));
            $showInRecent = strip_tags(addslashes($_GET['sir']));
            
            if($showInRecent==='true'){//if show in recent
              $showInRecent = 1;
            } else {
              $showInRecent = 0;
            }

            $menus = [$navMenu, $footerMenu1, $footerMenu2];
            for($i=0;$i<count($menus);$i++){//checking menus exist
              if(strlen($menus[$i])>0){
                $sql = "SELECT * FROM menu WHERE MenuID='".$menus[$i]."'";
                $results = $conn->query($sql) or die($conn->error);
                if(!($results->num_rows>0)){
                  $menus[$i] = "";
                }
              }
            }
            $navMenu = $menus[0]; $footerMenu1 = $menus[1]; $footerMenu2 = $menus[2];
            //set up query
            $sql = "UPDATE blog SET BlogTitle='$blogTitle', BlogIntro='$blogIntro', BlogDescription='$blogDescription', MetaTitle='$metaTitle', MetaDescription='$metaDescription', MetaKeywords='$metaKeywords',
            NavMenu='$navMenu', FooterMenu1='$footerMenu1', FooterMenu2='$footerMenu2', showInRecent='$showInRecent' WHERE BlogID='$id'";

            if($conn -> query($sql)){//query db
                header("Location: blog.php");
            } else {
              echo $conn->error;
            }
          } else { //validation for incomplete form
            header("Location: blog.php?alert=Please Complete the Form");
          }
        } else {
          header("Location: blog.php?alert=Please Complete the Form");
        }
      } else { //validation for unauthorised access
        header("Location: blog.php?alert=User Access Level 2 or Higher Required");
      }
    } else { //validation for no session
        header("Location: ../a.php?alert=Please Log In");
    }
?>
