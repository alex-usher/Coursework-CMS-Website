<?php
    include "dbConnection.php";
    include "a/alertChecker.php";
    checkAlert();
    $conn = openConnection();

    $sql = "SELECT * FROM pages WHERE IsIndex='1'";
    $result = $conn -> query($sql) or die("Couldn't connect");

    if($result -> num_rows > 0){
        while($row = $result -> fetch_assoc()){
            $id = $row['PageID'];
            $name = $row['NavName'];
            header("Location: page.php?id=$id&title=$name");
        }
    }

?>
