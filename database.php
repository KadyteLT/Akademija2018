<?php

if (getenv("CLEARDB_DATABASE_URL")) {
    $dburl = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $dbhost = $dburl["host"];
    $dbusername = $dburl["user"];
    $dbpassword = isset($dburl["pass"]) ? $dburl["pass"] : '';
    $dbdatabase = substr($dburl["path"], 1);
//} else {
//    $dbhost = "localhost";
//    $dbusername = "root";
//    $dbpassword = "";
//    $dbdatabase = "jumpers_eshop";
}

$connect = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbdatabase);
mysqli_set_charset($connect, 'utf8mb4');
