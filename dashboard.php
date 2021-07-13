<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>TempHumid2021</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	<link href="style1.css" rel="stylesheet" type="text/css">
	<link rel="shortcut icon" href="./images/Square-logo.jpg" />
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.4/raphael-min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/justgage/1.5.0/justgage.min.js"></script>
	<script src="./JsQueries/jquery-latest.js"></script>
	<script src="./JsQueries/highcharts.js"></script>
	<script src="./JsQueries/exporting.js"></script>
	<script src="./JsQueries/export-data.js"></script>
	<script src="./JsQueries/accessibility.js"></script>
	<script src="./JsQueries/sand-signika.js"></script>
	<script>
		$(document).ready(function() {
			$("#gaugePanel").load("statpanel2.php");
			$("#graphPanel").load("graph.php");

			setInterval(function() {
				$("#gaugePanel").load("statpanel2.php");
				$("#graphPanel").load("graph.php");
			}, 30000);
		});
	</script>
</head>
<style>
	#dashboard {
		font-family: Arial;
		border-collapse: collapse;
		width: 100%;
	}

	#dashboard td,
	#dashboard th {
		border: 1px solid #081528;
		padding: 8px;
	}

	#dashboard tr:nth-child(even) {
		background-color: #f2f2f2;
	}

	#dashboard tr:hover(even) {
		background-color: #081528;
	}

	#dashboard th {
		padding-top: 12px;
		padding-bottom: 12px;
		text-align: left;
		background-color: #081528;
		color: white;
	}

	#dashboard1 {
		font-family: Arial;
		border-collapse: collapse;
		width: 100%;
	}

	#dashboard1 td,
	#dashboard1 th {
		border: 1px solid #081528;
		padding: 7px;
	}

	#dashboard1 tr:nth-child(even) {
		background-color: #f2f2f2;
	}

	#dashboard1 tr:hover(even) {
		background-color: #081528;
	}

	#dashboard1 th {
		padding-top: 7px;
		padding-bottom: 7px;
		text-align: left;
		background-color: #081528;
		color: white;
	}

	#heading {
		font-family: Arial;
		border-collapse: collapse;
		width: 100%;
	}

	#heading td,
	#heading th {
		border: 1px solid #797979;
		padding: 8px;
	}

	#heading tr:nth-child(even) {
		background-color: #f2f2f2;
	}

	#heading tr:hover(even) {
		background-color: #797979;
	}

	#heading th {
		padding-top: 12px;
		padding-bottom: 12px;
		text-align: left;
		background-color: #797979;
		color: white;
	}

	#header {
		font-family: Arial;
		border-collapse: collapse;
		width: 100%;
	}

	#header td,
	#header th {
		border: 1px solid #081528;
		padding: 8px;
	}

	#header tr:nth-child(even) {
		background-color: #f2f2f2;
	}

	#header tr:hover(even) {
		background-color: #081528;
	}

	#header th {
		padding-top: 12px;
		padding-bottom: 12px;
		text-align: left;
		background-color: #081528;
		color: white;
	}

	#chart-container {
		width: 100%;
		height: 20%;
	}

	.highcharts-figure,
	.highcharts-data-table table {
		min-width: 320px;
		max-width: 800px;
		margin: 1em auto;
	}

	#container {
		height: 400px;
	}

	.highcharts-figure,
	.highcharts-data-table table {
		min-width: 360px;
		max-width: 800px;
		margin: 1em auto;
	}

	.highcharts-data-table table {
		font-family: Verdana, sans-serif;
		border-collapse: collapse;
		border: 1px solid #EBEBEB;
		margin: 10px auto;
		text-align: center;
		width: 100%;
		max-width: 500px;
	}

	.highcharts-data-table caption {
		padding: 1em 0;
		font-size: 1.2em;
		color: #555;
	}

	.highcharts-data-table th {
		font-weight: 600;
		padding: 0.5em;
	}

	.highcharts-data-table td,
	.highcharts-data-table th,
	.highcharts-data-table caption {
		padding: 0.5em;
	}

	.highcharts-data-table thead tr,
	.highcharts-data-table tr:nth-child(even) {
		background: #f8f8f8;
	}

	.highcharts-data-table tr:hover {
		background: #f1f7ff;
	}

	table,
	th,
	td {
		border: auto;
		margin: auto;
	}

	.myDiv {
		border: 5px outset black;
	}
</style>

<body class="loggedin" bgcolor="EEFDEF">
	<nav class="navtop">
		<div>
			<img src="./images/Square-logo.jpg">
			<h1>Temperature and Humidity Data Logger</h1>
			<a href="export.php"><i class="fas fa-file-csv"></i>Export into CSV</a>
			<a href="about.php" style="margin-right:0px;"><i class="fas fa-info-circle"></i>About</a>
		</div>
	</nav>
	<table id="dashboard" class="table" border="0" cellspacing="2" cellpadding="2" align="center">
		<tr>
			<th>
				<center>
					<font face="Arial">MAC Address: 582d343ad474</font>
				</center>
			</th>
			<th>
				<center>
					<font face="Arial">MAC Address: 582d343ade5d</font>
				</center>
			</th>
		</tr>
	</table>
	<div style="float:left;">
		<div id="gaugePanel"></div>
	</div>
	<table id="dashboard" class="table" border="0" cellspacing="2" cellpadding="2" align="center">
		<tr>
			<th>
				<center>
					<font face="Arial">Live Graph</font>
				</center>
			</th>
		</tr>
	</table>
	<div style="float:left;">
		<div id="container" class="highcharts-figure" style="float:left;height:360px;width:675px;border: 5px outset black;margin-top:0px;margin-bottom:0px;margin-left:2px;"></div>
		<div id="containers" class="highcharts-figure" style="float:left;height:360px;width:675px;border: 5px outset black;margin-top:0px;margin-bottom:0px;margin-right:2px;"></div>
		<div id="graphPanel"></div>
	</div>
	<table id="dashboard1" class="table" border="0" cellspacing="2" cellpadding="2" align="center">
		<tr>
			<th>
				<center>
					<font face="Arial">© 2021 <a href="https://ionics-ems.com/">Ionics-EMS Inc.</a></font>
				</center>
			</th>
		</tr>
	</table>
</body>

</html>