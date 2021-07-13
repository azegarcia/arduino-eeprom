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
        </div>
    </nav>
    <form action="filter.php" style="margin-top:10px; margin-bottom:10px;" method="get">
        <center><b><label for="serial">Serial Number:</b></label>
            <input type="text" id="serial" name="serial" placeholder="Eg. CB1701" required>
            <b><input type="submit" id="mybutton" value="Apply"></b>
    </form>
    <div></div>
    <div id="form1"><?php include 'data.php'; ?></div>
</body>

</html>