<?php
ini_set('display_errors', 1); // set to 0 for production version
error_reporting(E_ALL);

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'temphumiduser';
$DATABASE_PASS = 'temphumid2021';
$DATABASE_NAME = 'temphumid';

$sensorObj = new stdClass();

$conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

$sql = "SELECT * FROM temptable WHERE macAddress='582d343ad474' ORDER BY timestamp DESC LIMIT 15";
$sql1 = "SELECT * FROM temptable WHERE macAddress='582d343ade5d' ORDER BY timestamp DESC LIMIT 15";

$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$results = mysqli_query($conn, $sql1) or die(mysqli_error($conn));

// if (mysqli_num_rows($result) > 0) {
$data = array();
$tempdata = array();
$humiddata = array();
while ($row = mysqli_fetch_assoc($result)) {
  $time = strtotime($row["timestamp"]);
  $timestamp = date("H:i:s A", $time + 25200);
  $temp = $row["temperature"];
  $humid = $row["humidity"];
  $data[] = $timestamp;
  $tempdata[] = $temp;
  $humiddata[] = $humid;
}
?>
<script>
  Highcharts.chart('container', {
    chart: {
      type: 'line'
    },
    title: {
      text: 'Temperature Live Graph'
    },
    subtitle: {
      text: ''
    },
    xAxis: {
      categories: ['<?php echo $data[14]; ?>', '<?php echo $data[13]; ?>', '<?php echo $data[12]; ?>', '<?php echo $data[11]; ?>', '<?php echo $data[10]; ?>', '<?php echo $data[9]; ?>', '<?php echo $data[8]; ?>', '<?php echo $data[7]; ?>', '<?php echo $data[6]; ?>', '<?php echo $data[5]; ?>', '<?php echo $data[4]; ?>', '<?php echo $data[3]; ?>', '<?php echo $data[2]; ?>', '<?php echo $data[1]; ?>', '<?php echo $data[0]; ?>']
    },
    yAxis: {
      title: {
        text: 'Temperature (C)'
      }
    },
    plotOptions: {
      line: {
        dataLabels: {
          enabled: true
        },
        enableMouseTracking: false
      }
    },
    series: [{
        name: 'Temp1',
        data: [<?php echo $tempdata[14]; ?>, <?php echo $tempdata[13]; ?>, <?php echo $tempdata[12]; ?>, <?php echo $tempdata[11]; ?>, <?php echo $tempdata[10]; ?>, <?php echo $tempdata[9]; ?>, <?php echo $tempdata[8]; ?>, <?php echo $tempdata[7]; ?>, <?php echo $tempdata[6]; ?>, <?php echo $tempdata[5]; ?>, <?php echo $tempdata[4]; ?>, <?php echo $tempdata[3]; ?>, <?php echo $tempdata[2]; ?>, <?php echo $tempdata[1]; ?>, <?php echo $tempdata[0]; ?>]
      },
      <?php
      $data = array();
      $tempdata2 = array();
      $humiddata = array();
      while ($row = mysqli_fetch_assoc($results)) {
        $time = strtotime($row["timestamp"]);
        $timestamp = date("H:i:s A", $time + 25200);
        $temp2 = $row["temperature"];
        $humid = $row["humidity"];
        $data[] = $timestamp;
        $tempdata2[] = $temp2;
        $humiddata[] = $humid;
      }
      ?> {
        name: 'Temp2',
        data: [<?php echo $tempdata2[14]; ?>, <?php echo $tempdata2[13]; ?>, <?php echo $tempdata2[12]; ?>, <?php echo $tempdata2[11]; ?>, <?php echo $tempdata2[10]; ?>, <?php echo $tempdata2[9]; ?>, <?php echo $tempdata2[8]; ?>, <?php echo $tempdata2[7]; ?>, <?php echo $tempdata2[6]; ?>, <?php echo $tempdata2[5]; ?>, <?php echo $tempdata2[4]; ?>, <?php echo $tempdata2[3]; ?>, <?php echo $tempdata2[2]; ?>, <?php echo $tempdata2[1]; ?>, <?php echo $tempdata2[0]; ?>]
      }
    ]
  });
</script>
<?php
ini_set('display_errors', 1); // set to 0 for production version
error_reporting(E_ALL);

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'temphumiduser';
$DATABASE_PASS = 'temphumid2021';
$DATABASE_NAME = 'temphumid';

$sensorObj = new stdClass();

$conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

$sql = "SELECT * FROM temptable WHERE macAddress='582d343ad474' ORDER BY timestamp DESC LIMIT 15";
$sql1 = "SELECT * FROM temptable WHERE macAddress='582d343ade5d' ORDER BY timestamp DESC LIMIT 15";

$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$results = mysqli_query($conn, $sql1) or die(mysqli_error($conn));

// if (mysqli_num_rows($result) > 0) {
$data = array();
$tempdata = array();
$humiddata = array();
while ($row = mysqli_fetch_assoc($result)) {
  $time = strtotime($row["timestamp"]);
  $timestamp = date("H:i:s A", $time + 25200);
  $temp = $row["temperature"];
  $humid = $row["humidity"];
  $data[] = $timestamp;
  $tempdata[] = $temp;
  $humiddata[] = $humid;
}
?>
<script>
  Highcharts.chart('containers', {
    chart: {
      type: 'line'
    },
    title: {
      text: 'Humidity Live Graph'
    },
    subtitle: {
      text: ''
    },
    xAxis: {
      categories: ['<?php echo $data[14]; ?>', '<?php echo $data[13]; ?>', '<?php echo $data[12]; ?>', '<?php echo $data[11]; ?>', '<?php echo $data[10]; ?>', '<?php echo $data[9]; ?>', '<?php echo $data[8]; ?>', '<?php echo $data[7]; ?>', '<?php echo $data[6]; ?>', '<?php echo $data[5]; ?>', '<?php echo $data[4]; ?>', '<?php echo $data[3]; ?>', '<?php echo $data[2]; ?>', '<?php echo $data[1]; ?>', '<?php echo $data[0]; ?>']
    },
    yAxis: {
      title: {
        text: 'Humidity (%H)'
      }
    },
    plotOptions: {
      line: {
        dataLabels: {
          enabled: true
        },
        enableMouseTracking: false
      }
    },
    series: [{
        name: 'Humid1',
        data: [<?php echo $humiddata[14]; ?>, <?php echo $humiddata[13]; ?>, <?php echo $humiddata[12]; ?>, <?php echo $humiddata[11]; ?>, <?php echo $humiddata[10]; ?>, <?php echo $humiddata[9]; ?>, <?php echo $humiddata[8]; ?>, <?php echo $humiddata[7]; ?>, <?php echo $humiddata[6]; ?>, <?php echo $humiddata[5]; ?>, <?php echo $humiddata[4]; ?>, <?php echo $humiddata[3]; ?>, <?php echo $humiddata[2]; ?>, <?php echo $humiddata[1]; ?>, <?php echo $humiddata[0]; ?>]
      },
      <?php
      $data = array();
      $tempdata2 = array();
      $humiddata = array();
      while ($row = mysqli_fetch_assoc($results)) {
        $time = strtotime($row["timestamp"]);
        $timestamp = date("H:i:s A", $time + 25200);
        $temp2 = $row["temperature"];
        $humid2 = $row["humidity"];
        $data[] = $timestamp;
        $tempdata2[] = $temp2;
        $humiddata2[] = $humid2;
      }
      ?> {
        name: 'Humid2',
        data: [<?php echo $humiddata2[14]; ?>, <?php echo $humiddata2[13]; ?>, <?php echo $humiddata2[12]; ?>, <?php echo $humiddata2[11]; ?>, <?php echo $humiddata2[10]; ?>, <?php echo $humiddata2[9]; ?>, <?php echo $humiddata2[8]; ?>, <?php echo $humiddata2[7]; ?>, <?php echo $humiddata2[6]; ?>, <?php echo $humiddata2[5]; ?>, <?php echo $humiddata2[4]; ?>, <?php echo $humiddata2[3]; ?>, <?php echo $humiddata2[2]; ?>, <?php echo $humiddata2[1]; ?>, <?php echo $humiddata2[0]; ?>]
      }
    ]
  });
</script>