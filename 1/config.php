<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "test_db";

//Connect to MySQL Server
$con = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

// if(!$con)
//     echo "Connection Error.";
// else
//     echo "Database Connection Successfully.";


//    $con -> close();