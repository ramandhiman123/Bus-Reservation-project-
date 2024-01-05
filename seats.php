<?php
// session_start();
// if (!isset($_SESSION['email'])) {
//     header("Location: login-page.php");
//     exit();
// }
// include_once('../inc/connection.php');
include('database.php');
if (isset($_GET['id'], $_GET['date'], $_GET['rid'])) {
    $bus_id = $_GET['id'];
    $date = $_GET['date'];
    $route_id = $_GET['rid'];

    $sql = "SELECT * FROM Seat_booking WHERE DATE_FORMAT(dates, '%Y-%m-%d') = ? AND Bus_id=? AND Route_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $date, $bus_id, $route_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $bookedSeats = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $bookedSeats[] = $row['seat_id'];
        }
    }

    $selectSeats = "SELECT * FROM busSeats WHERE Bus_id = ?";
    $stmtSelectSeats = $conn->prepare($selectSeats);
    $stmtSelectSeats->bind_param("s", $bus_id);
    $stmtSelectSeats->execute();
    $resultSeats = $stmtSelectSeats->get_result();

    if ($resultSeats->num_rows > 0) {
        echo '<form method="post" action="book_seat.php">';
        echo '<ul class="seatContainer">';
        while ($row = $resultSeats->fetch_assoc()) {
            $seatId = $row["seat_id"];
            $seatName = $row['seat_number'];
            $isBooked = (in_array($seatId, $bookedSeats)) ? "disabled" : "";
            $seatClass = ($isBooked === "disabled") ? "seat-item seat-booked" : "seat-item";

            echo "<li class='$seatClass'>
                <label for='seat_$seatId'>" . $seatName ."</label> 
                <input type='checkbox' id='seat_$seatId' name='seats[]' value='$seatId' $isBooked>
                <input type='hidden'  name='route_id' value='$route_id' >             
                </li>";
        }
        echo '</ul>';
        echo '<input type="hidden" name="bus_id" value="' . $bus_id . '">';
        echo '<input type="hidden" name="date" value="' . $date . '">';
        echo '<input type="submit" class="btn-primary" value="Book Selected Seats">';
        echo '</form>';
    } else {
        echo "No seats found for this bus.";
    }
} else {
    echo "Bus ID or date not provided.";
}
?>
