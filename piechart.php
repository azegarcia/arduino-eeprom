<style>
    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 320px;
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


    input[type="number"] {
        min-width: 50px;
    }
</style>
<figure class="highcharts-figure">
    <div id="container"></div>
</figure>
<?php
ini_set('display_errors', 1); // set to 0 for production version
error_reporting(E_ALL);

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'admin';
$DATABASE_PASS = 'admin';
$DATABASE_NAME = 'ibpm';

$con = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ($con->connect_error) {
    // If there is an error with the connection, stop the script and display the error.
    die('<script>alert("Failed to connect to the database. Please try again.")</script>');
}
$result1701 = mysqli_query($con, "SELECT SOCKETNAME, WORKWEEK, SITETOTAL FROM ibpmcosting WHERE SOCKETNAME='CB1701' AND REPLACEFREQUENCY='0' ORDER BY SITETOTAL_ACCUMULATEDCOUNT");

$data = array();
$week = array();
while ($row = mysqli_fetch_assoc($result1701)) {
    $serial = $row["SOCKETNAME"];
    $work = $row["WORKWEEK"];
    $daily = $row["SITETOTAL"];
    $data[] = $daily;
    $week[] = $work;
}
?>
<script>
    Highcharts.chart('container', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: '<?php echo $serial; ?>, 2021'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            name: 'Test only',
            colorByPoint: true,
            data: [{
                name: '<?php echo $week[0]; ?>',
                y: <?php echo $data[0]; ?>,
                sliced: true,
                selected: true
            }, {
                name: '<?php echo $week[1]; ?>',
                y: <?php echo $data[1]; ?>
            }, {
                name: '<?php echo $week[2]; ?>',
                y: <?php echo $data[2]; ?>
            }, {
                name: '<?php echo $week[3]; ?>',
                y: <?php echo $data[3]; ?>
            }, {
                name: '<?php echo $week[4]; ?>',
                y: <?php echo $data[4]; ?>
            }, {
                name: '<?php echo $week[5]; ?>',
                y: <?php echo $data[5]; ?>
            }, {
                name: '<?php echo $week[6]; ?>',
                y: <?php echo $data[6]; ?>
            }, {
                name: '<?php echo $week[7]; ?>',
                y: <?php echo $data[7]; ?>
            }, {
                name: '<?php echo $week[8]; ?>',
                y: <?php echo $data[8]; ?>
            }]
        }]
    });
</script>