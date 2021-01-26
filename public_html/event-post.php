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

if ($_POST) {
    if (array_key_exists('eventCoordinator', $_POST)) {
        if ($mysqli->query("SELECT eventCoordinator FROM events WHERE eventId=".$mysqli->escape_string($_POST['eventId']))->fetch_array()[0]) {
            //echo("Preexisting");
        } else {
            if ($mysqli->query("UPDATE events SET eventCoordinator = '{$mysqli->escape_string($_POST['name'])}' WHERE eventId={$mysqli->escape_string($_POST['eventId'])}")) {
                //echo("Success");
            } else {
                //echo("Failure");
            }
        }

    } else {
        if (intval($mysqli->query("select count(signupId) from signups where eventId = {$mysqli->escape_string($_POST['eventId'])}")->fetch_array()[0]) < intval($mysqli->query("select maxSlots from events where eventId = {$mysqli->escape_string($_POST['eventId'])}")->fetch_array()[0])) {
            if ($mysqli->query("INSERT INTO signups(eventId, name) VALUES ({$mysqli->escape_string($_POST['eventId'])},'{$mysqli->escape_string($_POST['name'])}')")) {
                //echo("Success");
            } else {
                //echo("Failure");
            }
        } else {
            //echo("No room");
        }
    }

    echo "<meta http-equiv='refresh' content='0'>";

}

header("Location: /event-template.php?eventId=" . $mysqli->escape_string($_POST['eventId']));
die;

?>
