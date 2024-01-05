<center>
            <h3>Search Results:</h3>
            <table border="1">
                <tr>
                    <th>Leaving</th>
                    <th>Going</th>
                    <th>Bus Number</th>
                    <th>Total Seats</th>
                    <th>Fare</th>
                </tr>
                <?php
                include('database.php');
                if (isset($_POST['submit'])) {
                  $source = $_POST['from'];
                  $destination = $_POST['to'];
                 
                  $query = "SELECT * FROM Bus_route JOIN Routes ON Bus_route.Route_Id = Routes.ID
                  JOIN Buses ON Bus_route.Bus_Id = Buses.Bus_Id";
                
                 $result = mysqli_query($conn, $query);
             
                 if ($result->num_rows > 0) {
                
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['Leaving'] == $source && $row['Going'] === $destination) {
                        ?>
                        <tr>
                            <td><?php echo $row['Leaving']; ?></td>
                            <td><?php echo $row['Going']; ?></td>
                            <td><?php echo $row['Bus_no']; ?></td>
                            <td><?php echo $row['Total_seats']; ?></td>
                            <td><?php echo $row['Fare']."<br>"; ?><a href="#">Select-Seat</a></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </center>
        <?php
    }else {
        echo "bus not found " ;
    }
  }
       $conn->close(); 
?>