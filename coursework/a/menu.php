<?php

session_start();
include "dbConnection.php";
include "htmlcode.php";
$conn = openConnection();

if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){//check session

  $sql = "SELECT * FROM menu";
  $result = $conn -> query($sql) or die ("Could not connect to database"); //getting data from menu table

  $menuID = array();
  $menuName = array();
  $menuContent = array();
  $count = 0;
  $toDisplay = "";

  if($result -> num_rows > 0){
    while($row = $result -> fetch_assoc()){
      $menuID[$count] = $row['MenuID'];  //storing data from tables in arrays
      $menuName[$count] = $row['MenuName'];
      $menuContents = explode(" ", $row['MenuContents']);
      $menuContent[$count] = $menuContents; // a 2D array, storing arrays of contents for each menu
      $count++;
    }

    $toDisplay = "";
    for($i=0;$i<count($menuID);$i++){ //iterating through the arrays created to display the information in tables on the page
      $displayContent = "";
      $tempContent = $menuContent[$i]; //getting individual menu contents
      $count = count($tempContent);
      for($l=0;$l<$count;$l++){ //checking there are no empty values
        if($tempContent[$l] === ""){
          unset($tempContent[$l]);
        }
      }

      $menuContent[$i] = $tempContent;
      $count = count($menuContent[$i]);
      for($j=0;$j<$count;$j++){ //getting page names for each menu item
        $PageID = $menuContent[$i][$j];
        $sqls = "SELECT PageName FROM pages WHERE PageID='$PageID'";
        $results = $conn -> query($sqls);
        if($results -> num_rows > 0){
          while($rows = $results -> fetch_assoc()){
            $PageName = $rows['PageName'];
          }
          if($j==0){ //validation so items at top/bottom of menu can't be moved up/down
            $displayContent .= "<tr class='tableRow'>
              <td class='tableData'>$PageID</td>
              <td class='tableData'>$PageName</td>
              <td class='tableData'></td>
              <td class='tableData'><a class='tableAnchor' href='moveDownInMenu.php?id=$PageID&menuid=".$menuID[$i]."'>Down</a></td>
            </tr>";
          } else if($j==($count-1)){
            $displayContent .= "<tr class='tableRow'>
              <td class='tableData'>$PageID</td>
              <td class='tableData'>$PageName</td>
              <td class='tableData'><a class='tableAnchor' href='moveUpInMenu.php?id=$PageID&menuid=".$menuID[$i]."'>Up</a></td>
              <td class='tableData'></td>
            </tr>";
          } else {
            $displayContent .= "<tr class='tableRow'>
              <td class='tableData'>$PageID</td>
              <td class='tableData'>$PageName</td>
              <td class='tableData'><a class='tableAnchor' href='moveUpInMenu.php?id=$PageID&menuid=".$menuID[$i]."'>Up</a></td>
              <td class='tableData'><a class='tableAnchor' href='moveDownInMenu.php?id=$PageID&menuid=".$menuID[$i]."'>Down</a></td>
            </tr>";
          }
        }
      }
      //complete table
      $toDisplay .= "<div class='menuContainer'>
        <div class='paraContainer'><p class='menuPara'>Menu ".$menuID[$i].", ".$menuName[$i].":</p></div>
        <table>
          <tr class='tableRow'>
              <th class='tableHeading'>Page ID</th>
              <th class='tableHeading'>Nav Name</th>
              <th class='tableHeading'>Move Up</th>
              <th class='tableHeading'>Move Down</th>
          </tr>
          $displayContent
      </table>
      <a class='tableAnchor' href='editMenu.php?id=".$menuID[$i]."' target='_self'>Edit Menu</a>
      </div>";
    }
  }
  //complete content
  $content = "<html>
$head
<body>
$nav
<div id='mainContainer'>
  <div id='titleContainer'><span id='pageTitle'>Menus</span></div>
  <div id='menusContainer'>
  $toDisplay
  </div>
  <a class='tableAnchor' href='addMenu.php' target='_self'>Add Menu</a>
</div>
</body>
</html>"; //HTML content
//output content
echo $content;

} else {
  header('Location: ../a.php?alert=Please Log In');
}

?>
