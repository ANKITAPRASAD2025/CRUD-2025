<?php

$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "crud-2025";

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

if (!$conn) {
    die("connection failed: " . mysqli_connect_error());
} else {
    echo "connection successful";
}
