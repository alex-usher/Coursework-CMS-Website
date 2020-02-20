<?php
  include "dbConnection.php";

  if(isset($_GET['db']) && isset($_GET['dbHost']) && isset($_GET['dbUser']) && isset($_GET['dbPwd'])){
    if(strlen($_GET['db']) > 0 && strlen($_GET['dbHost']) > 0 && strlen($_GET['dbUser']) >0 && strlen($_GET['dbPwd']) > 0){

      $conn = openConnection($_GET['db'], $_GET['dbHost'], $_GET['dbUser'], $_GET['dbPwd']);//create connection

      if($conn != NULL){ //if db connection created
        $problem = false;
        //set up & execute queries to create each table
        $sql = "CREATE TABLE IF NOT EXISTS blog(BlogID INT NOT NULL AUTO_INCREMENT, BlogTitle VARCHAR(60), BlogIntro TEXT,
         BlogDescription TEXT, MetaDescription VARCHAR(300), MetaKeywords VARCHAR(300), BlogContent TEXT,
          NavMenu INT, FooterMenu1 INT, FooterMenu2 INT, showInRecent TINYINT(1) NOT NULL DEFAULT '0', PRIMARY KEY(BlogID))";
        if(!($conn->query($sql))){
          $problem = true;
          echo $conn->error;
          echo "There was a problem creating the blog table<br>";
        }

        $sql = "CREATE TABLE IF NOT EXISTS javaaccess(SessionID INT NOT NULL AUTO_INCREMENT, SessionCode VARCHAR(20),
          LastConnection TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, OnUpdate INT NOT NULL DEFAULT '0', PRIMARY KEY(SessionID))";
        if(!($conn->query($sql))){
          $problem = true;
          echo $conn->error;
          echo "There was a problem creating the Java Application table<br>";
        }

        $sql = "CREATE TABLE IF NOT EXISTS menu(MenuID INT NOT NULL AUTO_INCREMENT, MenuName VARCHAR(25), MenuContents VARCHAR(150),
          PRIMARY KEY(MenuID))";
        if(!($conn->query($sql))){
          $problem = true;
          echo $conn->error;
          echo "There was a problem creating the menu table<br>";
        }

        $sql = "CREATE TABLE IF NOT EXISTS pages(PageID INT NOT NULL AUTO_INCREMENT, PageName VARCHAR(50), NavName VARCHAR(20),
          MetaTitle VARCHAR(60), MetaDescription VARCHAR(300), MetaKeywords VARCHAR(300), PageContent TEXT,
          NavMenu INT, FooterMenu1 INT, FooterMenu2 INT, DisplayBlog TINYINT(1) NOT NULL DEFAULT '0', IsIndex TINYINT(1) NOT NULL DEFAULT '0', PRIMARY KEY(PageID))";
        if(!($conn->query($sql))){
          $problem = true;
          echo $conn->error;
          echo "There was a problem creating the pages table<br>";
        }

        $sql = "CREATE TABLE IF NOT EXISTS users(UserID INT NOT NULL AUTO_INCREMENT, Name VARCHAR(100), Username VARCHAR(100),
          Password VARCHAR(512), Email VARCHAR(150), UserAccess INT, DateCreated DATE, PRIMARY KEY(UserID))";
          if(!($conn->query($sql))){
            $problem = true;
            echo $conn->error;
            echo "There was a problem creating the users table";
          } else {
            $sql = "INSERT INTO users(Name, Username, Password, UserAccess, DateCreated)
              VALUES('root', 'root', '".password_hash('root', PASSWORD_DEFAULT)."', '3', '".date("Y-m-d")."')";
              if(!($conn->query($sql))){
                $problem = true;
                echo $conn->error;
                echo "There was a problem creating the root user account.";
              }
          }
          //if no issues occur creating tables, output db info to file
          if(!($problem)){
            $file = fopen("db.txt", "w") or die("Couldn't save database info"); //get file or create if doesn't exist
            $txt = $_GET['db'] . " \n" . $_GET['dbHost'] . " \n" . $_GET['dbUser'] . " \n" . $_GET['dbPwd'];
            if(fwrite($file, $txt)){ //output to file
              fclose($file);
              header("Location: success.php");
            } else {
              echo "Couldn't save database info.";
            }
          }
      } else {
        echo "Database was not found";
      }
    } else {
      header("Location: index.php?alert=Please complete the form");
    }
  } else {
    header("Location: index.php?alert=Please complete the form");
  }
?>
