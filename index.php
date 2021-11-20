<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    <link rel="stylesheet" type="text/css" href="style.css" >
    <title>Document</title>
</head>
<body>
    <div class="title">
        <h1>Employees Details</h1>
        <a class="add" href="addEmployee.php">Add Employee</a>
    </div>
        <table class="albumsTable">
            <thead>
                <tr>
                    <th scope="col">EmployeeID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Date Of Birth</th>
                    <th scope="col" >Address</th>
                    <th scope="col">Email</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Note</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            
<?php
require_once('connection.php');
    if ($mysqli === false) {
        die("Connection failed: " .$mysqli->connect_error);
    } 
    $sql = "SELECT EmployeeID, LastName, FirstName, DATE_FORMAT(BirthDate, '%d/%m/%Y') AS BirthDate, Address, Email,Photo, Note
            FROM employee ";
    $result = $mysqli->query($sql);
    if ($result->num_rows >= 1) {
        while ($row = $result->fetch_assoc()) {
            $employeeID = $row['EmployeeID'];
            $lastName = $row['LastName'];
            $firstName = $row['FirstName'];
            $birthDate = $row['BirthDate'];
            $address = $row['Address'];
            $email = $row['Email'];
            $photo = $row['Photo'];
            $note = $row['Note'];
?>  
            <tr>      
            <td><?php echo $employeeID ?></td>  
            <td><?php echo $firstName ?></td>
            <td><?php echo $lastName ?></td>
            <td><?php echo $birthDate ?></td> 
            <td><?php echo $address ?></td>    
            <td><?php echo $email ?></td> 
            <td><img src="<?php echo $photo ?>" alt="" class="img-circle" style="width:100px;height:100px;"/></td>
            <td><?php echo $note ?></td>
            <td><div class="a"><a href="viewEmployee.php?id=<?php echo $row['EmployeeID']?>" ><i class='fas fa-eye'></i></a>
                <a href="editEmployee.php?id=<?php echo $row['EmployeeID']?>" ><i class='fas fa-pencil-alt'></i></a>
                <a href="delete.php?id=<?php echo $row['EmployeeID'] ?>" ><i class='far fa-trash-alt'></i></a>
        </div></td>
            </tr>
        <?php } ?>
        </table>
    <?php } ?>                     
</body>
</html>
