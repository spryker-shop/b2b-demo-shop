<?php
    $orderId = $_GET["order_id"];
    $orderName = $_GET["order_name"];
    $orderAddress = $_GET["order_address"];


$servername = "localhost";
$username = "development";
$password = "mate20mg";
$dbname = "DE_development_zed";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO order_delivery (order_id, status, description, name, address)
VALUES ($orderId, 'waiting for delivery', '', '$orderName', '$orderAddress')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
