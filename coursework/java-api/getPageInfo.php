<?php
include "dbConnection.php";
include "checkKey.php";
$conn=openConnection();
$key = strip_tags(addslashes($_POST['key']));//get key

if(checkKey($key,$conn)){//check session
  $id=strip_tags(addslashes($_GET['id']));//get id
  $results = $conn->query("SELECT PageID, PageName, NavName, MetaTitle, MetaDescription,
    MetaKeywords, NavMenu, FooterMenu1, FooterMenu2, DisplayBlog, IsIndex FROM pages WHERE PageID='$id'") or die($conn->error);
  if($results->num_rows >0){//query db
      while($row = $results -> fetch_assoc()){
        $PageID = $row['PageID'];//get info
        $PageName = $row['PageName'];
        $NavName = $row['NavName'];
        $MetaTitle = $row['MetaTitle'];
        $MetaDescription = $row['MetaDescription'];
        $MetaKeywords = $row['MetaKeywords'];
        $NavMenu = $row['NavMenu'];
        $FooterMenu1 = $row['FooterMenu1'];
        $FooterMenu2 = $row['FooterMenu2'];
        $DisplayBlog = $row['DisplayBlog'];
        $IsIndex = $row['IsIndex'];

        echo "$PageID#$PageName#$NavName#$MetaTitle#$MetaDescription#$MetaKeywords#$NavMenu#$FooterMenu1#$FooterMenu2#$DisplayBlog#$IsIndex";
      }
  } else {
    echo "Page does not exist";
  }
}

closeConnection($conn);
?>
