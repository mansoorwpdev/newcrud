<?php
require_once('conn.php');
$conn = DBConnect();
$id = $_GET['id'];

if(isset($_POST['submit'])){
    
    if(isset($_POST['user_gender'])){
        $user_gender = $_POST['user_gender'];
    }else{
        $user_gender = "";
    }

    if(isset($_POST['user_skills'])){
        $user_skills = implode(',',$_POST['user_skills']);
    }

    $firstname = $_POST['firstname'];
    $lastname  = $_POST['lastname'];
    $user_email = $_POST['user_email'];
    $user_address = $_POST['user_address'];

    $sql = "UPDATE tbl_users SET firstname='$firstname',lastname='$lastname',user_email='$user_email',user_gender='$user_gender',
    user_skills='$user_skills',user_address='$user_address' WHERE id='$id'";

    // die($sql);

    $result = mysqli_query($conn,$sql);

    if($result){
        header("Location: index.php?msg=Record Updated Successfully");
    }else{
        echo "Error:" . mysqli_error($conn);
    }

}    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>PHP CRUD</title>
</head>
<body>
    
<div class='container mt-5 mb-5' style='width:90%; margin-bottom:50px'>
    
    <div class='text-center mb-3'><h1>CRUD: Update Users</h1></div>
    
    <form method='POST' action="">
    <?php 
     $sql = "SELECT * FROM tbl_users WHERE id=$id";
     $results = mysqli_query($conn,$sql);
     $row = mysqli_fetch_assoc($results);
     ?>   
    <div class='form-group'>
        <label for='exampleInputEmail1'>First Name</label>
        <input type='text' value="<?php echo $row['firstname'] ?>" name='firstname' id='firstname' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Enter First Name' >

    </div>
    <div class='form-group'>
        <label for='exampleInputEmail1'>Last Name</label>
        <input type='text' value="<?php echo $row['lastname'] ?>" name='lastname' id='lastname' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Enter Last Name'>
        
    </div>
    <div class='form-group'>
        <label for='exampleInputEmail1'>Email</label>
        <input type='email' name='user_email' value="<?php echo $row['user_email'] ?>" class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Enter Your Email'>
        
    </div>

    <div class='form-group'>
    <label for='Gender' >Gender</label>
    <div class='form-check form-check-inline'>
    <input class='form-check-input'  type='radio' value='Male'<?php echo ($row['user_gender']=='Male') ? "checked":"" ?> name='user_gender' id='inlineRadio1'>
    <label class='form-check-label' for='inlineRadio1'>Male</label>
    </div>
    <div class='form-check form-check-inline'>
    <input class='form-check-input' type='radio' value='Female'<?php echo ($row['user_gender']=='Female') ? "checked":"" ?> name='user_gender' id='inlineRadio2'>
    <label class='form-check-label2'  for='inlineRadio2'>Female</label>
    </div>   
    </div>
    
    <div class='form-group' style='margin-bottom:-2px'>
    <label for='exampleInputEmail1' >Skills</label>
    </div>
    
    <?php
    //previously data is coming from array and we have converted the data into string by using implode.
    //but now in this case we are converting the data from string to array again. we can convert string to array by using explode. 
     $skills_data = explode(',',$row['user_skills']);
    ?>
    <div class='form-check form-check-inline'>
    <input class='form-check-input' name='user_skills[]' value='PHP' <?php if(isset($skills_data) && in_array('PHP',$skills_data) ) echo "checked"; ?>  type='checkbox' id='inlineCheckbox1'>
    <label class='form-check-label'  for='inlineCheckbox1'>PHP</label>
    </div>
    <div class='form-check form-check-inline'>
    <input class='form-check-input' name='user_skills[]' value='HTML' <?php if(isset($skills_data) && in_array("HTML", $skills_data)) echo "checked"; ?> type='checkbox' id='inlineCheckbox2'>
    <label class='form-check-label1'  for='inlineCheckbox2'>HTML</label>
    </div>
    <div class='form-check form-check-inline'>
    <input class='form-check-input' name='user_skills[]' value='Bootstrap' <?php if(isset($skills_data) && in_array("Bootstrap", $skills_data)) echo "checked"; ?> type='checkbox' id='inlineCheckbox3'>
    <label class='form-check-label2'  for='inlineCheckbox3'>Bootstrap</label>
    </div>
    <div class='form-check form-check-inline'>
    <input class='form-check-input' name='user_skills[]' value='WordPress' <?php if(isset($skills_data) && in_array("WordPress", $skills_data)) echo "checked"; ?> type='checkbox' id='inlineCheckbox4'>
    <label class='form-check-label3'  for='inlineCheckbox4'>WordPress</label>
    </div>
    <div class='form-check form-check-inline'>
    <input class='form-check-input' name='user_skills[]' value='Laravel' <?php if(isset($skills_data) && in_array("Laravel", $skills_data)) echo "checked"; ?> type='checkbox' id='inlineCheckbox5'>
    <label class='form-check-label4'  for='inlineCheckbox4'>Laravel</label>
    </div>
    
    <div class='form-group mb-2'>
        <label for='exampleInputEmail1'>Address</label>
        <input type='text' value="<?php echo $row['user_address'] ?>" name='user_address' id='user_address' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Enter Your Address' >
        
    </div>
    
    <button type='submit' name='submit' class='btn btn-success'>Edit Record</button>
    <a class="btn btn-primary" href="/crud/index.php" role="button">Back</a>
    </form>
    </div>


    </body>
</html>
