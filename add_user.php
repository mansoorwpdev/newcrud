<?php
// This is our backend code we are
require_once('conn.php');
$conn = DBConnect();

$fnerr = $lnerr = $emerr = $grerr = $slerr = $aderr = "";

if(isset($_POST['submit'])){

    //Validation
    if(empty($_POST['firstname'])){
        $fnerr =  "First Name Required <br>";
    }

    if(empty($_POST['lastname'])){
        $lnerr =  "Last Name Required <br>";
    }
    
    if(empty($_POST['user_email'])){
        $emerr =  "Email Required <br>";
    }

    if(!isset($_POST['user_gender'])){
        $grerr =  "Gender Required <br>";
    }

    if(!isset($_POST['user_skills'])){
        $slerr = "Atleast 1 Skill Required <br>";
    }

    if(empty($_POST['user_address'])){
        $aderr =  "Address Required <br>";
    }
    //Validation Ends

    if( ($fnerr == "") && ($lnerr == "") && ($emerr == "") && ($grerr == "") && ($slerr == "") && ($aderr == "") ){
        
        //getting all the values from HTML form and storing in variables
        $firstname = $_POST['firstname'];
        $lastname  = $_POST['lastname'];
        $user_email = $_POST['user_email'];
        $user_address = $_POST['user_address'];

        //this is used to define array, check array is set or not and store array values in variable $user_gender
        if(isset($_POST['user_gender'])){
            $user_gender = $_POST['user_gender'];
        }else{
            $user_gender = "";
        }

        if(isset($_POST['user_skills'])){
            $user_skills = implode(',',$_POST['user_skills']);
        }else{
            $user_skills = "";
        }

        //then insert all the values in DB
        $sql = "INSERT INTO tbl_users (firstname, lastname, user_email, user_gender, user_skills, user_address) VALUES 
        ('$firstname','$lastname','$user_email','$user_gender','$user_skills','$user_address')";
        
        //if connection is successfull and $sql has record then it will go to the location index.php and shows Record Added msg
        if (mysqli_query($conn, $sql)) {
            //echo "Added";
            header("Location: index.php?msg=Record Added Successfully");
        } else {
            die("Error: " . $sql . "<br>" . mysqli_error($conn));
        }
    } else{
        $fill_fields = "Please Fill All the required fields";
    }  
}
?>

<!-- Front End Code Form -->
<!-- HTML form  -->
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
    
    <div class='text-center mb-3'><h1>CRUD: Add Users</h1></div>
    
    <form method='POST' action="">
    <div><?php echo $fill_fields; ?></div>    
    <div class='form-group'>
        <label for='exampleInputEmail1'>First Name</label>
        <input type='text' value="<?php if (isset($_POST['firstname'])) echo $_POST['firstname']; ?>" name='firstname' id='firstname' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Enter First Name' >
       <span><?php echo $fnerr ?></span>
    </div>
    <div class='form-group'>
        <label for='exampleInputEmail1'>Last Name</label>
        <input type='text' value="<?php if(isset($_POST['lastname'])) echo $_POST['lastname'] ?>" name='lastname' id='lastname' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Enter Last Name'>
        <span><?php echo $lnerr ?></span>
    </div>
    <div class='form-group'>
        <label for='exampleInputEmail1'>Email</label>
        <input type='email' value="<?php if(isset($_POST['user_email'])) echo $_POST['user_email'] ?>" name='user_email' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Enter Your Email'>
        <span><?php echo $emerr ?></span>
    </div>

    <div class='form-group'>
    <label for='Gender' >Gender</label>
    <div class='form-check form-check-inline'>
    <input class='form-check-input' type='radio' value='Male' <?php if (isset($_POST['user_gender']) && $_POST['user_gender'] == "Male") { echo "checked"; } ?>  name='user_gender' id='inlineRadio1'>
    <label class='form-check-label' for='inlineRadio1'>Male</label>
    </div>
    <div class='form-check form-check-inline'>
    <input class='form-check-input' type='radio' value='Female' <?php if (isset($_POST['user_gender']) && $_POST['user_gender'] == "Female") { echo "checked"; } ?> name='user_gender' id='inlineRadio2'>
    <label class='form-check-label'  for='inlineRadio2'>Female</label>
    </div>   
    </div>
    <span><?php echo $grerr ?></span>

    <div class='form-group' style='margin-bottom:-2px'>
    <label for='exampleInputEmail1' >Skills</label>
    </div>
    <div class='form-check form-check-inline'>
    <input class='form-check-input' name='user_skills[]' value='PHP' <?php if(isset($_POST['user_skills']) && in_array("PHP", $_POST['user_skills'])) echo "checked"; ?>  type='checkbox' id='inlineCheckbox1'>
    <label class='form-check-label'  for='inlineCheckbox1'>PHP</label>
    </div>
    <div class='form-check form-check-inline'>
    <input class='form-check-input' name='user_skills[]' value="HTML" <?php if(isset($_POST['user_skills']) && in_array("HTML", $_POST['user_skills'])) echo "checked"; ?> type='checkbox' id='inlineCheckbox2'>
    <label class='form-check-label1'  for='inlineCheckbox2'>HTML</label>
    </div>
    <div class='form-check form-check-inline'>
    <input class='form-check-input' name='user_skills[]' value='Bootstrap' <?php if(isset($_POST['user_skills']) && in_array("Bootstrap", $_POST['user_skills'])) echo "checked"; ?> type='checkbox' id='inlineCheckbox3'>
    <label class='form-check-label2'  for='inlineCheckbox3'>Bootstrap</label>
    </div>
    <div class='form-check form-check-inline'>
    <input class='form-check-input' name='user_skills[]' value='WordPress' <?php if(isset($_POST['user_skills']) && in_array("WordPress", $_POST['user_skills'])) echo "checked"; ?> type='checkbox' id='inlineCheckbox4'>
    <label class='form-check-label3'  for='inlineCheckbox4'>WordPress</label>
    </div>
    <div class='form-check form-check-inline'>
    <input class='form-check-input' name='user_skills[]' value='Laravel' <?php if(isset($_POST['user_skills']) && in_array("Laravel", $_POST['user_skills'])) echo "checked"; ?> type='checkbox' id='inlineCheckbox5'>
    <label class='form-check-label4'  for='inlineCheckbox4'>Laravel</label>
    </div><br>
    <span><?php echo $slerr ?></span>
    <div class='form-group mb-2'>
        <label for='exampleInputEmail1'>Address</label>
        <input type='text' value="<?php if(isset($_POST['user_address'])) {echo $_POST['user_address'];} ?>" name='user_address' id='user_address' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Enter Your Address' >
        <span><?php echo $aderr ?></span>
    </div>
    
    <button type='submit' name='submit' class='btn btn-primary'>Save Record</button>
    
    </form>
    </div>
 </body>
</html>
