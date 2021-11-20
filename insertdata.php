<?php
require_once('connection.php');
if($mysqli === false){
    die("Connection failed".$mysqli->connect_error);

}else{
    $sql = "INSERT INTO employee(LastName, FirstName, BirthDate, Address, Email, Note)
            VALUES('Han', 'Sam', '1995-02-05', '10 Fairfield st, Sydney', 'han@yahmail.com', 'He\'s \"young\"')";

    $result = $mysqli->query($sql);
    if($result){
        echo "Data has been entered";
    }else{
        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
    }
}

?>