<?php
$mysqli = new mysqli("localhost", "root", "root", "trim");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
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
            <div><span style="color: #167887"><?php
                    if ($event['eventCoordinator']) {
                        echo $event['eventCoordinator'];
                    } else {
                        echo 'Opening Available';
                    }
            ?></span></div>
        </div>
        <div class="list">
            <h2>VOLUNTEERS</h2>
            <div><span style="color: #167887">Sign-Up</span></div>
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