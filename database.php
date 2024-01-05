<?php


$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "tables";

$conn = mysqli_connect($servername,$username,$password,$dbname);

if($conn){
    echo" ";
}else{
    echo"connection is failed";
}
// class Connection {
//     private $servername,$username,$password,$dbname;
//     public $conn ;
  
//     public function __construct($servername,$username,$password,$dbname){
//         $this->servername=$servername;
//         $this->username = $username;
//         $this->password = $password;
//         $this->dbname = $dbname;
//     }

//     public function connect()
//     {
//         $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);

//         if ($this->conn->connect_error) {
//             die("Connection failed: " . $this->conn->connect_error);
//         }
//         echo "Connected Successfully";
//     }
    
// }

// $objconnection =  new Connection("localhost","root","password","tables");

// $objconnection->connect();




// class add{

//     public function showdata($data){
//         connect();
//                 $username = $data['Username'];
//                 $phone = $data['mobile'];
//                 $email = $data['mail'];
//                 $password = $data['pwd'];
//         $this->studentquery = "INSERT INTO user_reg (Id,Username,Phone,Email,Password)
//         VALUES ('$username','$phone','$email','$password')";

//            $this->conn();
//            echo"data is stored";
//          } 
// //         }

// $objform = new add();
// $objform->showdata();
 
// if(isset($_POST['submit'])){
//     $obj->add($_POST);
// }
?>