<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Seat Reservation</title>
    <style>
        .seat {
            width: 40px;
            height: 40px;
            margin: 5px;
            display: inline-block;
            text-align: center;
            line-height: 40px;
            border: 1px solid #ccc;
            cursor: pointer;
        }
        .reserved {
            background-color: #ff0000;
        }
        .occupied {
            background-color: #cccccc;
        }
    </style>
</head>
<body>

<form action="r.php" method="post">
    <label for="date">Select Date:</label>
    <input type="date" id="date" name="date" required>
    <br><br>

    <label for="seats">Select Seats:</label>
    <div id="seats-container">
        <?php
        // Retrieve seat reservations from the session
        $seatReservations = isset($_SESSION['seatReservations']) ? $_SESSION['seatReservations'] : [];

        // Retrieve selected date from the form
        $selectedDate = isset($_POST['date']) ? $_POST['date'] : date('Y-m-d');

        // Generate seat options dynamically
        $totalSeats = 30; // You can set your desired total seats
        for ($i = 1; $i <= $totalSeats; $i++) {
            $seatStatus = isset($seatReservations[$selectedDate][$i]) ? $seatReservations[$selectedDate][$i] : 'available';

            if ($seatStatus === 'reserved') {
                $seatClass = 'reserved';
            } elseif ($seatStatus === 'occupied') {
                $seatClass = 'occupied'; 
            } else {
                $seatClass = 'seat';
            }

            echo "<div class='$seatClass' data-seat='$i'>$i</div>";
        }
        ?>
    </div>
    <br><br>

    <input type="submit" value="Book Now">
</form>

</body>
</html>
