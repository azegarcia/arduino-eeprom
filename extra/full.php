<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>IMPORT CSV</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="style1.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="shortcut icon" href="" />
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
</style>

<body class="loggedin" style="background-color:white;">
    <nav class="navtop">
        <div>
            <img src="">
            <h1> IMPORT CSV into Database</h1>
            <a href="main.php"><i class="fas fa-arrow-left"></i>Back</a>
        </div>
    </nav>
    <center>
        <form action="upload.php" method="post" enctpe="multipart/form-data" style="margin-top:10px;">
            <b>Select CSV file to upload:</b>
            <input type="file" name="fileToUpload" id="fileToUpload">
            <b><input type="submit" value="Upload CSV File" name="submit"></b>
        </form>
    </center>
</body>

</html>

<?php

// Hostname
$host = "localhost";
// User
$user = "admin";
// Password
$password = "admin";
// Database Name
$db = "ibpm";

// Open a new connection to the MySQL Server
$connection = mysqli_connect($host, $user, $password, $db);

// If the connection fails
if (!$connection) {
    // Display message and terminate the script
    die("Connection failed: " . mysqli_connect_error());
}

// Path to CSV file
// $file = "C:/xampp/htdocs/graph/file/example.csv";
$file = $_FILES["fileToUpload"]["name"];
echo $file;
// Name of table
$table = "test";

// Load CSV file into the table and ignore the first line in file
// This will also replace the existing rows into new ones
$query = <<<eof
    LOAD DATA INFILE '$file'
    REPLACE INTO TABLE $table
    FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"'
    LINES TERMINATED BY '\n'
    IGNORE 1 LINES
    (SOCKETNAME, )
    eof;

// Perform a query on the connected databse
$connection->query($query);
