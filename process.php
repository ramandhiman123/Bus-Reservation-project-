<?php

include('database.php');


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $jsValue = $_POST["jsValue"];
 

    $processedValue = "PHP received and processed: " . htmlspecialchars($jsValue);

    echo $processedValue;
}
?>
