<?php
include_once "dbConnection.php"; //include all necessary functions
include_once "functions/pageMeta.php";
include_once "functions/footerMenus.php";
include_once "functions/header.php";
include_once "functions/footer.php";
include_once "functions/outputBlogs.php";
include_once "a/alertChecker.php";

if(isset($_GET['id'])){
  checkAlert();
  $conn = openConnection(); //get connection and id
  $id= strip_tags(addslashes($_GET['id']));

  $sql = "SELECT * FROM pages WHERE PageID=$id"; //get page info for id
  $results = $conn -> query($sql) or die("An error occurred while connecting to the database");

  if($results -> num_rows > 0){
      while($row = $results -> fetch_assoc()){
          $pageName = $row['PageName'];//page info assigned to variables
          $metaTitle = $row['MetaTitle'];
          $navMenu = $row['NavMenu'];
          $footerMenu1 = $row['FooterMenu1'];
          $footerMenu2 = $row['FooterMenu2'];
          $displayBlog = $row['DisplayBlog'];
          $pageContent = $row['PageContent'];
      }
      $header = pageHeader($navMenu, $conn); //create header with menus
      $blog='';
      if($displayBlog==='1'){ //if page should output recent blog posts
        $blog = outputBlogs($conn);
      }
      $footer = pageFooter($footerMenu1, $footerMenu2, $conn);
      //generate footer with menus
  } else {
    header("Location: pageNotFound.php");
  }
} else {
  header("Location: pageNotFound.php");
}
 ?>
<html>
<head>
  <script src='i/main.js'></script>
  <link type="text/css" rel="stylesheet" href="i/style.css"/>
  <link href="https://fonts.googleapis.com/css?family=Dorsa|Raleway:300" rel="stylesheet">
  <title><?php echo $metaTitle; ?></title>
  <?php echo pageMeta($id, $conn);?>
</head>
<body>
  <?php echo $header ?>
  <main>
    <div id='imgContainer1'></div>
    <?php echo $pageContent ?>
    <?php echo $blog ?>
  </main>
  <?php echo $footer ?>
</body>
</html>
