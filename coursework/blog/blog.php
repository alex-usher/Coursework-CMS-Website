<?php
include_once "dbConnection.php";
include_once "../functions/blogMeta.php";
include_once "../functions/blogHeader.php";
include_once "../functions/blogFooter.php";
include_once "../a/alertChecker.php";

if(isset($_GET['id'])){
  checkAlert();
  $conn = openConnection();
  $id= strip_tags(addslashes($_GET['id']));

  $sql = "SELECT * FROM blog WHERE BlogID=$id";
  $results = $conn -> query($sql) or die("An error occurred while connecting to the database");

  if($results -> num_rows > 0){
      while($row = $results -> fetch_assoc()){
          $blogTitle = $row['BlogTitle'];
          $metaTitle = $row['MetaTitle'];
          $navMenu = $row['NavMenu'];
          $footerMenu1 = $row['FooterMenu1'];
          $footerMenu2 = $row['FooterMenu2'];
          $blogContent = $row['BlogContent'];
      }
  } else {
    header("Location: ../pageNotFound.php");
  }
} else {
  header("Location: ../pageNotFound.php");
}
 ?>
<html>
<head>
  <script src='../i/main.js'></script>
  <link type="text/css" rel="stylesheet" href="../i/style.css"/>
  <link href="https://fonts.googleapis.com/css?family=Dorsa|Raleway:300" rel="stylesheet">
  <title><?php echo $metaTitle ?></title>
  <?php echo blogMeta($id, $conn);?>
  <style>
    div#mainContent1{
      margin:0 5px;
    }

    span {
      font-size: 50px;
    }
    div#mainContent2{
      display: initial;
    }

  </style>
</head>
<body>
  <?php echo blogHeader($navMenu, $conn);?>
  <main>
    <?php echo $blogContent ?>
  </main>
  <?php echo blogFooter($footerMenu1, $footerMenu2, $conn);?>
</body>
</html>
