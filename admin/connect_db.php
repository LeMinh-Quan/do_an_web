<?php
function connect_db() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "my_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    return $conn;
}
?>
