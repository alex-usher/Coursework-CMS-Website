<?php
   include "a/alertChecker.php";

   checkAlert();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src='i/main.js'></script>
        <link type="text/css" rel="stylesheet" href="i/style.css"/>

        <title>Alex W. Usher Content Management System | Administration</title>

        <style>
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

        div#navContainer {
            margin: 20px 0 0 0;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(0,0,0,0.3);
        }

            div#logInContainer {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                margin-top: 20px;
                padding: 0 20px;
                font-family: "Raleway", sans-serif;
            }

            div.formContainer {
                width: 100%;
                margin: auto;

            }

            form.loginForm {
                margin: auto;
                padding: 15px 0;
                text-align: center;
            }

            form.loginForm input.loginInput {
                background-color: #FFF;
                border-left: 1px solid rgba(0,0,0,0.3);
                border-right: 1px solid rgba(0,0,0,0.3);
                border-top: 1px solid rgba(0,0,0,0.1);
                border-bottom: 1px solid rgba(0,0,0,0.1);
                margin: 0 3px;
            }

            form.loginForm input.loginSubmit {
                padding: 5px 10px;
                background-color: #FFF;
                border: 1px solid rgba(0,0,0,0.3);
                border-radius: 5px;
            }

            form.loginForm input.loginSubmit:hover {
                animation-name: colorChange;
                animation-duration: 0.5s;
                background-color: #000;
                color:#FFF;
            }

            @keyframes colorChange {
                from {
                      background-color: #FFF;
                      color: #000;
                }
                to {
                    background-color:#000;
                    color:#FFF;
                }
            }

        </style>

    </head>
    <body>
        <header>
          <div id="headerContainer">
            <div id='topContainer'>
              <div id='logoContainer'>
                <a href='index.php' target='_self' class='headerAnchor'>
                  <img src='setup/logov3.svg' alt='Alex Usher Logo'/>
                </a>
              </div>
            </div>
          </div>
        </header>
        <main>
            <div id="logInContainer">
              <div id="formContainer" class="formContainer">
                <form id="loginForm" class="loginForm" action="JavaScript:logIn()">
                  Username: <input class="loginInput" id="userEntry" name="usernameEntry" type="text" maxlength="100"/>
                  <br /><br />
                  Password: <input class="loginInput" id="pwdEntry" name="pwdEntry" type="password" maxlength="100"/>
                  <br /><br />
                  <input class="loginSubmit" name="submitEntry" type="submit" value="Submit" />
                </form>
              </div>
            </div>
        </main>
    </header>
    </body>
</html>
