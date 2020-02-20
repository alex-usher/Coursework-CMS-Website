<?php

function blogMeta($id, $conn){
  $metas = "<meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <meta http-equiv='cleartype' content='on' />
  <meta name='MobileOptimized' content='width' />
  <meta name='HandheldFriendly' content='true' />
  <meta http-equiv='cache-control' content='no-cache' />
  <meta name='theme-color' content='#ffffff'/>
  <meta name='ROBOTS' content='index, follow' />";

  $sql = "SELECT MetaTitle, MetaDescription, MetaKeywords FROM blog WHERE BlogID='$id'";
  $result = $conn->query($sql) or die($conn->error);
  if($result->num_rows>0){
    while($row = $result->fetch_assoc()){
      $metaTitle = $row['MetaTitle'];
      $metaDescription = $row['MetaDescription'];
      $metaKeywords = $row['MetaKeywords'];
      $metas .= "<meta name='Description' content='$metaDescription' />
                  <meta name='dc.title' content='$metaTitle' />
                  <meta name='keywords' content='$metaKeywords' />";
    }
  }

  return $metas;
}

 ?>
