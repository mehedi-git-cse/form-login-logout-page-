<?php
 $DB_servername="localhost";
 $DB_username="root";
 $DB_password="";
 $DB_Name="test";

 $connection=mysqli_connect($DB_servername,$DB_username,$DB_password,$DB_Name);
 if(!$connection){
     die("Failed".mysqli_connect_error());
 } 

    if(isset($_POST['submit']))
    {  
        $name=$_POST['name'];
        $email=$_POST['email'];
        $mob=$_POST['mobile'];
        $pasword=$_POST['password'];

        if(empty($_POST['name']))
        {
            $nameError="*Name field must be field";
        }
        else{
            $name=$_POST['name'];
        }

        if(empty($_POST['email']))
        {
            $emailError="*Email field must be field";
        }
        else{
            $email=$_POST['email'];
        }

        if(empty($_POST['mobile'])){
                $mobileError="*Mobile field must be filed";
            }
            else{
                $mobile = $_POST['mobile'];
            }

        if(empty($_POST['password']))
        {
            $passError="*Password field must be field";
        }
        else{
            $pasword=$_POST['password'];
        }
        $chk=mysqli_query($connection,"select * from reg_form where email='$email'");
        $count=mysqli_num_rows($chk);

        if($count>0)
        {
            $duplicate="Email alreadyexist";

        }
        
        if(!isset($nameError) && !isset($emailError) && !isset( $mobileError) && !isset($passError)){
        $query1="INSERT INTO reg_form(name,email,mobile,password) VALUES ('$name','$email','$mob','$pasword')";
        $query="INSERT INTO user_login(name,email,mobile,password) VALUES ('$name','$email','$mob','$pasword')";
        $result=mysqli_query($connection,$query);
        $result1=mysqli_query($connection,$query1);
        if($result && $result1)
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
             
                header('Location: form.php');
                exit;
              }

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

<style>
    body{
      
        background-size: cover;
        background-position: center;
        background-color: rgb(191, 202, 206);
    }
    input{
        height: 35px;
        margin-bottom: 15px;
        width: 370px;
        border-radius: 5px;
        outline: none;

        
    }
    input[type=submit]{
        
        background-color:rgb(151, 154, 156);
        width: auto;
        color: rgb(9, 9, 9);
        border-radius: 5px;
            
       
    }
  
    form{
       
        background-color: rgb(239, 238, 238);
        width: 400px;
        padding:10px 15px 16px 15px;
        border: 2px solid rgb(91, 125, 138);
        margin: 0 auto;
        border-radius: 10px;
    }
    p{
        color:white;
        font-size: 18px;
    }
</style>
    <title>Form</title>
</head>
<body> 
 
 <br>

 <form action="" method="post">
  Name:<br>
  <input type="text" name="name" value="<?php echo isset($name)?$name:"";?>">
  <span style="color:red"> <?php echo isset($nameError)?$nameError:"";?></span><br>
  Email:<br>
  <input type="email" name="email" value="<?php echo isset($email)?$email:"";?>">
  <span style="color:red"> <?php echo isset($emailError)?$emailError:"";?></span>
  <span style="color:red"> <?php echo isset($duplicate)?$duplicate:"";?></span><br>
  Mobile:<br>
  <input type="mobile" name="mobile" value="<?php echo isset($mobile)?$mobile:""; ?>">
  <span style="color:red"> <?php echo isset($mobileError)?$mobileError:""; ?></span><br>
  Password:<br>
  <input type="password" name="password" value="<?php echo isset($pasword)?$pasword:"";?>">
  <span style="color:red"> <?php echo isset($passError)?$passError:"";?></span><br>
  <input type="submit" name="submit" value="Submit Form">

</form><br><br>

</body>
</html>
