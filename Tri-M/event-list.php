<?php
$mysqli = new mysqli("localhost", "root", "root", "trim");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}

$eventsResponse = $mysqli->query("SELECT * FROM events");
$events = [];

while ($row = $eventsResponse->fetch_assoc()) {
    $row['signups'] = $mysqli->query("select count(signupId) from signups where eventId = ".$row['eventId'])->fetch_row()[0];
    array_push($events, $row);
}

echo json_encode($events);


?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Is this whole line needed -->
        <link type="text/css" rel="stylesheet" href="css/list-styles.css"  media="screen,projection"/>
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
        <div style="border-bottom-style: none; height: 5vh"></div>

        <?php
            foreach ($events as $event) {
                $date = date_format(date_create($event['date']),"M. jS");
                $startTime = date_format(date_create($event['startTime']),"g:i A");
                $endTime = date_format(date_create($event['endTime']),"g:i A");

                echo    "<div>
                        <a href=\"event-template.php?eventId={$event['eventId']}\">
                        <h1>{$event['name']}</h1>
                        <p>$date<br>$startTime-$endTime</p>
                        <h2>{$event['signups']}/{$event['maxSlots']} FILLED</h2>
                        </a>
        </div>";
            }
        ?>

        <!-- Spacer -->
        <div style="border-bottom-style: none; height: 5vh"></div>
        
        <script type="text/javascript" src="js/script.js"></script>
    </body>
</html>