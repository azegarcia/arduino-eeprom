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
	while ($row = mysqli_fetch_array($result)) {
?>
		<div id="temp1" class="myDiv" style="float:left; width:225px; height:200px; margin-left:2px;">
			<script>
				var temp1 = new JustGage({
					id: "temp1",
					value: <?php echo $row['temperature']; ?>,
					min: 0,
					max: 60,
					symbol: '°C',
					decimals: 1,
					valueMinFontSize: 22,
					labelMinFontSize: 12,
					gaugeColor: '#808080',
					levelColors: ["#ff0000", "#00ff00", "#ff0000"],
					pointer: true,
					pointerOptions: {
						toplength: -15,
						bottomlength: 10,
						bottomwidth: 12,
						color: '#000000',
						stroke: '#ffffff',
						stroke_width: 3,
						stroke_linecap: 'round'
					},
					gaugeWidthScale: 1,
					counter: true,
					relativeGaugeSize: true,
					label: "Temperature",
					labelFontColor: '#000000'
				});
			</script>
		</div>
		<div id="humid1" class="myDiv" style="float:left; width:225px; height:200px;">
			<script>
				var humid1 = new JustGage({
					id: "humid1",
					value: <?php echo $row['humidity']; ?>,
					min: 0,
					max: 100,
					symbol: '%H',
					decimals: 1,
					valueMinFontSize: 22,
					labelMinFontSize: 12,
					gaugeColor: '#808080',
					levelColors: ["#ff0000", "#00ff00", "#ff0000"],
					pointer: true,
					pointerOptions: {
						toplength: -15,
						bottomlength: 10,
						bottomwidth: 12,
						color: '#000000',
						stroke: '#ffffff',
						stroke_width: 3,
						stroke_linecap: 'round'
					},
					gaugeWidthScale: 1,
					counter: true,
					relativeGaugeSize: true,
					label: "Humidity",
					labelFontColor: '#000000'
				});
			</script>
		</div>
		<div id="batt1" class="myDiv" style="float:left; width:225px; height:200px;">
			<script>
				var batt1 = new JustGage({
					id: "batt1",
					value: <?php echo $row['battery']; ?>,
					min: 0,
					max: 100,
					symbol: '%',
					decimals: 1,
					valueMinFontSize: 22,
					labelMinFontSize: 12,
					gaugeColor: '#808080',
					levelColors: ["#ff0000", "#ff0000", "#00ff00"],
					pointer: true,
					pointerOptions: {
						toplength: -15,
						bottomlength: 10,
						bottomwidth: 12,
						color: '#000000',
						stroke: '#ffffff',
						stroke_width: 3,
						stroke_linecap: 'round'
					},
					gaugeWidthScale: 1,
					counter: true,
					relativeGaugeSize: true,
					label: "Battery",
					labelFontColor: '#000000'
				});
			</script>
		</div>
	<?php
	}
	?>
<?php
} else {
	echo "No Results Found";
}
?>
<?php
if (mysqli_num_rows($results) > 0) {
	while ($row = mysqli_fetch_array($results)) {
?>
		<div id="temp2" class="myDiv" style="float:left; width:225px; height:200px; margin-left:2px;">
			<script>
				var temp2 = new JustGage({
					id: "temp2",
					value: <?php echo $row['temperature']; ?>,
					min: 0,
					max: 60,
					symbol: '°C',
					decimals: 1,
					valueMinFontSize: 22,
					labelMinFontSize: 12,
					gaugeColor: '#808080',
					levelColors: ["#ff0000", "#00ff00", "#ff0000"],
					pointer: true,
					pointerOptions: {
						toplength: -15,
						bottomlength: 10,
						bottomwidth: 12,
						color: '#000000',
						stroke: '#ffffff',
						stroke_width: 3,
						stroke_linecap: 'round'
					},
					gaugeWidthScale: 1,
					counter: true,
					relativeGaugeSize: true,
					label: "Temperature",
					labelFontColor: '#000000'
				});
			</script>
		</div>
		<div id="humid2" class="myDiv" style="float:left; width:225px; height:200px;">
			<script>
				var humid2 = new JustGage({
					id: "humid2",
					value: <?php echo $row['humidity']; ?>,
					min: 0,
					max: 100,
					symbol: '%H',
					decimals: 1,
					valueMinFontSize: 22,
					labelMinFontSize: 12,
					gaugeColor: '#808080',
					levelColors: ["#ff0000", "#00ff00", "#ff0000"],
					pointer: true,
					pointerOptions: {
						toplength: -15,
						bottomlength: 10,
						bottomwidth: 12,
						color: '#000000',
						stroke: '#ffffff',
						stroke_width: 3,
						stroke_linecap: 'round'
					},
					gaugeWidthScale: 1,
					counter: true,
					relativeGaugeSize: true,
					label: "Humidity",
					labelFontColor: '#000000'
				});
			</script>
		</div>
		<div id="batt2" class="myDiv" style="float:left; width:225px; height:200px;">
			<script>
				var batt2 = new JustGage({
					id: "batt2",
					value: <?php echo $row['battery']; ?>,
					min: 0,
					max: 100,
					symbol: '%',
					decimals: 1,
					valueMinFontSize: 22,
					labelMinFontSize: 12,
					gaugeColor: '#808080',
					levelColors: ["#ff0000", "#ff0000", "#00ff00"],
					pointer: true,
					pointerOptions: {
						toplength: -15,
						bottomlength: 10,
						bottomwidth: 12,
						color: '#000000',
						stroke: '#ffffff',
						stroke_width: 3,
						stroke_linecap: 'round'
					},
					gaugeWidthScale: 1,
					counter: true,
					relativeGaugeSize: true,
					label: "Battery",
					labelFontColor: '#000000'
				});
			</script>
		</div>
	<?php
	}
	?>
<?php
} else {
	echo "No Results Found";
}
?>