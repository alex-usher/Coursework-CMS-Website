<?php
    include "dbConnection.php";
    include "checkKey.php";

    $conn = openConnection();
    $key = strip_tags(addslashes($_POST['key']));//get key

    if(checkKey($key, $conn)){//check session
      $results = $conn->query("SELECT BlogID, BlogTitle FROM blog") or die($conn->error);
        if($results->num_rows >0){//query db
          while($row = $results -> fetch_assoc()){
            $BlogID = $row['BlogID'];//get info
            $BlogName = $row['BlogTitle'];

            echo "$BlogID<>$BlogName<br>";
          }
        }
      } else {
        echo $conn->error;
      }

    closeConnection($conn);

?>
