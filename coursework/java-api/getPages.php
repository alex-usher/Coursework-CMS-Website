<?php
    include "dbConnection.php";
    include "checkKey.php";

    $conn = openConnection();
    $key = strip_tags(addslashes($_POST['key']));//get key

    if(checkKey($key, $conn)){//check key
      $results = $conn->query("SELECT PageID, PageName FROM pages") or die($conn->error);
        if($results->num_rows >0){//query db
          while($row = $results -> fetch_assoc()){
            $PageID = $row['PageID'];//get info
            $PageName = $row['PageName'];

            echo "$PageID<>$PageName<br>";
          }
        }
      } else {
        echo $conn -> error();
      }

    closeConnection($conn);

?>
