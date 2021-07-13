<?php
ini_set('display_errors', 1); // set to 0 for production version
 error_reporting(E_ALL);

$mac1 = '582d343ad474';
$mac2 = '582d343ade5d';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Export Your Data</title>
		<link href="style1.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare,com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="shortcut icon" href="./images/Square-logo.jpg"/>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
		<script src="./JsQueries/jquery-latest.js"></script>
        <script src="./JsQueries/highcharts.js"></script>
        <script src="./JsQueries/exporting.js"></script>
        <script src="./JsQueries/export-data.js"></script>
        <script src="./JsQueries/accessibility.js"></script>
		<script>
			$(document).ready(function() {
				$("#tablePanel").load("rawdata.php");
			setInterval(function() {
					$("#tablePanel").load("rawdata.php");
				}, 30000);
			});
		</script>
	</head>
<style>
#dashboard {
	font-family: Arial
	border-collapse: collapse;
	width: 100%;
}

#dashboard td, #dashboard th {
	border: 1px solid #081528;
	padding: 8px;
}

#dashboard tr:nth-child(even){background-color: #f2f2f2;}

#dashboard tr:hover(even){background-color: #081528;}

#dashboard th {
	padding-top: 12px;
	padding-bottom: 12px;
	text-align: left;
	background-color: #081528;
	color: white;
}
#heading {
	font-family: Arial
	border-collapse: collapse;
	width: 100%;
}

#heading td, #heading th {
	border: 1px solid #797979;
	padding: 8px;
}

#heading tr:nth-child(even){background-color: #f2f2f2;}

#heading tr:hover(even){background-color: #797979;}

#heading th {
	padding-top: 12px;
	padding-bottom: 12px;
	text-align: left;
	background-color: #797979;
	color: white;
}
#header {
	font-family: Arial
	border-collapse: collapse;
	width: 100%;
}

#header td, #header th {
	border: 1px solid #081528;
	padding: 8px;
}

#header tr:nth-child(even){background-color: #f2f2f2;}

#header tr:hover(even){background-color: #081528;}

#header th {
	padding-top: 12px;
	padding-bottom: 12px;
	text-align: left;
	background-color: #081528;
	color: white;
}
</style>
	<body class="loggedin" bgcolor="EEFDEF">
		<nav class="navtop">
			<div>
				<img src="./images/Square-logo.jpg">
				<h1>Export Data</h1>
                <a href="dashboard.php"><i class="fas fa-arrow-left"></i>Back</a>
			</div>
		</nav>
		<form action="/export_data.php" style="margin-top:10px; margin-bottom:10px;" method="get">
	   		<center><b><label for="mac">MAC:</b></label>
	    	<input type="text" id="mac" name="mac" placeholder="Eg. 582d343b6237" required>
            <b><label for="from">FROM:</b></label>
            <input type="text" id="from" name="from" placeholder="Eg. 2020-11-23 00:00:00" required>
            <b><label for="to">TO:</b></label>
            <input type="text" id="to" name="to" placeholder="Eg. 2020-11-23 00:00:00" required>
            <b><input type="submit" value="Download"></b>
		</form>
        <form style="margin-top:10px;">
            <b><a href="download.php" class="btn btn-primary btn-sm">Download all</a></b>
        </form>
		<form style="margin-top:10px; margin-bottom:10px;">
			<center><b><label>Available MAC Addresses</b></label>
			<li><?php echo $mac1; ?></li>
			<li><?php echo $mac2; ?></li></center>
		</form>
		<form>
			<?php
				session_start();
				if(isset($_SESSION['message'])){
					echo $_SESSION['message'];

					unset($_SESSION['message']);
				}
			?>
		</form>
        <form>
			<div id="tablePanel">
			<?php
				include 'rawdata.php';
			?>
			</div>
		</form>