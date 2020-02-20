<?php
function blogHeader($navMenu, $conn){
  $nav = navMenu($navMenu, $conn);
  $header = "<header>
  <div id='topContainer'><div id='logoContainer'><a href='../index.php' target='_self' class='headerAnchor'><img src='../l/logov3.svg' alt='Alex Usher Logo'/></a></div></div>
            $nav
            </header>";

  return $header;
}

function navMenu($menuId, $conn){
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
            $menuContents .= "<div class='navDiv2'><li class='navli'><a href='../page.php?id=$pageId&title=$pageName' target='_self'>$pageName</a></li></div>";
          }
        }
      }
    }
    $menu = "<div id='navContainer' class='navDiv'>
                <div id='phoneNavContainer'>
                    <a href='#footerContainer' target='_self' id='menuIcon' class='mobileMenu' onclick='openNav()'>
                        <img src='m/menuIcon3.svg' class='mobileNavMenuIcon' alt='Menu Logo'/>
                    </a>
                </div>
                <ul class='navUl'>
                    $menuContents
                </ul>
            </div>";

    return $menu;
  } else {
    return "";
  }
}
 ?>
