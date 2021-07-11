<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Cost Computation</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link href="style1.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="shortcut icon" href="./images/logo.jpg"/>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
		<link rel="stylesheet" href="css/bootstrap-custom.css">
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</head>
<style>
#dashboard {
	font-family: Arial
	border-collapse: collapse;
	width: 100%;
}
#heading {
	font-family: Arial
	border-collapse: collapse;
	width: 100%;
}
#header {
	font-family: Arial
	border-collapse: collapse;
	width: 100%;
}
</style>
	<body class="loggedin" bgcolor="EEFDEF">
	<nav class="navtop">
		<div>
			<img src="./images/logo.jpg">
			<h1>  IBPM Cost Computation</h1>
		</div>
	</nav>
	<div>
		<?php
		ini_set('display_errors', 1); // set to 0 for production version
		error_reporting(E_ALL);

		$DATABASE_HOST = 'localhost';
		$DATABASE_USER = 'ibpm';
		$DATABASE_PASS = 'ibpmcost2021';
		$DATABASE_NAME = 'ibpm';

		$sensorObj = new stdClass();

		$con = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

		if ($con->connect_error) {
			// If there is an error with the connection, stop the script and display the error.
			die('<script>alert("Failed to connect to the database. Please try again.")</script>');
		}
		?>
		<h5><b><center>Import CSV/XLSX File</center></b></h5>
		<b><center><form method="post" enctype="multipart/form-data">
			<input type="file" name="fileToUpload" id="fileToUpload">
			<input type="submit" value="Upload Excel Data" name="submit">
			<input type="submit" value="Send" name="send">
    	</form></center></b>
				<table id="dashboard" class="table" border="0" cellspacing="2" cellpadding="2" align="center" style="width:100%;">
					<thead class="bg-success text-white" >
						<tr>
							<th scope="col"><font color="black"><center>Serial Number</center></font></th>
							<th scope="col"><font color="black"><center>WW</center></font></th>
							<th scope="col"><font color="black"><center>Date</center></font></th>
							<th scope="col"><font color="black"><center>Daily Insertion</center></font></th>
							<th scope="col"><font color="black"><center>Total Insertion</center></font></th>
							<th scope="col"><font color="black"><center>Replacement</center></font></th>
						</tr>
					</thead>
					<tbody>
					<?php   
						$select1 = 'SELECT * FROM ibpmcost GROUP BY serialnumber';
						$result1 = mysqli_query($con, $select1);
						while($row1 = mysqli_fetch_array($result1)){
							$select2 = 'select sum(dailyinsertion) as daily, replacement, ww, date from ibpmcost where serialnumber = "'.$row1['serialnumber'].'" group by ww ';
							$result2 = mysqli_query($con, $select2);
							while($row2 = mysqli_fetch_array($result2)){
								if($row2['replacement']==0) {
									echo '<tr>';
									echo '<td>'.$row1['serialnumber'].'</td>';
									echo '<td>'.$row2['ww'].'</td>';
									echo '<td>'.$row2['date'].'</td>';
									echo '<td>'.$row2['dailyinsertion'].'</td>';
									echo '<td>'.$row2['replacement'].'</td>';
									echo '<td></td>';
									echo '<td></td>';
									echo '</tr>';
								}
							}
						}
					?> 
					</tbody>
				</table>
			</div>
		    <?php
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
				$target_dir = "file/";
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

				if (file_exists($target_file)) {
					echo "Sorry, file already exists.";
					$uploadOk = 0;
				}
				// Check file size
				if ($_FILES["fileToUpload"]["size"] > 100000000) {
					echo "Sorry, your file is too large.";
					$uploadOk = 0;
				}
				if ($uploadOk == 0) {
					echo "Sorry, your file was not uploaded.";
				
				} else {
					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
					} else {
					echo "Sorry, there was an error uploading your file.";
					}
				}
			}
			?>
    		<?php
			$temp = 0;
			if(isset($_POST['send'])){
				$filepath = 'file/27.xlsx';
				$reader = ReaderEntityFactory::createXLSXReader();
				$reader->setShouldFormatDates(true);
				// $reader->setShouldPreserveEmptyRows(true);
				$reader->open($filepath);

				$setter=0;
				foreach ($reader->getSheetIterator() as $sheet) {
					if ($sheet->getName() === 'Sheet1') {
						foreach ($sheet->getRowIterator() as $key => $row) {
							$cells = $row->getCells();

							if($key == 1){
								continue;
							}
							else{
								// do something with the row
								$pr1 = $cells[1];
								$pr0 = $cells[0];
								$pr2 = $cells[2];
								$pr6 = $cells[6];
								$pr7 = $cells[7];
								$pr12 = $cells[12];

								$insert_data='INSERT into ibpmcost (serialnumber,ww,date,dailyinsertion,totalinsertion,replacement) values ("'.$pr0.'","'.$pr1.'","'.$pr2.'","'.$pr6.'","'.$pr7.'","'.$pr12.'")';
								$result= mysqli_query($con,$insert_data);
							}	
						}
						break; // no need to read more sheets
					}
				}
				if($setter==1){
					// echo 'data was alresdy exist!';
				}
				$reader->close(); 
			}
			echo $temp;
			?>
	</body>
</html>
