<?php

include('database.php');

session_start();

if(isset($_SESSION['user_id'])){
    header("Location: home.php");
    exit();
}

if (isset($_POST['submit'])) {
    $checkemail = $_POST['mail'];
    $checkpassword = $_POST['password'];

 
    $sql = "SELECT `Password` FROM user_reg WHERE Email = '$checkemail'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $stored_password= $row['Password'];

        if (password_verify($checkpassword, $stored_password)) {
            
    
          $success =  "<div class='alert alert-success' role='alert'>
          Login Successfully!
        </div>";
         
            header('location: home.php');
        } else {
           $loginError = "<div class='alert alert-danger alert-dismissible' role='alert'>
            <strong>Incorrect Email Or Password!</strong>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
          </div>";
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
mysqli_close($conn);


    //    if($num('Email') === $checkemail){
    //     echo "email is matched";
    //    }
    //    else{
    //     echo"email is not matched";
    //    }
    //     if($num('Password') === $checkpassword){
    //         echo "password is matched";}
    //     //    $successlogin =  "Login successful!";
    //     //    $loginError = "";
    //     }
    //      else {
    //         echo"password is not match";
    //         // $loginError = "Incorrect email and  password";
    //         // $successlogin =  "";
    //     }
    // }else{
    //     echo "Incorrect email or password";
    // }
 
// $row = $result->fetch_assoc();
// $conn->close();
// if ($checkpassword == $num && $checkpassword == $num)


// include('database.php');

// mysqli_close($conn);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <title>Glassmorphism login Form Tutorial in html css</title>
     <link  href = "./assets/css/bootstrap4.min.css" rel="stylesheet">
    <style media="screen">       
       *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
} 
 body{
    background-image:url('./assets/images/image1.jpg');
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    height: 78.5vh;

} 
 .background{
    width: 430px;
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.background .shape{ 
    height: 110px;
    width: 110px;
    position: absolute;
    border-radius: 50%;
}
/* .shape:first-child{
    background: linear-gradient(
        #1845ad,
        #23a2f6
    );
    left: 0px;
    top: 2px;
}
.shape:last-child{
    background: linear-gradient(
        to right,
        #ff512f,
        #f09819
    );
    right: 4px;
    bottom: 10px;
} */
form{
    width: 300px;
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 20px 30px 10px 30px; 
}
form *{
    font-family: 'Poppins',sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 40px;
    text-align: center;
   
}

label{
    display: block;
    font-size: 15px;
    font-weight: 500;
}
input{
    display: block;
    height: 40px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 4px;
    font-size: 15px;
    font-weight: 300;
}
::placeholder{
    color: #e5e5e5;
}
button{
    margin-top: 4px;
    width: 100%;
    background-color: #ffffff;
    color: #080710;
    padding: 8px 0;
    font-size: 16px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
}
.social{
  margin-top: 20px;
  display: flex;
}
.social div{
  background: red;
  width: 150px;
  border-radius: 3px;
 padding:5px 4px ;
  background-color: rgba(255,255,255,0.27);
  color: #eaf0fb;
  text-align: center;
  font-size:15px;
}
.social div:hover{
  background-color: rgba(255,255,255,0.47);
}
.social .fb{
  margin-left: 25px;
}
.social i{
  margin-right: 4px;
} 
.link{
    margin-top:12px;
    font-size:13px;
    text-align:center;
    background-color:lightgreen;
    padding:4px 6px 4px 6px;
    width:90px;
    margin-left:72px;
    border-radius:8px;
}
.alert{
    padding:6px 10px;
    margin-bottom:4px;
    font-size:15px;
}
.alert-danger{
    background-color:rgba(255, 108, 108, 1);
    border:none;
    font-size:12px;
    padding:8px 10px;
    position:relative;
}
span{
 position:absolute;
 left:91%;
 top:12px;
float:right;
line-height:0;
font-size: 20px;
box-shadow:none;
}
    </style>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="?" method="POST">
        <h3>Login Here</h3>
        <?php
  echo  $success;
  echo $loginError;
    ?>
        <label for="username">Email</label>
        <input type="email" placeholder="Enter your Email" id="username" name="mail"><br>
        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="password" > <br> 
        <button type="submit" name="submit">Log In</button>
        <div class="social">
          <div class="go"><i class="fab fa-google"></i>  Google</div>
          <div class="fb"><i class="fab fa-facebook"></i>  Facebook</div>
        </div>
        <div class="link">
        <strong><a href="user_reg.php">Sign In</a></strong>
</div>
    </form>
    <script src="./assets/js/jquery.slim.min.js"></script>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>

