<?php 
require('connection.php');
$employee_id = mysqli_real_escape_string($mysqli, $_GET['id']);
$sql ="SELECT * FROM employee WHERE EmployeeID ='$employee_id'";
if($res = $mysqli->query($sql)){
    if($res->num_rows>0){
      while($row = $res->fetch_array()){
           $employee_id= $row['EmployeeID'];
           $employee_firstname = $row['FirstName'];
           $employee_lastname = $row['LastName'];
           $employee_address = $row['Address'];
           $employee_email = $row['Email'];
           $employee_birthDate = $row['BirthDate'];
           $employee_photo = $row['Photo'];
           $employee_notes = $row['Note'];
        }
    }
}
?>

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
    <main class="viewPage">
        <h2>Employee details</h2>
<?php if(isset($employee_photo)){?>
        <div class="employeeDetails">
            <div>
                <p>Employee Photo: </p>
                <img style="max-width:200px;" src="<?php echo $employee_photo ;?>" alt="" /> 
            </div>
<?php } ?>
<?php if(isset($employee_firstname)){?>  
            <div>
                <p>First name:<?php echo $employee_firstname;?> </p>
<?php } ?>
<?php if(isset($employee_lastname)){?>
                <p>Last name: <?php echo $employee_lastname; ?> </p>
<?php } ?>
<?php if(isset($employee_address)){?>
                <p>Address:  <?php echo $employee_address; ?></p>
<?php } ?>
<?php if(isset($employee_email)){?>
                <p>Email:  <?php echo $employee_email;?> </p>
<?php } ?>
<?php if(isset($employee_birthDate)){?>
                <p>Birthdate: <?php echo $employee_birthDate ;?> </p>
    
<?php } ?>
<?php if(isset($employee_notes) && $employee_notes !== ''){?> 
                <p>Notes:  <?php echo $employee_notes ;?> </p>
<?php } ?>
                <a href="index.php" class="btn btn-primary">Go Back</a>
            </div>
        </div>
    </main>
</body>
</html>