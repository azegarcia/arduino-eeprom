<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" media="screen" href="css/styles.css" />
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.4/raphael-min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/justgage/1.5.0/justgage.min.js"></script>
		<script type="text/javascript" src="./JsQueries/jg2.js"></script>
	</head>
<style>
table, th, td {
	border: auto;
	margin: auto;
}
.myDiv {
	border: 5px outset black;
}
</style>
<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'temphumiduser';
$DATABASE_PASS = 'temphumid2021';
$DATABASE_NAME = 'temphumid';

$con = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ($con->connect_error) {
	die('<script>alert("Failed to connect 582d343ad474 to the database. Please try again.")</script>');
}
$result = mysqli_query($con, "SELECT * FROM temptable WHERE macAddress='582d343ad474' ORDER BY timestamp DESC LIMIT 1");
$results = mysqli_query($con, "SELECT * FROM temptable WHERE macAddress='582d343ade5d' ORDER BY timestamp DESC LIMIT 1");
?>
<?php
if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_array($result)){
?>
	<div id="temp1" class="myDiv" style="float:left; width:225px; height:200px; margin-left:2px;">
		<script>
			var tempSectors1 = [{
				color: "#ffff00",
				lo: 0,
				hi: 14
			},{
				color: "#00ff00",
				lo: 15,
				hi: 24
			},{
				color: "#ff0000",
				lo: 25,
				hi: 60
			}];
			var tempVal = '<?php echo $row['temperature']; ?>';
			var tempDflt1 = {
				value: tempVal,
				min:0,
				max:60,
				symbol: '°C',
				decimals: 1,
				pointer: true,
				valueMinFontSize: 28,
				labelMinFontSize: 14,
				label: "Temperature",
				labelFontColor: "000000"
			}
			var temp1 = new JustGage ({
				id:"temp1",
				defaults: tempDflt1,
				customSectors: tempSectors1
			});
		</script>
	</div>
	<div id="humid1" class="myDiv" style="float:left; width:225px; height:200px;">
		<script>
			var humidSectors1 = [{
				color: "#ffff00",
				lo: 0,
				hi: 39
			},{
				color: "#00ff00",
				lo: 40,
				hi: 60
			},{
				color: "#ff0000",
				lo: 61,
				hi: 100
			}];
			var humidVal = '<?php echo $row['humidity']; ?>';
			var humidDflt1 = {
				value: humidVal,
				min:0,
				max:100,
				symbol: '%H',
				decimals: 1,
				pointer: true,
				valueMinFontSize: 28,
				labelMinFontSize: 14,
				label: "Humidity",
				labelFontColor: "000000"
			}
			var humid1 = new JustGage ({
	 			id:"humid1",
				defaults: humidDflt1,
				customSectors: humidSectors1
			});
		</script>
	</div>
	<div id="batt1" class="myDiv" style="float:left; width:225px; height:200px;">
		<script>
			var battSectors1 = [{
				color: "#ff0000",
				lo: 0,
				hi: 30
			},{
				color: "#ffff00",
				lo: 31,
				hi: 60
			},{
				color: "#00ff00",
				lo: 61,
				hi: 100
			}];
			var battVal = '<?php echo $row['battery']; ?>';
			var battDflt1 = {
				value: battVal,
				min:0,
				max:100,
				symbol: '%',
				pointer: true,
				valueMinFontSize: 28,
				labelMinFontSize: 14,
				label: "Battery",
				labelFontColor: "000000"
			}
			var batt1 = new JustGage ({
				id:"batt1",
				defaults: battDflt1,
				customSectors: battSectors1
			});
		</script>
	</div>
<?php
}
?>
<?php
}else{
	echo "No Results Found";
}
?>
<?php
if (mysqli_num_rows($results) > 0) {
	while($row = mysqli_fetch_array($results)){
?>
	<div id="temp2" class="myDiv" style="float:left; width:225px; height:200px;">
		<script>
			var tempSectors2 = [{
				color: "#ffff00",
				lo: 0,
				hi: 14
			},{
				color: "#00ff00",
				lo: 15,
				hi: 24
			},{
				color: "#ff0000",
				lo: 25,
				hi: 60
			}];
			var tempVal2 = '<?php echo $row['temperature']; ?>';
			var tempDflt2 = {
				value: tempVal2,
				min:0,
				max:60,
				symbol: '°C',
				decimals: 1,
				pointer: true,
				valueMinFontSize: 28,
				labelMinFontSize: 14,
				label: "Temperature",
				labelFontColor: "000000"
			}
			var temp2 = new JustGage ({
				id:"temp2",
				defaults: tempDflt2,
				customSectors: tempSectors2
			});
		</script>
	</div>
	<div id="humid2" class="myDiv" style="float:left; width:225px; height:200px;">
		<script>
			var humidSectors2 = [{
				color: "#ffff00",
				lo: 0,
				hi: 39
			},{
				color: "#00ff00",
				lo: 40,
				hi: 60
			},{
				color: "#ff0000",
				lo: 61,
				hi: 100
			}];
			var humidVal2 = '<?php echo $row['humidity']; ?>';
			var humidDflt2 = {
				value: humidVal2,
				min:0,
				max:100,
				symbol: '%H',
				decimals: 1,
				pointer: true,
				valueMinFontSize: 28,
				labelMinFontSize: 14,
				label: "Humidity",
				labelFontColor: "000000"
			}
			var humid2 = new JustGage ({
	 			id:"humid2",
				defaults: humidDflt2,
				customSectors: humidSectors2
			});
		</script>
	</div>
	<div id="batt2" class="myDiv" style="float:right; width:225px; height:200px;">
		<script>
			var battSectors2 = [{
				color: "#ff0000",
				lo: 0,
				hi: 30
			},{
				color: "#ffff00",
				lo: 31,
				hi: 60
			},{
				color: "#00ff00",
				lo: 61,
				hi: 100
			}];
			var battVal2 = '<?php echo $row['battery']; ?>';
			var battDflt2 = {
				value: battVal2,
				min:0,
				max:100,
				symbol: '%',
				pointer: true,
				valueMinFontSize: 28,
				labelMinFontSize: 14,
				label: "Battery",
				labelFontColor: "000000"
			}
			var batt2 = new JustGage ({
				id:"batt2",
				defaults: battDflt2,
				customSectors: battSectors2
			});
		</script>
	</div>
<?php
}
?>
<?php
}else{
	echo "No Results Found";
}
?>