<?php

include('database.php');

if(isset($_POST['submit'])){

     $user = $_POST['Username'];    
     $phone = $_POST['mobile'];
     $email = $_POST['mail'];
     $password = $_POST['pwd'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    if($user=="" && $phone=="" && $email=="" && $password==""){
        $nameError = "<p style='color:red;'>*Username is required</p>";
        $phoneError = "<p style='color:red;'>*Phone no is required</p>";
        $emailError = "<p style='color:red;'>*Email is required</p>";
        $passwordError = "<p style='color:red;'>*Password is required</p>";
    }else{
    
 $sql = "INSERT INTO user_reg (`Username`,`PhoneNumber`, `Email`, `Password`) VALUES 
('$user','$phone','$email','$hashed_password')";
 mysqli_query($conn, $sql);

 header('location: user_login.php');
    }
// echo $run;
// if (!$run) {
    
//     echo "Error: " . $sql . "<br>" . $conn->error;
// } else {
   
//     echo "Record inserted successfully";
   
// }

}   


?>
 
<!DOCTYPE html>
<html>
<head>
<style>
body {
font-family: Arial, sans-serif;
background-color: #f2f2f2;
}
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}
body{
    background-image:url('./assets/images/image1.jpg');
    background-size:cover;
    background-position:center;
}
.container {
    /* height: 480px; */
width: 350px;
margin-top:50px;
margin-left:35%;
padding:20px 30px 0 30px;
background-color:rgba(0, 0, 0, 0.4);
border: 1px solid #ccc;
border-radius: 20px;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
font-size:12px;
}

h1 {
text-align: center;
color: white;
margin-top: 0;
font-size: 28px;
}
p {
text-align: center;
color: white;
margin:18px  10px;
}
label {
display: block;
margin-bottom: 0px;
color: #333;
}

input {
width: 100%;
padding: 10px;
margin-bottom: 20px;
border: 1px solid #ccc;
border-radius: 6px;
background-color:rgba(24, 0, 0, 0.6);
color:white;
}
::placeholder {
  color: white;
}
hr {
margin-top: 20px;
margin-bottom: 14px;
border: 0;
border-top: 1px solid #ccc;
}
a {
color: #337ab7;
text-decoration: none;
}
button[type="submit"] {
display: block;
width: 100%;
padding: 10px;
margin-top: 10px;
background-color: #4CAF50;
color: #fff;
border: none;
border-radius: 4px;
cursor: pointer;
font-weight: bold;
}
button[type="submit"]:hover {
background-color: #45a049;
}
.container.signin {
text-align: center;
color: #777;
} 
</style>
</head>
<body>
<form action="?" method="POST" autofill="off">
<div class="container"> 
<h1>Register Here</h1> 
<hr>

<input type="text" placeholder="Enter Username" id="user" name="Username">
<?php echo $nameError ?>
<input type="tel" placeholder="Enter PhoneNumber" name="mobile">
<?php echo $phoneError ?>
<input type="email" placeholder="Enter Email" name="mail">
<?php echo $emailError ?>
<input type="password" placeholder="Enter Password" name="pwd">
<?php echo $passwordError ?>
<input type="password" placeholder="Confirm Password" name="confirm">
<hr>
<!-- <button type="submit" name="submit" class="registerbtn"><strong>Register</strong></button> -->
<button type="submit" value="submit" name="submit">Submit</button>
<p>Already have an account? <a href="user_login.php">Sign in</a>.</p>
</div>
</form>
</body>
</html>

