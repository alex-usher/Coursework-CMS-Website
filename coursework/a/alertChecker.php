<?php
  function checkAlert(){
    if(isset($_GET['alert'])){//check for alert
      $alert = $_GET['alert'];
      echo "<script type='text/javascript'>alert('$alert');</script>";//output alert
    }
  }
 ?>
