<?php
require_once("connection.php");
if($mysqli === false){
    die("Connection failed".$mysqli->connect_error);
}else{
    $sql = "CREATE DATABASE testdb";
    $result = $mysqli->query($sql);
    if($result){
        echo "Database is successfully created";
    }else{
echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
    }
}
$mysqli->close();
?>