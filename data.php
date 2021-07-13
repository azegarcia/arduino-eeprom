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
$result = mysqli_query($con, "SELECT SOCKETNAME, WORKWEEK, PRODUCTIONDATE, SITETOTAL, SITETOTAL_ACCUMULATEDCOUNT, REPLACEFREQUENCY FROM ibpmcosting ORDER BY WORKWEEK");
?>
<?php
if (mysqli_num_rows($result) > 0) {
    $user_arr = array();
?>
    <table id="dashboard1" class="table" border="0" cellspacing="2" cellpadding="2" align="center" style="width:100%; margin-top:10px;">
        <thead>
            <tr class="filters">
                <th>
                    <center>
                        <font face="Arial">Date</font>
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
                        <font face="Arial">Daily</font>
                    </center>
                </th>
                <th>
                    <center>
                        <font face="Arial">Total</font>
                    </center>
                </th>
                <th>
                    <center>
                        <font face="Arial">Replacement</font>
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
            $replace = $row["REPLACEFREQUENCY"];
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
                    <td>
                        <center><?php echo $total; ?></center>
                    </td>
                    <td>
                        <center><?php echo $replace; ?></center>
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
</body>

</html>