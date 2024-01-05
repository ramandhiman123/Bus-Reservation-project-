<?php

$occupiedSeats = []; // Replace this with your actual list of occupied seats

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    $result = mysqli_query($conn, "SELECT * FROM busSeats WHERE Bus_Id = $userId");

    while ($row = mysqli_fetch_assoc($result)) {
        $seatId = $row['seat_id'];
        $seatNumber = $row['seat_number'];
        $isBooked = $row['booked']; // Assuming there is a 'booked' column in your table

        // Check if the seat is occupied
        $isOccupied = in_array($seatId, $occupiedSeats);

        echo '
        <ul>
            <input type="checkbox" class="seats" name="seats[]" value="'.$seatId.'"';

        // If the seat is occupied, add the 'disabled' attribute
        if ($isOccupied) {
            echo ' disabled';
        }

        echo '>
            <label'.($isOccupied ? ' style="color: red;"' : '').'>'. $seatNumber .'</label>
        </ul>';
    }
}
?>
<br>
<input type="submit" class="submit" value="Book Seats">


<script>
document.addEventListener("DOMContentLoaded", function() {
    var checkboxes = document.querySelectorAll('.seats');

    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('click', function() {
            if (this.disabled) {
                alert('This seat is already occupied. Please choose another seat.');
                // You may also consider changing the alert to a more user-friendly notification or visual cue
            }
        });
    });
});
</script>
