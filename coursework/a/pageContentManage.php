<?php
    session_start();
    include "dbConnection.php";
    include "htmlcode.php";
    $conn = openConnection();

    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){//check session
      if(isset($_SESSION['userAccess']) && $_SESSION['userAccess']>1){//check user access
        $id= strip_tags(addslashes($_GET['id']));//get id

        $sql = "SELECT PageContent FROM pages WHERE PageID=$id";
        $result = $conn -> query($sql) or die("Couldn't connect to DB");//query db

        if($result -> num_rows > 0){
            while($row = $result -> fetch_assoc()){
                $content = $row['PageContent'];
            }
        }

        $content="<html>
	$head
	<body> $nav
            <div id='mainContainer'>
                <div id='headingContainer'><span id='pageTitle'>Page Content</span></div>
                <form id='pageContentForm' name='pageContentForm' action='pageContentManageDB.php' method='post'>
                    Page ID: <input type='text' name='id' class='pageContentInput' value='$id' readonly>
                    <textarea id='textarea' class='tinymce' name='content' form='pageContentForm'>$content</textarea>
                    <input type='submit' name='submit' class='formSubmit'>
                </form>
            </div>
		<!-- javascript -->
		<script type='text/javascript' src='plugin/js/jquery.min.js'></script>
		<script type='text/javascript' src='plugin/plugin/tinymce/js/tinymce/tinymce.min.js'></script>
		<script type='text/javascript' src='plugin/plugin/tinymce/js/tinymce/init-tinymce.js'></script>
	</body>
</html>";//content

echo $content;
    } else {
      header("Location: pages.php?alert=User Access Level 2 or Higher Required");
    }
  } else {
        header('Location: ../a.php?alert=Please Log In');
  }


?>
