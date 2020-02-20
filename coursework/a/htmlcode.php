<?php
    include "alertChecker.php";
    checkAlert();

    $topContainer = "<div id='topContainer'><div id='logoContainer'><a href='../index.php' target='_self' class='headerAnchor'><img src='../l/logov3.svg' alt='Alex Usher Logo'/></a></div></div>";

    $head = "<head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>AW Usher Admin</title>
        <script src='main.js'></script>
        <link rel='stylesheet' type='text/css' href='style.css'/>
        <link href='https://fonts.googleapis.com/css?family=Dorsa|Raleway:300' rel='stylesheet'>
    </head>";

    $nav = "$topContainer
    <div id='nav'>
            <div id='headingContainer'>
                <h1 id='heading'>Alex W. Usher Admin</h1>
            </div>
            <ul class='navUl'>
                <li class='navLi'><a class='navA' href='home.php' target='_self'>Home</a></li>
                <li class='navLi'><a class='navA' href='pages.php' target='_self'>Pages</a></li>
                <li class='navLi'><a class='navA' href='menu.php' target='_self'>Menus</a></li>
                <li class='navLi'><a class='navA' href='blog.php' target='_self'>Blog</a></li>
                <li class='navLi'><a class='navA' href='users.php' target='_self'>Manage Users</a></li>
                <li class='navLi'><a class='navA' href='account.php' target='_self'>Account</a></li>
                <li class='navLi'><a class='navA' href='logOut.php' target='_self'>Log Out</a></li>
            </ul>
            <div id='phoneNavContainer'>
                <a href='#footerContainer' target='_self' id='menuIcon' class='mobileMenu' onclick='openNav()'>
                    <img src='m/menuIcon3.svg' class='mobileNavMenuIcon' alt='Menu Logo'/>
                </a>
            </div>
        </div>";
?>
