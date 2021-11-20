<?php
require_once('connection.php');
echo "Current Database version: " 
.mysqli_get_server_info($mysqli) ."<br> Cruuent Date: " 
. date("Y-m-d");

?>