<!DOCTYPE html>
<html>
    <head>
        <!-- Is this whole line needed -->
        <link type="text/css" rel="stylesheet" href="css/admin-styles.css"  media="screen,projection"/>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <!-- Is this right -->
        <script type="text/javascript" src="js/script.js"></script>
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
        
        <!-- Spacer -->
        <div style="border-bottom-style: none; height: 5vh"></div>
 
        <div class="entry">
            <h1>ENTER AN EDIT KEY</h1>
            <div><span style="color: #167887">Password</span></div>
        </div>
        
        <script type="text/javascript" src="js/script.js"></script>
    </body>
</html>