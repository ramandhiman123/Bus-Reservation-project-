<?php
include('database.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <title>home</title>
</head>
<style>
  *{
    padding:0;
    margin:0;
    box-sizing:border-box;
  }
  body{
    background-image:url('./assets/images/image1.jpg');
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    height: 78.5vh;
  }
       table,th{
          width:86%;
          border-collapse:collapse;
          text-align:center;
          margin-left:4%;
          font-size:16px;  
      }
      td,th{
        border:1px solid grey;
        width:15%;
      } 

      a{
      text-decoration:none;
      color:whitesmoke;
      padding:3px 10px;
      font-size: 13px;
      border-radius:4px;
      background-color:rgba(255, 20, 0, 0.70);
      }
      .box{
        background-color:white;
        padding:20px 26px;
        margin-top:16%;
        width:30%;
        /* backdrop-filter: blur(6px); */
        box-shadow:10px 10px 20px 6px  black;
      }
      select{
        margin-top:18px;
        width:290px;
        height:40px;
        font-size:14px;
        border-radius:8px;
        padding:0 10px;
        border:none;
        background-color:rgba(252, 247, 250, 10);
      }
      input{
        margin-top:18px;
        width:290px;
        height:40px;
        border-radius:8px;
        padding:0 10px;
        border:none;
        background-color:rgba(252, 247, 250, 10);
      }
      button{
        margin-top:18px;
        margin-left:38px;
       padding:8px 30px;
        border-radius:8px;
        border:none;
      }
      button:hover{
        background-color:green;
        color:white;
        transition:0.6s;
      }
      .routes{
        margin-left:40%;
        margin-top:-22%;
        color:white;
        padding:20px 0px 20px 20px;
        background-color:rgba(0, 0, 0, 0.36);
        width:55%;
        border-radius:12px;
      }
    </style>
<body>
   
<?php 
session_start();

// if (!isset($_SESSION['user_id'])) {
//   header("Location: index.php");
//   exit();

//   $userInfoArray = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : [];


// }
?>
        <div class="container">
        <div class="box">
       <div class="row">
       <form  action="?" method="POST">
    <div class="col-lg-10">
<?php
// echo "<p>User Information:</p>";
// echo "<ul>";
// foreach ($userInfoArray as $value) {
//     echo "<li>$value</li>";
// }
// echo "</ul>";
?>
    <select name="from" >
    <option value="From" class="active" required >From</option>
      <?php
       $tt = "SELECT * FROM Routes";
       $rr = $conn->query($tt);
       foreach($rr as $nn){
        ?>
        <option value="<?php echo $nn['Leaving']; ?>" ><?php echo $nn['Leaving']; ?></option>
        <?php
       }
      ?>
</select>
      </div>

    <div class="col-lg-10">
    <select name="to">
    <option value="To" class="active">To</option>
      <?php
foreach($rr as $nn){
  ?>
 
    <option value="<?php echo $nn['Going']; ?>"><?php echo $nn['Going']; ?></option>
      
  <?php
}
      ?>
</select>
</div>

<div class="col-lg-10">
<input type="date" name="date" ><br>
</div>
<div class="col-lg-10">
  <center>
  <button type="submit" value="submit" name="submit">Search Bus</button>
</center>
</div>
</form>
</div>
</div>
</div>


                <?php
                if (isset($_POST['submit'])) {

                  $source = $_POST['from'];
                  $destination = $_POST['to'];
                  $date = $_POST['date'];
               
                  $query = "SELECT * FROM Bus_route JOIN Routes ON Bus_route.Route_Id = Routes.ID
                  JOIN Buses ON Bus_route.Bus_Id = Buses.Bus_Id";
                
                 $result = mysqli_query($conn, $query);
             ?>
            <div class="routes">
                <!-- <h3>Search buses</h3> -->
            <table border="1">
                <tr>
                    <th>Leaving</th>
                    <th>Going</th>
                    <th>Bus Number</th>
                    <th>Total Seats</th>
                    <th>Fare</th>
                </tr>
             <?php
                 if ($result->num_rows > 0) {
                
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['Leaving'] == $source && $row['Going'] === $destination) {
                        ?>
                        <tr>
                            <td><?php echo $row['Leaving']; ?></td>
                            <td><?php echo $row['Going']; ?></td>
                            <td><?php echo $row['Bus_no']; ?></td>
                            <td><?php echo $row['Total_seats']; ?></td>
                            <td><a href="seats.php?id=<?php echo $row['Bus_Id']; ?>&&rid=<?php echo $row['ID']; ?>&&date=<?php echo $date; ?>">Select-Seat</a></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
              </div>
        <?php
    }else {
        echo "bus not found " ;
    }
  }
       $conn->close(); 
?>
       




</body>
</html>
