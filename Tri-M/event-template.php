<?php
$mysqli = new mysqli("localhost", "root", "root", "trim");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
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
$signupsResponse = $mysqli->query("SELECT name FROM signups where eventId = $eventId");

$signups = [];
while ($row = $signupsResponse->fetch_assoc()) {
    array_push($signups, $row['name']);
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

        <div style="border-bottom-style: solid; border-bottom-width: 1px">
            <h1><?=$event['name'] ?></h1>
            <h2><?=count($signups) ?>/<?=$event['maxSlots'] ?> FILLED</h2>
            <p><?=date_format(date_create($event['date']),"l, F jS") ?><br><?=date_format(date_create($event['startTime']),"g:i A") ?>-<?=date_format(date_create($event['endTime']),"g:i A") ?></p>
            <p>4300 Centennial Lane<br>Ellicott City, MD 21042</p>
        </div>
        <div class="list">
            <h2>EVENT COORDINATOR</h2>
            <div><?php
                    if ($event['eventCoordinator']) {
                        echo $event['eventCoordinator'];
                    } else {
                        echo '<div><form method="post"><input type="text" name="name" placeholder="Opening Available" style=" border: none; background: none; 
    color: white;; font-family: Montserrat; font-size: 2.5vh; "><input type="hidden" name="eventId" value="'.$eventId.'"><input type="hidden" name="eventCoordinator" value="true"><input type="submit" value="Submit"></div></form>';
                    }
            ?></div>
        </div>
        <div class="list">
            <h2>VOLUNTEERS</h2>
            <?php
                if (count($signups) < intval($event['maxSlots'])) {
                    echo '<div><form method="post"><input type="text" name="name" placeholder="Sign-Up" style=" border: none; background: none; 
    color: white;; font-family: Montserrat; font-size: 2.5vh; "><input type="hidden" name="eventId" value="'.$eventId.'"><input type="submit" value="Submit"></div></form>';
                }
            ?>
            <?php foreach ($signups as $signup) {
                echo "<div>$signup</div>";
            }
            ?>

        </div>
        
        <!-- Spacer -->
        <div style="height: 5vh"></div>

        <script type="text/javascript" src="js/script.js"></script>
    </body>
</html>