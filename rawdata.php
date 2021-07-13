<?php
ini_set('display_errors', 1); // set to 0 for production version
 error_reporting(E_ALL);

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'temphumiduser';
$DATABASE_PASS = 'temphumid2021';
$DATABASE_NAME = 'temphumid';

$sensorObj = new stdClass();

$con = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ($con->connect_error) {
	// If there is an error with the connection, stop the script and display the error.
	die('<script>alert("Failed to connect to the database. Please try again.")</script>');
}
$result = mysqli_query($con, "SELECT * FROM temptable ORDER BY timestamp DESC LIMIT 12");
?>
<?php
if (mysqli_num_rows($result) > 0) {
	$user_arr = array();
    ?>
        <table id="dashboard" class="table" border="0" cellspacing="2" cellpadding="2" align="center" style="width:100%; height:100px;"> 
		  <thead>
            <tr class="filters"> 
          		<th> <center><font face="Arial">Timestamp</font></center> </th> 
          		<th> <center><font face="Arial">MAC</font></center> </th>
				<th> <center><font face="Arial">Temperature</font></center> </th> 
          		<th> <center><font face="Arial">Humidity</font></center> </th> 
          		<th> <center><font face="Arial">Battery</font></center> </th> 
      		</tr>
		  </thead>
<?php
	$i=0;
	while($row = mysqli_fetch_array($result)){
		$time = strtotime($row["timestamp"]);
		$timestamp = date("Y-m-d H:i:s A", $time + 25200);
		$mac = $row["macAddress"];
		$temp = $row["temperature"];
		$humid = $row["humidity"];
		$batt = $row["battery"];
?>
		  <tbody>
       		<tr>
                <td><center><?php echo $timestamp; ?></center></td> 
                <td><center><?php echo $mac; ?></center></td> 
				<td><center><?php echo $temp; ?></center></td>
                <td><center><?php echo $humid; ?></center></td> 
                <td><center><?php echo $batt; ?></center></td> 
            </tr>
		  </tbody>
<?php	
}
?>
</table>
<span id="rowcount"></span>
<?php
}else{
	echo "No Results Found";
}
?>
</body>
</html>