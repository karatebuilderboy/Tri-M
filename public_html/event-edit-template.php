<?php

$config = json_decode(file_get_contents("../db.json"), true);
$admin_key = $config['Admin_Key'];

if (isset($_COOKIE['pwd'])) {
    $inbound_key = urldecode($_COOKIE['pwd']);
    $compare_key = md5($inbound_key . "m9phF35dz9XMvDYQ7VM8");

    if ($compare_key === $admin_key)
    {
        //echo "Success";
    }
    else
    {
        header("HTTP/1.0 403 Forbidden");
        exit;
    }
} else {
    header("HTTP/1.0 403 Forbidden");
    exit;
}
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

if ($_POST) {
    if (array_key_exists('eventCoordinator', $_POST)) {
        if ($mysqli->query("SELECT eventCoordinator FROM events WHERE eventId=".$mysqli->escape_string($_POST['eventId']))->fetch_array()[0]) {
            echo("Preexisting");
        } else {
            if ($mysqli->query("UPDATE events SET eventCoordinator = '{$mysqli->escape_string($_POST['name'])}' WHERE eventId={$mysqli->escape_string($_POST['eventId'])}")) {
                echo("Success");
            } else {
                echo("Failure");
            }
        }

    } else {
        if (intval($mysqli->query("select count(signupId) from signups where eventId = {$mysqli->escape_string($_POST['eventId'])}")->fetch_array()[0]) < intval($mysqli->query("select maxSlots from events where eventId = {$mysqli->escape_string($_POST['eventId'])}")->fetch_array()[0])) {
            if ($mysqli->query("INSERT INTO signups(eventId, name) VALUES ({$mysqli->escape_string($_POST['eventId'])},'{$mysqli->escape_string($_POST['name'])}')")) {
                echo("Success");
            } else {
                echo("Failure");
            }
        } else {
            echo("No room");
        }
    }

    echo "<meta http-equiv='refresh' content='0'>";

}

$eventId = $_GET['eventId'] ? $_GET['eventId'] : 1;

$event =  $mysqli->query("SELECT * FROM events where eventId = $eventId")->fetch_assoc();
$signupsResponse = $mysqli->query("SELECT name, signupId FROM signups where eventId = $eventId");

$signups = [];
while ($row = $signupsResponse->fetch_row()) {
    array_push($signups, $row);
}

#echo json_encode($event);
#echo json_encode($signups);


?>
<!DOCTYPE html>
<html>
    <head>
        <link type="text/css" rel="stylesheet" href="css/template-styles.css"  media="screen,projection"/>
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

        <!-- Spacer -->
        <div style="height: 5vh"></div>

        <form action="event-admin-post.php" method="post">

        <div style="border-bottom-style: solid; border-bottom-width: 1px">
            <input type="text" name="name" placeholder="Enter an event name" style="
    border: none;
    background: none;
    color: white;
    font-family: Montserrat;
    font-size: 3vh;
    margin-block-start: 0.67em;
    margin-block-end: 0.67em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    font-weight: bold;
    width: 100%;
    " value="<?=$event['name'] ?>">
            <h2><?=count($signups) ?>/<input type="number" name="maxSlots" style="
    border: none;
    background: none;
    color: white;
    font-family: Montserrat;
    font-size: 2.75vh;
    margin-block-start: 0.83em;
    margin-block-end: 0.83em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    font-weight: bold;
    width: <?=strlen($event['maxSlots'])+2 ?>ch;
    " oninput="this.style.width=(this.value.length+2)+'ch'" step="1" min="0" required value="<?=$event['maxSlots'] ?>"> FILLED</h2>
            <p>
                <input type="date" name="date" value="<?=date_format(date_create($event['date']),"Y-m-d") ?>" required style="
    font-size: 2.5vh;
    color: white;
    font-family: Montserrat;
    border: none;
    background: none;
">
                <br><input name="startTime" type="time" value="<?=date_format(date_create($event['startTime']),"H:i") ?>" required style="
    font-size: 2.5vh;
    color: white;
    font-family: Montserrat;
    border: none;
    background: none;
">
                -
                <input name="endTime" type="time" value="<?=date_format(date_create($event['endTime']),"H:i") ?>" required style="
    font-size: 2.5vh;
    color: white;
    font-family: Montserrat;
    border: none;
    background: none;
">
            </p>
            <p>
                <textarea name="address" style="font-size: 2.5vh;color: white;font-family: Montserrat;border: none;background: none;margin: 0px;width: 100%;resize: none;" oninput="this.style.height=0;this.style.height=this.scrollHeight+'px'" wrap="off" placeholder="Enter an address"><?=$event['address'] ?></textarea>
            </p>
        </div>
        <div class="list">
            <h2>EVENT COORDINATOR</h2>
            <div><input type="text" name="eventCoordinator" placeholder="Opening Available" style=" border: none; background: none;
    color: white; font-family: Montserrat; font-size: 2.5vh; " value="<?=$event['eventCoordinator'] ?>">
            </div>
        </div>

        <input type="hidden" name="eventId" value="<?=$eventId ?>">

            <input type="submit" value="Submit">

        </form>

        <form action="signups-admin-post.php" method="post" onsubmit="let remove=[],change=[],es=document.getElementsByClassName('signupInputs'),deleteList=[];for(let e of es){if(e.value===e.getAttribute('value')){deleteList.push(e)}else if(e.value===''){remove.push(e.dataset.signupId)}else{change.push([e.dataset.signupId,e.value]);}}deleteList.forEach(e=>{e.parentNode.removeChild(e)});document.getElementById('remove').value=JSON.stringify(remove);document.getElementById('change').value=JSON.stringify(change);">

        <div class="list">
            <h2>VOLUNTEERS</h2>
            <?php foreach ($signups as $signup) {
                echo "<div><input class=\"signupInputs\" type=\"text\" placeholder=\"[Removing {$signup[0]}]\" style=\" border: none; background: none; 
    color: white; font-family: Montserrat; font-size: 2.5vh; \" value=\"{$signup[0]}\" data-signup-Id=\"{$signup[1]}\"></div>";
            }
            ?>
            <input id="remove" type="hidden" name="remove" value="">
            <input id="change" type="hidden" name="change" value="">


        </div>

        <input type="hidden" name="eventId" value="<?=$eventId ?>">

            <input type="submit" value="Submit">

        </form>

        <!-- Spacer -->
        <div style="height: 5vh"></div>

        <script type="text/javascript" src="js/script.js"></script>
    </body>
</html>