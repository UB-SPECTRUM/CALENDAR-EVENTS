<?php
    header('content-type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");

    if(class_exists("PDO")){
        echo "Has PDO";
    } else {
        echo "No PDO";
    }

    $hostname = "localhost";
    $dbusername = getenv("UB_SPECTRUM_DB_USER");
    $dbpassword = "";
    $dbName = getenv("UB_SPECTRUM_DB");
    $conn = mysqli_connect($hostname, $dbusername, $dbpassword, $dbName) or die('Unable to connect');
    mysqli_set_charset($conn,'utf8');

    // $name = htmlentities($_POST['name']) or '';
    // $venue = htmlentities($_POST['end']) or '';
    // $categories = htmlentities($_POST['categories']) or '';



?>