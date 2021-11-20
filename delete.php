<?php
    require_once('connection.php');
    $employee_id = mysqli_real_escape_string($mysqli, $_GET['id']);
    $sql = "DELETE FROM employee
            WHERE EmployeeID = '$employee_id'";
    $res = $mysqli->query($sql);
    $mysqli->close();
    header("Location: index.php");
    exit;
?>