<?php

function blogFooter($fm1, $fm2, $conn){
    $footerMenus = footerMenus($fm1, $fm2, $conn);
    $footer = "<footer>
      <div id='footerContainer'>
        $footerMenus
      </div>
    </footer>";

    return $footer;
}

function footerMenus($id1, $id2, $conn){
  $menu1 = footerMenu($id1, $conn);
  $menu2 = footerMenu($id2, $conn);
  $menus = $menu1 . $menu2;
  return $menus;
}

function footerMenu($menuId, $conn){
  $sql = "SELECT MenuContents FROM menu WHERE MenuID='$menuId'";
  $results = $conn->query($sql) or die($conn->error);
  $menuContents = "";
  if($results->num_rows>0){
    while($row = $results->fetch_assoc()){
      $menu = $row['MenuContents'];
      $menuArr = explode(" ", $menu);
      for($i=0;$i<count($menuArr);$i++){
        $sql = "SELECT PageID, NavName FROM pages WHERE PageID='".$menuArr[$i]."'";
        $result = $conn -> query($sql) or die($conn->error);
        if($result->num_rows>0){
          while($r = $result->fetch_assoc()){
            $pageName = $r['NavName'];
            $pageId = $r['PageID'];
            $menuContents .= "<li class='footerNavLi'><a href='../page.php?id=$pageId&title=$pageName' target='_self'>$pageName</a></li>";
          }
        }
      }
    }
    $menu = "<div id='menu' class='footerDiv'>
        <div id='menuTitle'>
            <span id='menuHeading' class='footerHeading'>Menu</span>
        </div>
        <div id='footerNav' class='footerMenu'>
        <ul class='footerMenuNav' id='mainFooterNav'>
            $menuContents
        </ul>
    </div>";

    return $menu;
  } else {
    return "";
  }
}
 ?>
