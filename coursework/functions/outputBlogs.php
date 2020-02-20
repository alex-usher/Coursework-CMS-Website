<?php

function outputBlogs($conn){
  //get blogs to show
  $sql = "SELECT * FROM blog WHERE showInRecent='1'";
  $result = $conn -> query($sql) or die("Couldn't connect");
  $toOutput="";
  if($result -> num_rows > 0){
      while($row = $result -> fetch_assoc()){
        //add content for each blog
          $toOutput .= "<div id='blogContainer' class='blogDivContainer'>
  <div class='blogDiv'>
      <div class='blogSpanContainer'>
          <span class='blogSpan'>".$row['BlogTitle']."</span>
      </div>
      <div class='blogBreak'></div>
      <div class='blogPara'>
          <p class='blogText'>".$row['BlogIntro']."</p>
      </div>
      <div class='blogAnchorContainer'>
          <a class='blogAnchor' href='blog/blog.php?id=".$row['BlogID']."&title=".$row['BlogTitle']."'>Read More</a>
      </div>
  </div>
</div>";
      }
  }
  return $toOutput;
}

 ?>
