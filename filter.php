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
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
        padding: 6px;
    }

    #dashboard1 tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #dashboard1 tr:hover(even) {
        background-color: #8aff8a;
    }

    #dashboard1 th {
        padding-top: 6px;
        padding-bottom: 6px;
        text-align: left;
        background-color: #8aff8a;
        color: black;
    }

    .button {
        background-color: gray;
        color: black;
        font-weight: bold;
        text-align: center;
        display: inline-block;
        font-size: 14px;
        cursor: pointer;
        padding: 5px 18px;
        margin: 0px 30px 0px 30px;
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
</style>

<body class="loggedin" style="background-color:white;">
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

    $conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

    $sql = "SELECT SOCKETNAME, WORKWEEK, PRODUCTIONDATE, SITETOTAL, SITETOTAL_ACCUMULATEDCOUNT, REPLACEFREQUENCY FROM ibpmcosting 
    WHERE SOCKETNAME='" . $serialno . "' AND REPLACEFREQUENCY='0' AND WORKWEEK='" . $work . "' ORDER BY SITETOTAL_ACCUMULATEDCOUNT DESC LIMIT 1";
    $sql1 = "SELECT COUNT(REPLACEFREQUENCY) as lifespan FROM ibpmcosting WHERE SOCKETNAME='" . $serialno . "' AND WORKWEEK='" . $work . "'";
    $sql2 = "SELECT SUM(SITETOTAL) as weekly FROM ibpmcosting WHERE SOCKETNAME='" . $serialno . "' AND WORKWEEK='" . $work . "'";

    $result = $conn->query($sql);
    $results = $conn->query($sql1);
    $resultss = $conn->query($sql2);

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
                        <font face="Arial">Work Week</font>
                    </center>
                </th>
                <th>
                    <center>
                        <font face="Arial">Daily Insertion</font>
                    </center>
                </th>
                <th>
                    <center>
                        <font face="Arial">Weekly Insertion</font>
                    </center>
                </th>
                <th>
                    <center>
                        <font face="Arial">CF Lifespan</font>
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
        ?>
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
                        <center><?php echo $daily; ?></center>
                    </td>
                <?php
            }
            while ($rowss = mysqli_fetch_array($resultss)) {
                $weekly = $rowss["weekly"];
                ?>
                    <td>
                        <center><?php echo $weekly; ?></center>
                    </td>
                <?php
            }
            while ($rows = mysqli_fetch_array($results)) {
                $life = $rows["lifespan"];
                ?>
                    <td>
                        <center><?php echo $life; ?></center>
                    </td>
                </tr>
            </tbody>
        <?php
            }
        ?>
    </table>
    <table id="dashboard1" class="table" border="0" cellspacing="2" cellpadding="2" align="center">
        <tr>
            <th>
                <center>
                    <font face="Arial">Weekly and Monthly Graph</font>
                </center>
            </th>
        </tr>
    </table>

    <!-- WEEKLY PART -->

    <div style="float:left;height:360px;width:675px;margin-top:0px;margin-bottom:0px;margin-left:2px;">
        <figure class=" highcharts-figure">
            <div id="container"></div>
        </figure>
        <?php
        ini_set('display_errors', 1); // set to 0 for production version
        error_reporting(E_ALL);

        $serialnos = $_GET['serial'];
        $work = $_GET['week'];

        $DATABASE_HOST = 'localhost';
        $DATABASE_USER = 'admin';
        $DATABASE_PASS = 'admin';
        $DATABASE_NAME = 'ibpm';

        $con = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
        if ($con->connect_error) {
            // If there is an error with the connection, stop the script and display the error.
            die('<script>alert("Failed to connect to the database. Please try again.")</script>');
        }
        $week1 = mysqli_query($con, "SELECT WORKWEEK, SUM(SITETOTAL) AS Weekly FROM `ibpmcosting` WHERE SOCKETNAME='" . $serialno . "' GROUP BY WORKWEEK") or die(mysqli_error($conn));

        $dat = array();
        $weeks = array();
        while ($rowsss = mysqli_fetch_assoc($week1)) {
            $works = $rowsss["WORKWEEK"];
            $weeklyy = $rowsss["Weekly"];
            $dat[] = $weeklyy;
            $weeks[] = $works;
        }
        ?>
        <script>
            Highcharts.chart('container', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: '<?php echo $serialnos; ?> Weekly'
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    categories: ['<?php echo $weeks[0]; ?>',
                        '<?php echo $weeks[1]; ?>',
                        '<?php echo $weeks[2]; ?>',
                        '<?php echo $weeks[3]; ?>',
                        '<?php echo $weeks[4]; ?>',
                        '<?php echo $weeks[5]; ?>',
                        '<?php echo $weeks[6]; ?>',
                        '<?php echo $weeks[7]; ?>',
                        '<?php echo $weeks[8]; ?>',
                        '<?php echo $weeks[9]; ?>',
                        '<?php echo $weeks[10]; ?>',
                        '<?php echo $weeks[11]; ?>',
                        '<?php echo $weeks[12]; ?>',
                        '<?php echo $weeks[13]; ?>',
                        '<?php echo $weeks[14]; ?>',
                        '<?php echo $weeks[15]; ?>',
                        '<?php echo $weeks[16]; ?>',
                        '<?php echo $weeks[17]; ?>',
                        '<?php echo $weeks[18]; ?>',
                        '<?php echo $weeks[19]; ?>',
                        '<?php echo $weeks[20]; ?>',
                        '<?php echo $weeks[21]; ?>',
                        '<?php echo $weeks[22]; ?>',
                        '<?php echo $weeks[23]; ?>',
                        '<?php echo $weeks[24]; ?>',
                        '<?php echo $weeks[25]; ?>'
                    ]
                },
                yAxis: {
                    title: {
                        text: 'Insertions'
                    },
                    plotLines: [{
                        color: '#FF0000',
                        width: 2,
                        value: 700000
                    }]
                },
                plotOptions: {
                    series: {
                        threshold: 700000
                    },
                    line: {
                        dataLabels: {
                            enabled: false
                        },
                        enableMouseTracking: true
                    }
                },
                series: [{
                    name: '<?php echo $serialnos; ?>',
                    data: [<?php echo $dat[0]; ?>,
                        <?php echo $dat[1]; ?>,
                        <?php echo $dat[2]; ?>,
                        <?php echo $dat[3]; ?>,
                        <?php echo $dat[4]; ?>,
                        <?php echo $dat[5]; ?>,
                        <?php echo $dat[6]; ?>,
                        <?php echo $dat[7]; ?>,
                        <?php echo $dat[8]; ?>,
                        <?php echo $dat[9]; ?>,
                        <?php echo $dat[10]; ?>,
                        <?php echo $dat[11]; ?>,
                        <?php echo $dat[12]; ?>,
                        <?php echo $dat[13]; ?>,
                        <?php echo $dat[14]; ?>,
                        <?php echo $dat[15]; ?>,
                        <?php echo $dat[16]; ?>,
                        <?php echo $dat[17]; ?>,
                        <?php echo $dat[18]; ?>,
                        <?php echo $dat[19]; ?>,
                        <?php echo $dat[20]; ?>,
                        <?php echo $dat[21]; ?>,
                        <?php echo $dat[22]; ?>,
                        <?php echo $dat[23]; ?>,
                        <?php echo $dat[24]; ?>,
                        <?php echo $dat[25]; ?>
                    ]
                }]
            });
        </script>
    </div>

    <!-- MONTHLY PART -->

    <div style="float:left;height:360px;width:675px;margin-top:0px;margin-bottom:0px;margin-left:2px;">
        <figure class="highcharts-figure">
            <div id="containers"></div>
        </figure>
        <?php
        ini_set('display_errors', 1); // set to 0 for production version
        error_reporting(E_ALL);

        $serialnos = $_GET['serial'];
        $work = $_GET['week'];

        $DATABASE_HOST = 'localhost';
        $DATABASE_USER = 'admin';
        $DATABASE_PASS = 'admin';
        $DATABASE_NAME = 'ibpm';

        $con = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
        if ($con->connect_error) {
            // If there is an error with the connection, stop the script and display the error.
            die('<script>alert("Failed to connect to the database. Please try again.")</script>');
        }
        $month1 = mysqli_query($con, "SELECT SOCKETNAME, WORKWEEK, SUM(SITETOTAL) AS Monthly FROM ibpmcosting WHERE SOCKETNAME='" . $serialno . "' AND WORKWEEK BETWEEN 'WW1-2021' AND 'WW4-2021' GROUP BY WORKWEEK limit 4") or die(mysqli_error($conn));
        $month2 = mysqli_query($con, "SELECT SOCKETNAME, WORKWEEK, SUM(SITETOTAL) AS Monthly FROM ibpmcosting WHERE SOCKETNAME='" . $serialno . "' AND WORKWEEK BETWEEN 'WW5-2021' AND 'WW8-2021' GROUP BY WORKWEEK limit 4") or die(mysqli_error($conn));
        $month3 = mysqli_query($con, "SELECT SOCKETNAME, WORKWEEK, SUM(SITETOTAL) AS Monthly FROM ibpmcosting WHERE SOCKETNAME='" . $serialno . "' AND WORKWEEK BETWEEN 'WW9-2021' AND 'WW12-2021' GROUP BY WORKWEEK limit 4") or die(mysqli_error($conn));
        $month4 = mysqli_query($con, "SELECT SOCKETNAME, WORKWEEK, SUM(SITETOTAL) AS Monthly FROM ibpmcosting WHERE SOCKETNAME='" . $serialno . "' AND WORKWEEK BETWEEN 'WW13-2021' AND 'WW16-2021' GROUP BY WORKWEEK limit 4") or die(mysqli_error($conn));
        $month5 = mysqli_query($con, "SELECT SOCKETNAME, WORKWEEK, SUM(SITETOTAL) AS Monthly FROM ibpmcosting WHERE SOCKETNAME='" . $serialno . "' AND WORKWEEK BETWEEN 'WW17-2021' AND 'WW20-2021' GROUP BY WORKWEEK limit 4") or die(mysqli_error($conn));
        $month6 = mysqli_query($con, "SELECT SOCKETNAME, WORKWEEK, SUM(SITETOTAL) AS Monthly FROM ibpmcosting WHERE SOCKETNAME='" . $serialno . "' AND WORKWEEK BETWEEN 'WW21-2021' AND 'WW24-2021' GROUP BY WORKWEEK limit 4") or die(mysqli_error($conn));
        $month7 = mysqli_query($con, "SELECT SOCKETNAME, WORKWEEK, SUM(SITETOTAL) AS Monthly FROM ibpmcosting WHERE SOCKETNAME='" . $serialno . "' AND WORKWEEK BETWEEN 'WW25-2021' AND 'WW27-2021' GROUP BY WORKWEEK limit 4") or die(mysqli_error($conn));

        $dat = array();
        while ($rowsss = mysqli_fetch_assoc($month1)) {
            $monthlyy = $rowsss["Monthly"];
            $dat[] = $monthlyy;
            $data1 = array_sum($dat);
        }
        ?>
        <script>
            Highcharts.chart('containers', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: '<?php echo $serialnos; ?> Monthly'
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    categories: ['1st Month',
                        '2nd Month',
                        '3rd Month',
                        '4th Month',
                        '5th Month',
                        '6th Month',
                        '7th Month'
                    ]
                },
                yAxis: {
                    title: {
                        text: 'Insertions'
                    },
                    plotLines: [{
                        color: '#FF0000',
                        width: 2,
                        value: 700000
                    }]
                },
                plotOptions: {
                    series: {
                        threshold: 700000
                    },
                    line: {
                        dataLabels: {
                            enabled: false
                        },
                        enableMouseTracking: true
                    }
                },
                series: [{
                    name: '<?php echo $serialnos; ?>',
                    data: [<?php echo $data1; ?>,
                        <?php
                        $dat = array();
                        while ($rowsss = mysqli_fetch_assoc($month2)) {
                            $monthlyy = $rowsss["Monthly"];
                            $dat[] = $monthlyy;
                            $data2 = array_sum($dat);
                        } ?>
                        <?php echo $data2; ?>,
                        <?php echo $data1; ?>,
                        <?php
                        $dat = array();
                        while ($rowsss = mysqli_fetch_assoc($month4)) {
                            $monthlyy = $rowsss["Monthly"];
                            $dat[] = $monthlyy;
                            $data4 = array_sum($dat);
                        } ?>
                        <?php echo $data4; ?>,
                        <?php
                        $dat = array();
                        while ($rowsss = mysqli_fetch_assoc($month5)) {
                            $monthlyy = $rowsss["Monthly"];
                            $dat[] = $monthlyy;
                            $data5 = array_sum($dat);
                        } ?>
                        <?php echo $data5; ?>,
                        <?php
                        $dat = array();
                        while ($rowsss = mysqli_fetch_assoc($month6)) {
                            $monthlyy = $rowsss["Monthly"];
                            $dat[] = $monthlyy;
                            $data6 = array_sum($dat);
                        } ?>
                        <?php echo $data6; ?>,
                        <?php
                        $dat = array();
                        while ($rowsss = mysqli_fetch_assoc($month7)) {
                            $monthlyy = $rowsss["Monthly"];
                            $dat[] = $monthlyy;
                            $data7 = array_sum($dat);
                        } ?>
                        <?php echo $data7; ?>
                    ]
                }]
            });
        </script>
    </div>
</body>

</html>