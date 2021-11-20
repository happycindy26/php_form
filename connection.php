<?php
$localhost = "localhost";
$username = "root";
$password = "";
$database = "testdb";

$mysqli = new mysqli($localhost, $username, $password, $database);
if ($mysqli === false) {
    die("Connection failed ". $mysqli->connect_error);
}
?>