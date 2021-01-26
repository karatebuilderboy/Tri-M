<?php

$config = json_decode(file_get_contents("../db.json"), true);

// Connection info
$servername = $config['SQL_Host'];
$dusername = $config['SQL_User'];
$dpassword = $config['SQL_Password'];
$dbname = $config['Database'];

$mysqli = new mysqli($servername, $dusername, $dpassword, $dbname);
if ($mysqli->connect_errno) {
    //echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit;
}

$config = json_decode(file_get_contents("../db.json"), true);
$admin_key = $config['Admin_Key'];

if (isset($_COOKIE['pwd'])) {
    $inbound_key = urldecode($_COOKIE['pwd']);
    $compare_key = md5($inbound_key . "m9phF35dz9XMvDYQ7VM8");

    if ($compare_key === $admin_key)
    {
        header("Location: /event-admin-list.php");
        die;
        echo "Success";
    }
}

if (isset($_POST['password']))
{
    $inbound_key = $_POST['password'];
    $admin_key = $config['Admin_Key'];
	// not ideal, but ok for now
	// TODO: use bcrypt instead
	$compare_key = md5($inbound_key . "m9phF35dz9XMvDYQ7VM8");

	if ($compare_key === $admin_key)
	{
		// auth success
		setcookie("pwd", $inbound_key, 0, '/', 'trim.chseagletime.com', false, true);
        header("Location: /event-admin-list.php");
		die;
	}
	else
	{
		echo "Authentication Failure";
	}

	#echo $inbound_key . "<br>";
	#echo $compare_key . "<br>";

	die;
}

?>

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
		<form method="post">
		<input type="password" name="password" placeholder="Password" style="border: none; background: none; color: #167887; font-family: Montserrat; font-size: 2.5vh; text-align: center;">
		<input type="submit" value="Submit"></div></form>
        </div>
        
        <script type="text/javascript" src="js/script.js"></script>
    </body>
</html>
