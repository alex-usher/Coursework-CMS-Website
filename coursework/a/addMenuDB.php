<?php
session_start();
include "dbConnection.php";
include "htmlcode.php";
$conn = openConnection();

if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){
  if(isset($_SESSION['userAccess']) && $_SESSION['userAccess'] >=2){
    $menuName= strip_tags(addslashes($_GET['menuName'])); //getting form variables
    $menuString = "";
    $menuPos1 = strip_tags(addslashes($_GET['menuPos1']));
    $menuPos2 = strip_tags(addslashes($_GET['menuPos2']));
    $menuPos3 = strip_tags(addslashes($_GET['menuPos3']));
    $menuPos4 = strip_tags(addslashes( $_GET['menuPos4']));
    $menuPos5 = strip_tags(addslashes($_GET['menuPos5']));
    $menuPos6 = strip_tags(addslashes($_GET['menuPos6']));

    $menu = array($menuPos1, $menuPos2, $menuPos3, $menuPos4, $menuPos5, $menuPos6); //forming an array of menu items

    for($i=0;$i<count($menu);$i++){
      $PageID = $menu[$i];
      if($PageID != ""){
        $sql = "SELECT PageName from pages WHERE PageID='$PageID'"; //validating a page exists by querying DB using the PageID
        $result = $conn -> query($sql);
        if(!($result -> num_rows > 0)){ //if page doesn't exist
          unset($menu[$i]);
        }
      } else {
        unset($menu[$i]); //removing null elements
      }
    }
    $menuString = implode(" ", $menu);

    $sql = "INSERT INTO menu(MenuName, MenuContents) VALUES('$menuName', '$menuString')"; //SQL to insert values into DB

    if($conn -> query($sql)){
      header("Location: menu.php");
    } else {
      echo "Couldn't connect to database";
    }
  } else {
    header("Location: menu.php?alert=A higher user access level is required");
  }
} else {
  header('Location: ../a.php?alert=Please Log In');
}
?>
