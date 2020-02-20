<?php
session_start();
include "dbConnection.php";
include "htmlcode.php";
$conn = openConnection();

if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){//check session
  $PageID = strip_tags(addslashes($_GET['id'])); //id of item to move
  $MenuID = strip_tags(addslashes($_GET['menuid'])); //id of menu the item is in

  $sql = "SELECT * FROM menu WHERE MenuID='$MenuID'"; //get data from table in database
  $results = $conn -> query($sql) or die("Could not connect to database"); //query db

  if($results -> num_rows > 0){
    while($row = $results -> fetch_assoc()){
      $menuContents = explode(" ", $row['MenuContents']);
    }
  }

  for($i=0;$i<count($menuContents);$i++){ //changing position of menu elements
    if($menuContents[$i]==$PageID){
      $temp = $menuContents[$i-1]; //temp element needed so no data is lost
      $menuContents[$i-1] = $PageID;
      $menuContents[$i] = $temp;
    }
  }

  $menuContent = implode(" ", $menuContents); //convert array to string for DB

  $sql = "UPDATE menu SET MenuContents = '$menuContent' WHERE MenuID='$MenuID'";

  if($conn -> query($sql)){ //updating DB
    header("Location: menu.php");
  } else {
    echo $conn->error;
  }
} else {
  header('Location: ../a.php?alert=Please Log In');
}

?>
