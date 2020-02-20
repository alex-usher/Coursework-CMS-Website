<?php
  include "dbConnection.php";
  include "functions/header.php";
  include "functions/footer.php";
  $conn = openConnection();
 ?>
<html>
<head>
  <title>404 Page Not Found</title>
  <script src='i/main.js'></script>
  <link type="text/css" rel="stylesheet" href="i/style.css"/>
</head>
<body>
  <?php echo header(0, $conn);?>
  <div id="maincontainer">
    <h1 class="contentHeading">Page Not Found!</div>
    <p class="contentPara">Looks like this page is missing! Have you seen it?</p>
  </div>
  <?php echo footer(0, 0, $conn); ?>
</body>
</html>
