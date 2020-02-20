<?php
    session_start();
    include "dbConnection.php";
    include "htmlcode.php";
    $conn = openConnection();

    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){ //check session
      if(isset($_SESSION['userAccess']) && $_SESSION['userAccess']>1){ //check user access
        //check form complete
        if(isset($_GET['id']) && isset($_GET['pageName']) && isset($_GET['nameNav']) && isset($_GET['metaTitle']) && isset($_GET['metaDescription']) && isset($_GET['metaKeywords'])){
          //length checks
          if(strlen($_GET['id'])>0 && strlen($_GET['pageName'])>0 && strlen($_GET['nameNav'])>0 && strlen($_GET['metaTitle'])>0 && strlen($_GET['metaDescription'])>0 && strlen($_GET['metaKeywords'])>0){
            $id = strip_tags(addslashes($_GET['id'])); //get inputs
            $pageName = strip_tags(addslashes($_GET['pageName']));
            $nameNav = strip_tags(addslashes($_GET['nameNav']));
            $metaTitle = strip_tags(addslashes($_GET['metaTitle']));
            $metaDescription = strip_tags(addslashes($_GET['metaDescription']));
            $metaKeywords = strip_tags(addslashes($_GET['metaKeywords']));
            $navMenu = strip_tags(addslashes($_GET['nm']));
            $footerMenu1 = strip_tags(addslashes($_GET['fm1']));
            $footerMenu2 = strip_tags(addslashes($_GET['fm2']));
            $displayBlog = strip_tags(addslashes($_GET['dblog']));
            $index = strip_tags(addslashes($_GET['index']));

            if($displayBlog==='true'){
              $displayBlog = 1;
            } else {
              $displayBlog = 0;
            }

            if($index==='true'){
               $index=1;
               $sql = "SELECT * FROM pages WHERE IsIndex='1'";
               $result = $conn->query($sql) or die($conn->error);
               if(($result->num_rows)>0){
                 while($row=$result->fetch_assoc()){
                   if($row['PageID']===$id){

                   } else {
                     $index=2;
                   }
                 }
               } else {
               }
            } else {
              $index=0;
            }

            if($index===2){
              header("Location: editPageBasics.php?id=$id&alert=A home page already exists");
            } else {

              $menus = [$navMenu, $footerMenu1, $footerMenu2];
              for($i=0;$i<count($menus);$i++){
                if(strlen($menus[$i])>0){
                  $sql = "SELECT * FROM menu WHERE MenuID=".$menus[$i];
                  $results = $conn->query($sql) or die($conn->error);
                  if(!($results->num_rows>0)){
                    $menus[$i] = "";
                  }
                }
              }
              $navMenu = $menus[0]; $footerMenu1 = $menus[1]; $footerMenu2 = $menus[2];
              //set up query
              $sql = "UPDATE pages SET PageName='$pageName', NavName='$nameNav', MetaTitle='$metaTitle', MetaDescription='$metaDescription', MetaKeywords='$metaKeywords',
                NavMenu='$navMenu', FooterMenu1='$footerMenu1', FooterMenu2='$footerMenu2', DisplayBlog='$displayBlog', IsIndex='$index' WHERE PageID='$id'";

                if($conn -> query($sql)){//query db
                  header("Location: pages.php");
                } else {
                  echo $conn->error;
                }
            }
          } else { //validation for incomplete form
            header("Location: pages.php?alert=Please complete the form");
          }
        } else {
          header("Location: pages.php?alert=Please Complete the Form");
        }
      } else { //validation for unauthorised access
        header("Location: pages.php?alert=User Access Level 2 or Higher Required");
      }
    } else { //validation for no session
        header('Location: ../a.php?alert=Please Log In');
    }
?>
