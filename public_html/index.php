<!DOCTYPE html>
<html>
    <head>
        <!-- Is this whole line needed -->
        <link type="text/css" rel="stylesheet" href="css/index-styles.css"  media="screen,projection"/>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>
        <header>
            <img src="media/threeM.png">
            <nav>
                <img onclick="dropdown()" src="media/dropdown.png">
                <div id="Menu" class="collapsed">
                    <h1><a href="index.php">Home</a></h1>
                    <h1><a href="event-list.php">Events</a></h1>
                    <h1><a href="admin-page.php">Administrator Access</a></h1>
                </div>
            </nav>
        </header>
        
        <div>
            <h1><span>Tri-M</span></h1>
            <h2>Sign-ups</h2>
        </div>
        
        <footer>
            <img class="left-corner" src="media/left-corner.png">
            <img class="right-corner" src="media/right-corner.png">
        </footer>
        
        <!-- Is this right -->
        <script type="text/javascript" src="js/script.js"></script>
    </body>
</html>