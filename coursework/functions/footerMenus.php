<?php

function footerMenus($id1, $id2, $conn){
  $menu1 = footerMenu($id1, $conn);
  $menu2 = footerMenu($id2, $conn);
  $menus = $menu1 . $menu2;
  return $menus;
}

function footerMenu($menuId, $conn){
  //get menu
  $sql = "SELECT * FROM menu WHERE MenuID='$menuId'";
  $results = $conn->query($sql) or die($conn->error);
  $menuContents = "";
  if($results->num_rows>0){
    while($row = $results->fetch_assoc()){
      $menuTitle = $row['MenuName'];//get menu contents
      $menu = $row['MenuContents'];
      $menuArr = explode(" ", $menu);
      for($i=0;$i<count($menuArr);$i++){
        //get page name for each page
        $sql = "SELECT PageID, NavName FROM pages WHERE PageID='".$menuArr[$i]."'";
        $result = $conn -> query($sql) or die($conn->error);
        if($result->num_rows>0){
          while($r = $result->fetch_assoc()){
            $pageName = $r['NavName'];
            $pageId = $r['PageID'];
            //create menu list item for each page
            $menuContents .= "<li class='footerNavLi'><a href='page.php?id=$pageId&title=$pageName' target='_self'>$pageName</a></li>";
          }
        }
      }
    }
    $menu = "<div id='menu' class='footerDiv'>
        <div id='menuTitle'>
            <span id='menuHeading' class='footerHeading'>$menuTitle Menu</span>
        </div>
        <div id='footerNav' class='footerMenu'>
        <ul class='footerMenuNav' id='mainFooterNav'>
            $menuContents
        </ul>
        </div>
    </div>";

    return $menu;
  } else {
    return "";
  }
}

 ?>
