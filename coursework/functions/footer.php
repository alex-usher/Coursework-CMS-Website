<?php
function pageFooter($fm1, $fm2, $conn){
    $footerMenus = footerMenus($fm1, $fm2, $conn);
    $footer = "<footer>
      <div id='footerContainer'>
        $footerMenus
      </div>
    </footer>";

    return $footer;
}
 ?>
