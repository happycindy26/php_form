
<?php 
require_once('connection.php');
$firstname_error='';$lastname_error='';$notes_error='';
$email_error='';$address_error='';$birthday_error='';
if(isset($_POST['submit'])){
    if(empty($_POST['employee_firstname'])){
        $firstname_error = 'first name is required';
    }elseif (!preg_match("/^[a-zA-Z ]*$/",$_POST['employee_firstname'])){
        $firstname_error = 'Only letters and white space allowed';
    }else{
        $firstname = trim($_POST['employee_firstname']);
    }
    if(empty($_POST['employee_lastname'])){
        $lastname_error = 'last name is required';
    }elseif (!preg_match("/^[a-zA-Z ]*$/",$_POST['employee_lastname'])){
        $lastname_error = 'Only letters and white space allowed';
    }else{
        $lastname = trim($_POST['employee_lastname']);
    }
    if(empty($_POST['employee_notes'])) {
        $notes_error = 'notes are required';
    } elseif(!preg_match("/^[a-zA-Z]*$/", $_POST['employee_notes'])) {
        $notes_error = 'Only letters and white space allowed';
    } else {
        $notes = trim($_POST['employee_notes']);
    }
    if(empty($_POST['employee_email'])){
        $email_error = 'email  is required';
    }elseif (!preg_match("/^[^0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/",$_POST['employee_email'])){
        $email_error = 'Email should be in the right format';
    }else{
        $email = trim($_POST['employee_email']);
    }
    if(empty($_POST['employee_address'])){
        $address_error = 'address  is required';
    }else{
        $address = trim($_POST['employee_address']);
    }
    if(empty($_POST['employee_birthDate'])){
        $birthday_error = 'birthday  is required';
    }else{
        $birthday = $_POST['employee_birthDate'];
        //$date = date_create_from_format("j-M-Y", $birthday);
        //$birthday = date_format($date,"Y-m-d");
       // $formatbirthday = DATE_FORMAT($birthday, '%m/%d/%Y');
      
    }
    $image = 'images/' . $_FILES['image']['name'] ;
    $dir = 'images/'. $_FILES['image']['name'];
    //$notes =  $_POST['employee_notes'];
	move_uploaded_file($_FILES['image']['tmp_name'], $image);
    move_uploaded_file($_FILES['image']['tmp_name'], $dir);
    $employee_pic = 'images/'. $_FILES['image']['name'];
    if($firstname_error == '' && $lastname_error == '' && $notes_error== ''&& $email_error == '' && $address_error == '' && $birthday_error == '' ){ 
    $sql = "INSERT INTO employee(FirstName,LastName,Address,Email,
    BirthDate,Photo,Note)
            VALUES (?,?,?,?,?,?,?)";
    if($stmt = $mysqli->prepare($sql)){
        $stmt->bind_param("sssssss", $fname, $lname, $employee_address, $employee_email, $employee_birthday, $employee_image , $employee_notes);
         // Set parameters
        $fname =$firstname;
        $lname = $lastname;
        $employee_address = $address;
        $employee_email = $email;
        $employee_birthday = $birthday;
        $employee_image=$employee_pic;
        $employee_notes =$notes; 
        if($stmt->execute()){
            header('location:index.php');
        } else{
            echo "ERROR: Could not execute query: $sql. " . $mysqli->error;
        }
        }else{
            echo "ERROR: Could not prepare query: $sql. " . $mysqli->error;
        }   
         // Close statement
        $stmt->close();    
        // Close connection
        $mysqli->close();
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

<div class="addEmployeepage">
    <h1>Add Employees</h1>
    <form action="addEmployee.php" method="post" enctype="multipart/form-data">
  <div>
    <label for="firstname">First Name</label>
    <input type="text" id="firstname" aria-describedby="error" placeholder="Enter First name" name="employee_firstname" value="<?php if(isset($firstname)){ echo $firstname ;}?>" >
    <small id="error"><?php if(isset($firstname_error)){ echo $firstname_error ;}?></small>
  </div>
  <div>
    <label for="lastname">Last Name</label>
    <input type="text" id="lastname" aria-describedby="error" placeholder="Enter Last name" name="employee_lastname" value="<?php if(isset($lastname)){ echo $lastname ;}?>" >
    <small id="error" class=""><?php if(isset($lastname_error)){ echo $lastname_error ;}?></small>
  </div>
  <div>
    <label for="email">Email Address</label>
    <input type="text" id="email" aria-describedby="error" placeholder="Enter Your email"name="employee_email" value="<?php if(isset($email)){ echo $email ;}?>" >
    <small id="error"><?php if(isset($email_error)){ echo $email_error ;}?></small>
  </div>
  <div>
    <label for="address"> Address</label>
    <input type="text" id="address" aria-describedby="error" placeholder="Enter Your address" name="employee_address" value="<?php if(isset($address)){ echo $address ;}?>" >
    <small id="error"><?php if(isset($address_error)){ echo $address_error ;}?></small>
  </div>
  <div>
    <label for="birthdate">Birth Date</label>
    <input type="date" id="birthdate" aria-describedby="error" placeholder="Enter Your Birthday" name="employee_birthDate" value="<?php if(isset($birthday)){ echo $birthday ;}?>" >
    <small id="error"><?php if(isset($birthday_error)){ echo $birthday_error ;}?></small>
  </div>
  <div>
    <label for="photo">Photo</label>
    <input type="file" id="photo" placeholder="photo" name="image" value="<?php if(isset( $employee_pic)){ echo $employee_pic ;}?>">
  </div>
  <div>
    <label for="notes">Notes</label>
    <textarea id="notes" name="employee_notes" value="<?php if(isset($notes)) {echo $notes;} ?>"></textarea>
    <small id="error"><?php if(isset($notes_error)){ echo $notes_error ;} ?></small>
  </div>
  <div class="buttonA">
  <button type="submit" name="submit">Submit</button>
  <a  class="btn btn-primary" href="index.php">Cancel</a>
   <div>
</form>
</div>
