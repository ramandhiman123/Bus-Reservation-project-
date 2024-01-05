<?php
include('database.php');
session_start();

if (isset($_POST['seats']) && isset($_SESSION['data1'], $_SESSION['data2'], $_SESSION['data3'])) {
    $Seats = $_POST['seats'];
    $bid = $_SESSION['data1'];
    $rid = $_SESSION['data2'];
    $dat = $_SESSION['data3'];

    if (empty($Seats)) {
        echo "Please select at least one seat.";
    } else {
        $q = "INSERT INTO `Seat_booking` (`s_id`, `dates`, `Bus_id`, `Route_id`) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $q);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssss", $seat, $dat, $bid, $rid);

            foreach ($Seats as $seat) {
                mysqli_stmt_execute($stmt);

                if (mysqli_stmt_errno($stmt) !== 0) {
                    echo "Error inserting data for seat $seat: " . mysqli_stmt_error($stmt) . "<br>";
                }
            }
            mysqli_stmt_close($stmt);
            echo "Seats Booked Successfully.";
        } else {
            echo "Error preparing statement: " . mysqli_error($conn);
        }
    }
} else {
    echo "No valid data received.";
}
?>

