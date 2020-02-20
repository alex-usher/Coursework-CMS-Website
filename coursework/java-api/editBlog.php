<?php
include "dbConnection.php";
include "checkKey.php";
$conn=openConnection();
$key = strip_tags(addslashes($_GET['key']));

if(checkKey($key,$conn)){//check session
  if(isset($_GET['id']) && isset($_GET['name']) && isset($_GET['desc'])
   && isset($_GET['intro']) && isset($_GET['title']) && isset($_GET['description']) && isset($_GET['keywords'])){ //presence check
     if(strlen($_GET['name'])>0 && strlen($_GET['desc'])>0 && strlen($_GET['intro'])>0
      && strlen($_GET['title'])>0 && strlen($_GET['description'])>0 && strlen($_GET['keywords'])>0){//length check
        $id = strip_tags(addslashes($_GET['id']));//get inputs
        $title = strip_tags(addslashes($_GET['name']));
        $description = strip_tags(addslashes($_GET['desc']));
        $intro = strip_tags(addslashes($_GET['intro']));
        $metaTitle = strip_tags(addslashes($_GET['title']));
        $metaDescription = strip_tags(addslashes($_GET['description']));
        $metaKeywords = strip_tags(addslashes($_GET['keywords']));
        $navMenu = strip_tags(addslashes($_GET['nm']));
        $footerMenu1 = strip_tags(addslashes($_GET['fm1']));
        $footerMenu2 = strip_tags(addslashes($_GET['fm2']));
        $showInRecent = strip_tags(addslashes($_GET['sir']));

        $menus = [$navMenu, $footerMenu1, $footerMenu2];
        for($i=0;$i<count($menus);$i++){ //check menu exists
          if(strlen($menus[$i])>0){
            $sql = "SELECT * FROM menu WHERE MenuID='".$menus[$i]."'";
            $results = $conn->query($sql) or die($conn->error);
            if(!($results->num_rows>0)){
              $menus[$i] = "";
            }
          }
        }
        $navMenu = $menus[0]; $footerMenu1 = $menus[1]; $footerMenu2 = $menus[2];

        if(strlen($title)>60){ //length checks
          echo "Title is too long";
        } else if(strlen($metaTitle)>60){
          echo "Meta Title is too long";
        } else if(strlen($metaDescription)>150){
          echo "Meta Description is too long";
        } else if(strlen($metaKeywords)>150){
          echo "Meta Keywords is too long";
        } else {
          $sql = "UPDATE blog SET BlogTitle='$title', BlogIntro='$intro', BlogDescription='$description', MetaTitle='$metaTitle',
                      MetaDescription='$metaDescription', MetaKeywords='$metaKeywords', NavMenu='$navMenu', FooterMenu1='$footerMenu1',
                      FooterMenu2='$footerMenu2', showInRecent='$showInRecent' WHERE BlogID='$id'";//update db
          if($conn->query($sql)){
            echo "Success";
          } else {
            echo $conn -> error;
          }
        }
      } else {
        echo "Please complete the form";
      }
   } else {
     echo "Please complete the form";
   }
}
?>
