<?php
include "dbConnection.php";
include "checkKey.php";
$conn=openConnection();
$key = strip_tags(addslashes($_POST['key']));//get key

if(checkKey($key,$conn)){//check session
  $id= addslashes(strip_tags($_GET['id']));//get id
  $results = $conn->query("SELECT BlogID, BlogTitle, BlogIntro, BlogDescription
    , MetaTitle, MetaDescription, MetaKeywords, NavMenu, FooterMenu1, FooterMenu2, showInRecent FROM blog WHERE BlogID='$id'") or die($conn->error);
  if($results->num_rows >0){
      while($row = $results -> fetch_assoc()){
        $BlogID = $row['BlogID'];//get info
        $BlogTitle = $row['BlogTitle'];
        $BlogIntro = $row['BlogIntro'];
        $BlogDescription = $row['BlogDescription'];
        $MetaTitle = $row['MetaTitle'];
        $MetaDescription = $row['MetaDescription'];
        $MetaKeywords = $row['MetaKeywords'];
        $NavMenu = $row['NavMenu'];
        $FooterMenu1 = $row['FooterMenu1'];
        $FooterMenu2 = $row['FooterMenu2'];
        $showInRecent = $row['showInRecent'];

        echo "$BlogID#$BlogTitle#$BlogIntro#$BlogDescription#$MetaTitle#$MetaDescription#$MetaKeywords#$NavMenu#$FooterMenu1#$FooterMenu2#$showInRecent";
      }
  } else {
    echo "Blog does not exist";
  }
}

closeConnection($conn);
?>
