<?php
session_start();
include "dbConnection.php";
include "htmlcode.php";
$conn = openConnection();

if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){ //check session
  if(isset($_SESSION['userAccess']) && $_SESSION['userAccess'] >1){ //check user access

    $MenuID = $_GET['id']; //get id of menu
    $sql = "SELECT * FROM menu WHERE MenuID='$MenuID'"; //set up query
    $result = $conn -> query($sql) or die("Could not connect to database"); //query db

    if($result -> num_rows > 0){
      while($row = $result -> fetch_assoc()){ //get info from resultset
        $MenuName = $row['MenuName'];
        $MenuContents = explode(" ", $row['MenuContents']); //array of menu contents
      }
    }

    $toDisplay = "";
    $count = 1;
    for($i=0; $i<count($MenuContents); $i++){ //creating table contents
      $toDisplay .= "<tr>
          <th>Menu Position $count <p>Please enter the PageID, found <a class='tableAnchor' style='margin:0;padding:0;'
           href='pages.php' target='_blank'>here</a></th>

          <td><input type='number' value='".$MenuContents[$i]."' id='menuPos$count' name='menuPos$count' min='0' max='999999' maxlength='6'></td>
      </tr>";
      $count++;
    }

    while($count <= 6){ //ensuring there are 6 input fields for the menu
      $toDisplay .= "<tr>
          <th>Menu Position $count <p>Please enter the PageID, found <a class='tableAnchor' style='margin:0;padding:0;'
          href='pages.php' target='_blank'>here</a></th>

          <td><input type='number' value='' id='menuPos$count' name='menuPos$count'  min='0' max='999999' maxlength='6'></td>
      </tr>";
      $count++;
    }
  //complete content
  $content = "<html>
  $head
  <body>
  $nav
  <div id='mainContainer'>
  <div id='titleContainer'><span id='pageTitle'>Edit Menu</span></div>
  <p class='menuPara' style='font-size: 16px;'>Please note that the maximum amount of elements in a menu is 6. If a page does not exist it will be removed from the menu.</p>
  <form action='editMenuDB.php' id='pagesForm'>
      <table id='pagesTable'>
          <tr>
            <th>Menu ID</th>
            <td><input type='text' value='$MenuID' id='menuID' name='menuID' readonly></td>
          </tr>
          <t'>
              <th>Menu Name</th>
              <td><input type='text' value='$MenuName' id='menuName' name='menuName' readonly></td>
          </tr>
          $toDisplay
      </table>
      <input type='submit' value='Submit' class='menuSubmit'>
  </form>
  <a href='deleteMenu.php?anchorId=$MenuID' target='_self' class='contentAnchor'>Delete</a>
  </div>
  </body>
  </html>";

  echo $content; //output content

  } else {
    header("Location: menu.php?alert=User Access Level 2 or Higher Required");
  }
} else {
  header('Location: ../a.php?alert=Please Log In');
}
?>
