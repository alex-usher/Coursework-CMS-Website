<?php
session_start();
include "dbConnection.php";
include "htmlcode.php";
$conn = openConnection();

if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){//check session
  $PageID = strip_tags(addslashes($_GET['id']));//get id
  $MenuID = strip_tags(addslashes($_GET['menuid']));

  $sql = "SELECT * FROM menu WHERE MenuID='$MenuID'"; //get data from table in database
  $results = $conn -> query($sql) or die("Could not connect to database");

  if($results -> num_rows > 0){
    while($row = $results -> fetch_assoc()){
      $menuContents = explode(" ", $row['MenuContents']);
    }
  }

  for($i=0;$i<count($menuContents);$i++){
    if($menuContents[$i]==$PageID){
      $j=$i; //avoiding infinite loop by changing positions outside for loop.
    }
  }

  $temp = $menuContents[$j+1];
  $menuContents[$j+1] = $PageID;
  $menuContents[$j] = $temp;

  $menuContent = implode(" ", $menuContents); //convert array to string for DB

  $sql = "UPDATE menu SET MenuContents = '$menuContent' WHERE MenuID='$MenuID'";

  if($conn -> query($sql)){ //updating DB
    header("Location: menu.php");
  } else {
    echo "Update failed.";
  }
} else {
  header('Location: ../a.php?alert=Please Log In');
}

?>
