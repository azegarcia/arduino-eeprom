<?php
session_start();

date_default_timezone_set("Asia/Shanghai");

ini_set('display_errors', 1); // set to 0 for production version
error_reporting(E_ALL);

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'temphumiduser';
$DATABASE_PASS = 'temphumid2021';
$DATABASE_NAME = 'temphumid';

$sensorObj = new stdClass();

$conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

$sql = "SELECT * FROM temptable ORDER BY timestamp DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $delimiter=',';
    $dateExp = date('ymdhis');
    // create a download filename
    $filename = "THdata_" .$dateExp. ".csv";

    $f = fopen('php://memory','w');

    $headers = array('Timestamp','MAC','Temperature','Humidity','Battery');
    fputcsv($f,$headers,$delimiter);

    while($row=$result->fetch_array()) {
        $time = strtotime($row["timestamp"]);
		$timestamp = date("Y-m-d H:i:s", $time + 25200);
		$mac = $row["macAddress"];
		$temp = $row["temperature"];
		$humid = $row["humidity"];
		$batt = $row["battery"];
        $lines = array($timestamp,$mac,$temp,$humid,$batt);
        fputcsv($f,$lines,$delimiter);
    }

    fseek($f,0);
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="'.$filename.'";');
    fpassthru($f);
    exit;
}
else{
    $_SESSION['message']='Cannot export. Empty Data';
    header('location:export.php');
}
?>