<?php
if (isset($_POST["submit_file"])) {
    $file = $_FILES["file"]["tmp_name"];
    $file_open = fopen($file, "r");
    while (($csv = fgetcsv($file_open, 1000, ",")) !== false) {
        $name = $csv[0];
        $age = $csv[1];
        $country = $csv[2];
        mysqli_query($conn, "INSERT INTO ibpmcosting VALUES ('$name', '$age', '$country')");
    }
}
