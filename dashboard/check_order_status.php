<?php
    $orderId = $_GET["order_id"];

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

$sql = "SELECT status from order_delivery WHERE order_id=$orderId";
$result = $conn->query($sql);
$order_status = null;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $order_status = $row['status'];
    }
}

echo $order_status;
?>
