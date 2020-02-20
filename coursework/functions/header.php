<?php
function pageHeader($navMenu, $conn){
  $nav = navMenu($navMenu, $conn); //generate menu
  $header = "<header>
  <div id='topContainer'><div id='logoContainer'><a href='index.php' target='_self' class='headerAnchor'><img src='l/logov3.svg' alt='Alex Usher Logo'/></a></div></div>
            $nav
            </header>";//html for header

  return $header;
}

function navMenu($menuId, $conn){
  $sql = "SELECT MenuContents FROM menu WHERE MenuID='$menuId'"; //get contents of menu
  $results = $conn->query($sql) or die($conn->error);
  $menuContents = "";
  if($results->num_rows>0){
    while($row = $results->fetch_assoc()){
      $menu = $row['MenuContents'];
      $menuArr = explode(" ", $menu);
      for($i=0;$i<count($menuArr);$i++){//for each page in menu, get page info
        $sql = "SELECT PageID, NavName FROM pages WHERE PageID='".$menuArr[$i]."'";
        $result = $conn -> query($sql) or die($conn->error);
        if($result->num_rows>0){
          while($r = $result->fetch_assoc()){
            $pageName = $r['NavName'];
            $pageId = $r['PageID']; //create menu list item for each page
            $menuContents .= "<div class='navDiv2'><li class='navli'><a href='page.php?id=$pageId&title=$pageName' target='_self'>$pageName</a></li></div>";
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
            </div>"; //concatenate all info related to menu

    return $menu;
  } else {
    return "";
  }
}
 ?>
