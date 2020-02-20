<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Dorsa|Raleway:300" rel="stylesheet">
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

    </style>
  </head>
  <body>
    <div id='topContainer'>
      <div id='logoContainer'>
        <a href='alexusher.co.uk' target='_self' class='headerAnchor'>
          <img src='logov3.svg' alt='Alex Usher Logo'/>
        </a>
      </div>
    </div>
    <p class="contentPara">The database has been set up! You can now log in <a href="../a.php">here</a> using the default username and password.</p>
  </body>
</html>
