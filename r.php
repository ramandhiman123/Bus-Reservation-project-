<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedDate = $_POST['date'];
    $selectedSeats = isset($_POST['seats']) ? $_POST['seats'] : [];

    // Initialize or get the seat reservations array from the session
    $seatReservations = isset($_SESSION['seatReservations']) ? $_SESSION['seatReservations'] : [];

    // Check seat status and update the seat reservations array
    foreach ($selectedSeats as $seat) {
        if (isset($seatReservations[$selectedDate][$seat]) && $seatReservations[$selectedDate][$seat] === 'reserved') {
            // Seat is already reserved on the selected date
            echo "<h2>Reservation Failed!</h2>";
            echo "<p>Seat $seat is already reserved on $selectedDate.</p>";
            exit();
        }

        // Check if the seat is occupied on any date
        $isOccupied = false;
        foreach ($seatReservations as $date => $seats) {
            if (isset($seats[$seat]) && $seats[$seat] === 'occupied') {
                $isOccupied = true;
                break;
            }
        }

        if ($isOccupied) {
            // Seat is occupied on some date
            echo "<h2>Reservation Failed!</h2>";
            echo "<p>Seat $seat is occupied on some date.</p>";
            exit();
        }

        // Reserve the seat on the selected date
        $seatReservations[$selectedDate][$seat] = 'reserved';
    }

    // Save the updated seat reservations array to the session
    $_SESSION['seatReservations'] = $seatReservations;

    echo "<h2>Reservation Successful!</h2>";
    echo "<p>Date: $selectedDate</p>";
    echo "<p>Reserved Seats: " . implode(', ', $selectedSeats) . "</p>";
}
?>
