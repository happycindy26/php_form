<?php
require_once('connection.php');
if($mysqli === false){
    die("Connection failed".$mysqli->connect_error);

}else{
    $sql = "CREATE TABLE employee(
        EmployeeID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
        LastName varchar(60) NOT NULL,
        FirstName varchar(60) NOT NULL,
        BirthDate date NOT NULL,
        Address varchar(100) NOT NULL,
        Email varchar(100) NOT NULL UNIQUE,
        Photo varchar(1000) NOT NULL,
        Note text NOT NULL)";

    $result = $mysqli->query($sql);
    if($result){
        echo "Table is successfully created";
    }else{
        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
    }
}

?>