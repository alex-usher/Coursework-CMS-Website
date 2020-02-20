<?php
session_start();
include "dbConnection.php";
include "htmlcode.php";
$conn = openConnection();

if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){ //check session
  if(isset($_SESSION['userAccess']) && $_SESSION['userAccess']>1){//check user access
    $menuID = addslashes(strip_tags($_GET['menuID'])); //getting form inputs
    $menuName= strip_tags(addslashes($_GET['menuName']));
    $menuString = "";
    $menuPos1 = strip_tags(addslashes($_GET['menuPos1']));
    $menuPos2 = strip_tags(addslashes($_GET['menuPos2']));
    $menuPos3 = strip_tags(addslashes($_GET['menuPos3']));
    $menuPos4 = strip_tags(addslashes($_GET['menuPos4']));
    $menuPos5 = strip_tags(addslashes($_GET['menuPos5']));
    $menuPos6 = strip_tags(addslashes($_GET['menuPos6']));

    $menu = array($menuPos1, $menuPos2, $menuPos3, $menuPos4, $menuPos5, $menuPos6); //forming an array of menu items
    $menuString = "";

    for($i=0;$i<count($menu);$i++){
      $PageID = $menu[$i];
      $sql = "SELECT PageName from pages WHERE PageID='$PageID'"; //validating a page exists by querying DB using the PageID
      $result = $conn -> query($sql) or die($conn->error);
      if(!($result -> num_rows > 0)){
        $menu[$i] = ""; //removing menu elements where the page did not exist
      }
    }

    for($i=0;$i<count($menu);$i++){
        $PageID = $menu[$i];

        if($PageID === ""){ //removing invalid pages
          unset($menu[$i]);
        }
    }

    for($j=0;$j<count($menu);$j++){ //checking that there are no duplicate pages.
      if($j===$i){
        continue;
      } else {
        if($menu[$i]===$menu[$j]){ //if duplicate, redirect
          header("Location: editMenu.php?id=$menuID&alert=Pages cannot occur more than once.");
        }
      }
    }

    $menuString = implode(" ", $menu); //convert menu to string for DB

    $sql = "UPDATE menu SET MenuName='$menuName', MenuContents='$menuString' WHERE MenuID='$menuID'"; //SQL to update table

    if($conn -> query($sql)){
      header("Location: menu.php");
    } else {
      echo $conn -> error;
    }
  } else {
    header("Location: menu.php?alert=User Access Level 2 or Higher Required");
  }
} else {
  header('Location: ../a.php?alert=Please Log In');
}
 ?>
