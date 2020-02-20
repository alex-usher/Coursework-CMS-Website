<?php
include "dbConnection.php";
include "checkKey.php";
$conn = openConnection();
$key = strip_tags(addslashes($_GET['key']));

if(checkKey($key, $conn)){//check session
  if(isset($_GET['id']) && isset($_GET['name']) && isset($_GET['navName']) && isset($_GET['title'])
   && isset($_GET['description']) && isset($_GET['keywords'])){ //presence check
     if(strlen($_GET['name'])>0 && strlen($_GET['navName'])>0 && strlen($_GET['title'])>0
      && strlen($_GET['description'])>0 && strlen($_GET['keywords'])>0){//length check
        $id = strip_tags(addslashes($_GET['id']));//get inputs
        $name = strip_tags(addslashes($_GET['name']));
        $navName = strip_tags(addslashes($_GET['navName']));
        $title = strip_tags(addslashes($_GET['title']));
        $description = strip_tags(addslashes($_GET['description']));
        $keywords = strip_tags(addslashes($_GET['keywords']));
        $navMenu = strip_tags(addslashes($_GET['nm']));
        $footerMenu1 = strip_tags(addslashes($_GET['fm1']));
        $footerMenu2 = strip_tags(addslashes($_GET['fm2']));
        $displayBlog = strip_tags(addslashes($_GET['dblog']));
        $isIndex = strip_tags(addslashes($_GET['index']));

        $menus = [$navMenu, $footerMenu1, $footerMenu2];
        for($i=0;$i<count($menus);$i++){//check menu exists
          if(strlen($menus[$i])>0){
            $sql = "SELECT * FROM menu WHERE MenuID='".$menus[$i]."'";
            $results = $conn->query($sql) or die($conn->error);
            if(!($results->num_rows>0)){
              $menus[$i] = "";
            }
          }
        }
        $navMenu = $menus[0]; $footerMenu1 = $menus[1]; $footerMenu2 = $menus[2];

        $indexExists = false;
        if($isIndex==='1'){//checking no other index page exists
          $sql = "SELECT * FROM pages WHERE IsIndex='1'";
          $result = $conn->query($sql) or die($conn->error);
          if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
              if(!($row['PageID']===$id)){
                $indexExists = true;
              }
            }
          }
        }

        if(!($indexExists)){
          if(strlen($title)>60){//length checks
            echo "Title too long";
          } else if(strlen($description)>150){
            echo "Description too long";
          } else if(strlen($keywords)>150){
            echo "Keywords too long";
          } else if(strlen($navName)>20){
            echo "Nav name too long";
          } else if(strlen($name)>60){
            echo "Name too long";
          } else {
            $sql = "UPDATE pages SET PageName='$name', NavName='$navName', MetaTitle='$title',
            MetaDescription='$description', MetaKeywords='$keywords', NavMenu='$navMenu', FooterMenu1='$footerMenu1',
            FooterMenu2='$footerMenu2', DisplayBlog='$displayBlog', IsIndex='$isIndex' WHERE PageID='$id'";//update db

            if($conn->query($sql)){
              echo "Success";
            } else {
              echo "Couldn't update";
            }
          }
        } else {
          echo "A home page already exists.";
        }
      } else {
        echo "Please complete the form";
      }
    } else {
      echo "Please complete the form";
    }
}

closeConnection($conn);
 ?>
