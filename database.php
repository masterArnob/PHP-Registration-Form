<?php
$dbMechine = "localhost";
$userName = "root";
$pass = "";
$dbName = "person";
$con = "";

try {
    $con = mysqli_connect($dbMechine, $userName, $pass, $dbName);
    echo "database connection successfully";
} catch (mysqli_sql_exception) {
    echo "database connection failed";
}
