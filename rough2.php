<?php

$host = 'localhost';
$dbname = 'tables';
$username = 'root';
$password = 'password';

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


// Handle seat status update
// Handle seat status update
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['selected_seat'])) {
        $selectedSeatId = $_POST['selected_seat'];

        // Update seat status to 'reserved' when a seat is clicked
        $stmt = $pdo->prepare("UPDATE busSeats SET status = 'reserved' WHERE seat_number = :seat_number");
        $stmt->bindParam(':seat_number', $selectedSeatId, PDO::PARAM_INT);
        $stmt->execute();

        // Send the updated seat number and status to the browser
        echo json_encode(['seatId' => $selectedSeatId, 'status' => 'reserved']);
        exit();
    }
}

// Fetch seats from the database
$stmt = $pdo->query("SELECT * FROM busSeats");
$seats = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Reservation</title>
    <style>
        .seat {
            width: 45px;
            height: 45px;
            margin: 5px;
            display: inline-block;
            text-align: center;
            line-height: 45px;
            border:none;
            cursor: pointer;
            font-size:15px;
            font-weight:600;
            border-radius:8px;
        }
        .available {
            background-color: #b5e7a0;
        }
        .reserved {
            background-color: #f7bd87;
        }
        .occupied {
            background-color: #ff6961;
        }
    
    </style>
</head>
<body>

<h2>Seat Reservation</h2>

<div id="seats-container">
    <?php
    // Display a grid of seats
    foreach ($seats as $seat) {
        $seatNumber = $seat['seat_number'];
        $status = $seat['status'];
        $seatClass = strtolower($status);
        echo "<div class='seat $seatClass' data-seat-number='$seatNumber'>$seatNumber</div>";
    }
    ?>
</div>

<script>

        const seats = document.querySelectorAll('.seat');
seats.forEach(seat => {
    seat.addEventListener('click', function () {
        seat.style.backgroundColor="red";
        const seatNumber = this.getAttribute('data-seat-number');

        // Update the seat's status in the database using AJAX
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'rough2.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        // Send the selected seat to PHP for processing
        xhr.send(`selected_seat=${seatNumber}`);

        // Handle the response from the server
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);

                // Update the seat color on the page
                const updatedSeat = document.querySelector(`[data-seat-number='${seatNumber}']`);
                updatedSeat.classList.remove('available');
                updatedSeat.classList.add('reserved');
            }
        };
    });
});
 

</script>

</body>
</html>
SELECT seats.* 
              FROM seats
              LEFT JOIN bookings ON seats.id = bookings.seat_id
              WHERE seats.route_id = $routeId
                AND (bookings.id IS NULL OR bookings.booking_date != '$bookingDate')
              AND seats.status = 'available'"





              <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Seat Booking</title>
</head>
<body>
    <style>
        
      ul{
        background-color:green;
        width:2%;
        height:35px;
        padding:6px 14px;
        color:white;
       list-style:none;
       border-radius:10px;
      }

.submit{
    background-color:lightgreen;
    padding:8px 16px;
    border:none;
}
        </style>
    <h2>Bus Seats</h2>

    <form action="book_seat.php" method="POST">
        <?php
            include('database.php');
            // session_start(); 

            if (isset($_GET['id']) ) {
                $userId = $_GET['id'];
                $routeId = $_GET['rid'];
                $Date = $_GET['date'];
                
            $result = mysqli_query($conn, "SELECT * FROM busSeats WHERE Bus_Id = '$userId'");
            while ($row = mysqli_fetch_assoc($result)) {
                
                echo '
                <ul> 
                <li>
                <input type="checkbox" class="seats" name="seats[]" value="'.$row['seat_id'].'"'. $row['seat_number'] .'">
                <label>'. $row['seat_number'] .'</label>
                </li></ul>
                ';  
    
            }
            
            }
        ?>
         <input type="submit" class="submit" name="submit" value="Book Seats">

         </form> 
<?php    
  session_start(); 

 if(isset($_GET['id'], $_GET['rid'], $_GET['date'])) {

     $userId = $_GET['id'];
     $routeId = $_GET['rid'];
     $Date = $_GET['date'];
 
      $_SESSION['data1'] = $userId;
      $_SESSION['data2'] =  $routeId;
      $_SESSION['data3'] = $Date;
      
         $res = "SELECT * FROM Seat_booking  WHERE Bus_id = '$userId' AND Route_id = '$routeId' AND dates = '$Date'";
         $evm = mysqli_query($conn, $res);

         } else {
             echo "Error in the query: " . mysqli_error($conn);
         }3
        
 ?>
 
</body>
</html>
