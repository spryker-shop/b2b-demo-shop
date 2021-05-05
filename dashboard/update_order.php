<?php
    $orderNo = $_GET["order_id"];
    $orderStatus = $_GET["order_status"];


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
$sql = "UPDATE order_delivery SET status='$orderStatus' WHERE order_id=$orderNo";

if ($conn->query($sql) === TRUE) {
    if ($orderStatus === 'delivered') {
        // Example: 3rd party calls Spryker OMS
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'zed.de.b2b-demo-shop.local/oms/trigger/trigger-event?id-sales-order='.$orderNo.'&event=confirm-delivery');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        echo $output;
        curl_close($ch);
    }
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

header('Location: /');
?>
