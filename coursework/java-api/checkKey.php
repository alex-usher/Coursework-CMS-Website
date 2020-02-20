<?php
    function checkKey($key, $conn){
      $key = strip_tags($key);
      $sql = "SELECT * FROM javaaccess WHERE SessionCode='$key'";
      $result = $conn->query($sql) or die($conn->error);
      $keyExists = false;
      $sessionTimeout = false;

      if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            $keyExists = true;
            $diff = (new DateTime(date("Y-m-d H:i:s")))->diff(new DateTime($row['LastConnection']));
/* years */ $y = $diff->format('%y'); /* Get time difference between connections in correct format */
/*months*/  $m = $diff->format('%m');
/* days */  $d = $diff->format('%d');
/* hours */ $h = $diff->format('%h');
/*minutes*/ $i = $diff->format('%i');

            if($y!=0 || $m!=0 || $d!=0 || $h!=0 || $i>=10){ /* checking validity of session */
              $sessionTimeout = true;
              $sql = "DELETE FROM javaaccess WHERE SessionCode='$key'"; /*if session invalid */
              if($conn->query($sql)){
                echo "Please Log In";
              } else {
                echo $conn->error;
              }
            } else {
              $sql = "SELECT * FROM javaaccess WHERE SessionCode='$key'";
              $result = $conn->query($sql) or die($conn->error);
              //increase requests of account to db by 1
              if($result->num_rows >0){
                while($row = $result->fetch_assoc()){
                  $OnUpdate = $row['OnUpdate'];
                  $OnUpdate++;
                }
              }

              $sql = "UPDATE javaaccess SET OnUpdate='$OnUpdate' WHERE SessionCode='$key'";
              if(!($conn->query($sql))){
                echo $conn->error;
              }
            }

        }
      } else {//if session not found
        echo "Please Log In";
        $sessionTimeout = true;
        $keyExists = false;
      }

      if($keyExists && !($sessionTimeout)){
        return true;
      } else {
        return false;
      }
    }
?>
