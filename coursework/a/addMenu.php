<?php
session_start();
include "dbConnection.php";
include "htmlcode.php";
$conn = openConnection();

if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){//check session
  if(isset($_SESSION['userAccess']) && $_SESSION['userAccess']>=2){//check user access
    $toDisplay = "";
    for($i=1;$i<=6;$i++){ //create content
      $toDisplay .= "<tr>
          <th>Menu Position $i <p>Please enter the PageID, found <a class='tableAnchor' style='margin:0;padding:0;' href='pages.php' target='_blank'>here</a></th>
          <td><input type='number' value='' id='menuPos$i' name='menuPos$i'></td>
      </tr>";
    }

  $content = "<html>
  $head
  <body>
  $nav
  <div id='mainContainer'>
  <div id='titleContainer'><span id='pageTitle'>Add Menu</span></div>
  <p class='menuPara' style='font-size: 16px;'>Please note that the maximum amount of elements in an array is 6. If a page does not exist it will be removed from the menu.</p>
  <form action='addMenuDB.php' id='pagesForm'>
      <table id='pagesTable'>
          <tr>
              <th>Menu Name</th>
              <td><input type='text' value='' id='menuName' name='menuName'></td>
          </tr>
          $toDisplay
      </table>
      <input type='submit' value='Submit' class='menuSubmit'>
  </form>
  </div>
  </body>
  </html>";

  echo $content;
  }
} else {
  header('Location: ../a.php?alert=Please Log In');
}
?>
