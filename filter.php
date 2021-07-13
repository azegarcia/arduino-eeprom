<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>TESTING ONLY</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="style1.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="shortcut icon" href="" />
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
</head>
<style>
    #dashboard1 {
        font-family: Arial;
        border-collapse: collapse;
        width: 100%;
    }

    #dashboard1 td,
    #dashboard1 th {
        border: 1px solid #8aff8a;
        padding: 7px;
    }

    #dashboard1 tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #dashboard1 tr:hover(even) {
        background-color: #8aff8a;
    }

    #dashboard1 th {
        padding-top: 7px;
        padding-bottom: 7px;
        text-align: left;
        background-color: #8aff8a;
        color: black;
    }
</style>

<body class="loggedin" bgcolor="EEFDEF">
    <nav class="navtop">
        <div>
            <img src="">
            <h1> TEST ONLY</h1>
            <a href="main.php"><i class="fas fa-arrow-left"></i>Back</a>
        </div>
    </nav>
    <?php

    ini_set('display_errors', 1); // set to 0 for production version
    error_reporting(E_ALL);

    $serialno = $_GET['serial'];
    $work = $_GET['week'];

    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'admin';
    $DATABASE_PASS = 'admin';
    $DATABASE_NAME = 'ibpm';

    $sensorObj = new stdClass();

    $conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

    $sql = "SELECT * (SELECT SOCKETNAME, WORKWEEK, PRODUCTIONDATE, SITETOTAL, SITETOTAL_ACCUMULATEDCOUNT, REPLACEFREQUENCY FROM ibpmcosting 
    WHERE SOCKETNAME='" . $serialno . "' AND REPLACEFREQUENCY='0' ORDER BY SITETOTAL_ACCUMULATEDCOUNT DESC LIMIT 1) as FIRST, 
    (SELECT COUNT(REPLACEFREQUENCY) as lifespan FROM ibpmcosting WHERE SOCKETNAME='" . $serialno . "' AND WORKWEEK='" . $work . "') as SECOND";

    $result = $conn->query($sql);

    if (mysqli_num_rows($result) > 0) {
        $user_arr = array();
    ?>
        <table id="dashboard1" class="table" border="0" cellspacing="2" cellpadding="2" align="center" style="width:100%;">
            <thead>
                <tr class="filters">
                    <th>
                        <center>
                            <font face="Arial">Production Date</font>
                        </center>
                    </th>
                    <th>
                        <center>
                            <font face="Arial">Serial Number</font>
                        </center>
                    </th>
                    <th>
                        <center>
                            <font face="Arial">Work Week Ended</font>
                        </center>
                    </th>
                    <th>
                        <center>
                            <font face="Arial">CF Lifespan</font>
                        </center>
                    </th>
                    <th>
                        <center>
                            <font face="Arial">Total Insertion</font>
                        </center>
                    </th>
                </tr>
            </thead>
            <?php
            $i = 0;
            while ($row = mysqli_fetch_array($result)) {
                $serial = $row["SOCKETNAME"];
                $ww = $row["WORKWEEK"];
                $prod = $row["PRODUCTIONDATE"];
                $daily = $row["SITETOTAL"];
                $total = $row["SITETOTAL_ACCUMULATEDCOUNT"];
                $replace = $row["lifespan"];        ?>
                <tbody>
                    <tr>
                        <td>
                            <center><?php echo $prod; ?></center>
                        </td>
                        <td>
                            <center><?php echo $serial; ?></center>
                        </td>
                        <td>
                            <center><?php echo $ww; ?></center>
                        </td>
                        <td>
                            <center><?php echo $replace; ?></center>
                        </td>
                        <td>
                            <center><?php echo $total; ?></center>
                        </td>
                    </tr>
                </tbody>
            <?php
            }
            ?>
        </table>
        <span id="rowcount"></span>
    <?php
    } else {
        echo "No Results Found";
    }
    ?>
    <div>
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
        $result1701 = mysqli_query($con, "SELECT SOCKETNAME, WORKWEEK, SITETOTAL FROM ibpmcosting WHERE SOCKETNAME='" . $serialno . "' AND REPLACEFREQUENCY='0' ORDER BY SITETOTAL_ACCUMULATEDCOUNT");

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
    </div>
</body>

</html>