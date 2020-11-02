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

    $mysqli->query("UPDATE events SET name=\"{$mysqli->escape_string($_POST['name'])}\", date=\"{$mysqli->escape_string($_POST['date'])}\", startTime=\"{$mysqli->escape_string($_POST['startTime'])}\", endTime=\"{$mysqli->escape_string($_POST['endTime'])}\", address=\"{$mysqli->escape_string($_POST['address'])}\", eventCoordinator=\"{$mysqli->escape_string($_POST['eventCoordinator'])}\", maxSlots=\"{$mysqli->escape_string($_POST['maxSlots'])}\" WHERE eventId={$_POST['eventId']}");

}

header("Location: /event-edit-template.php?eventId=" . $mysqli->escape_string($_POST['eventId']));
die;

?>
