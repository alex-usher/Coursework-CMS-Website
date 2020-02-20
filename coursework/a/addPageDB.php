<?php
  session_start();
  include "dbConnection.php";
  include "htmlcode.php";
  $conn = openConnection();

  if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){//check session
    //checking form complete
    if(isset($_GET['pageName']) && isset($_GET['nameNav']) && isset($_GET['metaTitle']) && isset($_GET['metaDescription']) && isset($_GET['metaKeywords']) && isset($_GET['dblog'])){
      //length checks
      if(strlen($_GET['pageName'])>0 && strlen($_GET['nameNav'])>0 && strlen($_GET['metaTitle'])>0 && strlen($_GET['metaDescription'])>0 && strlen($_GET['metaKeywords'])>0){
        if(isset($_SESSION['userAccess']) && $_SESSION['userAccess'] >= 2){ // check user access
          $pageName = strip_tags(addslashes($_GET['pageName'])); //get user inputs
          $nameNav = strip_tags(addslashes($_GET['nameNav']));
          $metaTitle = strip_tags(addslashes($_GET['metaTitle']));
          $metaDescription = strip_tags(addslashes($_GET['metaDescription']));
          $metaKeywords = strip_tags(addslashes($_GET['metaKeywords']));
          $navMenu = strip_tags(addslashes($_GET['nm']));
          $footerMenu1 = strip_tags(addslashes($_GET['fm1']));
          $footerMenu2 = strip_tags(addslashes($_GET['fm2']));
          $displayBlog = strip_tags(addslashes($_GET['dblog']));
          $index = strip_tags(addslashes($_GET['index']));

          if($index==='true'){//if index
            $index = 1;
            $sql = "SELECT * FROM pages WHERE IsIndex='1'";
            $result = $conn->query($sql) or die($conn->error);
            if($result->num_rows>0){ //checking index page doesn't exist
              $index = 2;
            }
          } else {
            $index = 0;
          }

          if($displayBlog==='true'){ //if display blog
            $displayBlog = 1; //change format of marker
          } else {
            $displayBlog = 0;
          }

          if($index===2){
            header("Location: addPage.php?alert=A home page already exists");
          } else {
            $menus = [$navMenu, $footerMenu1, $footerMenu2];
            for($i=0;$i<count($menus);$i++){ //checking menus exist
              if(strlen($menus[$i])>0){
                $sql = "SELECT * FROM menu WHERE MenuID='".$menus[$i]."'";
                $results = $conn->query($sql) or die($conn->error);
                if(!($results->num_rows>0)){
                  $menus[$i] = "";
                }
              }
            }
            $navMenu = $menus[0]; $footerMenu1 = $menus[1]; $footerMenu2 = $menus[2];

            //insert inputs into database
            $sql = "INSERT INTO pages(PageName, NavName, MetaTitle, MetaDescription, MetaKeywords, NavMenu, FooterMenu1, FooterMenu2, DisplayBlog, IsIndex)
              VALUES('$pageName', '$nameNav', '$metaTitle', '$metaDescription', '$metaKeywords', '$navMenu', '$footerMenu1', '$footerMenu2', '$displayBlog', '$index')";

            if($conn -> query($sql)){
                header("Location: pages.php"); //redirect if successful
            } else {
                echo $conn->error;
            }
          }
        } else {//validation for no access
          header('Location: pages.php?alert=Unauthorised Access');
        }
    } else { //validation for incomplete form
      header("Location: addPage.php?alert=Please complete the form.");
    }
  } else {
    header("Location: addPage.php?alert=Please complete the form.");
  }
} else {//validation for no session
  header('Location: ../a.php?alert=Please Log In');
}
?>
