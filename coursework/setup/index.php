<?php
include "../a/alertChecker.php";
checkAlert();
 ?>
<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Dorsa|Raleway:300" rel="stylesheet">
    <script src='main.js'></script>
    <style>
    html, body {
        max-width: 100%;
        height: 100%;
        margin: 0;
    }

    .contentContainer {
        width: 98%;
        margin: 20px auto;
        position: relative;
    }

    h1,h2,h3,h4,h5,h6,span {
        font-family: 'Dorsa', 'Times', serif;
        font-weight: 300;
    }

    p {
        font-family: 'Raleway', sans-serif;
        font-size: 18px;
        font-weight: 300;
        line-height: 30px;
    }

    a:link, a:visited {
        text-decoration: none;
        color: rgb(149, 21, 245);
        transition: all 0.5s;
    }

    a:hover {
        color: #00F;
        transition: all 0.5s;
    }

    @media screen and (max-width: 800px){
        .contentContainer {
            max-width: 100%;
            position: relative;
        }

        p {
            font-size: 17px;
        }
    }

    div#topContainer {
        width: 100%;
        border-bottom: 1px solid rgba(0,0,0,0.3);
        margin: 20px 0;
        padding-bottom: 20px;
    }

    div#logoContainer {
        position: relative;
        display: block;
        width: 30%;
        margin: auto;
    }

    @media screen and (max-width: 800px){
        div#topContainer {
            margin: 15px 0 0 0;
            padding-bottom: 15px;
        }
        div#logoContainer {
            width: 35% !important;
        }
    }

    @media screen and (max-width: 600px){
        div#topContainer {
            margin: 10px 0 0 0;
            padding-bottom: 10px
        }

        div#logoContainer {
            width: 40% !important;
        }
    }

    @media screen and (max-width: 500px){
        div#logoContainer {
            width: 45% !important;
        }
    }

    @media screen and (max-width: 400px){
        div#logoContainer {
            width: 50% !important;
        }
    }

    a.headerAnchor img {
        width: 100%;
        height: auto;
    }

    div#formContainer{
      display: flex;
      justify-content: space-between;
      width: 100%;
    }

    div#formContainer form, div#formContainer form input {
      font-family: 'Raleway', sans-serif;
      font-size: 16px;
      text-align: left;
      margin: auto;
      padding: 2px;
    }

    div#formContainer input#submit {
      border-radius: 5px;
      background-color: white;
      border: 1px solid rgba(0, 0, 0, 0.5);
      padding: 3px;
    }
    </style>
  </head>
  <body>
    <div id='topContainer'>
      <div id='logoContainer'>
        <a href='https://www.awusher.com' target='_self' class='headerAnchor'>
          <img src='logov3.svg' alt='Alex Usher Logo'/>
        </a>
      </div>
    </div>
    <div id="formContainer">
      <form class="dbForm" action="JavaScript:dbInfo()">
        Database Name: <input class="loginInput" name="db" id="db" type="text" maxlength="100"/>
        <br><br>
        Database Host: <input class="loginInput" name="dbHost" id="dbHost" type="text" maxlength="100"/>
        <br><br>
        Database User: <input class="loginInput" name="dbUser" id="dbUser" type="text" maxlength="100"/>
        <br><br>
        Database Password: <input class="loginInput" name="dbPwd" id="dbPwd" type="password" maxlength="100"/>
        <br><br>
        <input type="submit" class="loginSubmit" name="submit" value="Submit" id="submit"/>
      </form>
    </div>
    <p style="text-align: center; color: red; font-size: 14px;">Please note that the characters ">" and "<" will be removed from inputs</p>
  </body>
</html>
