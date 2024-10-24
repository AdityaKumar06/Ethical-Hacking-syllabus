<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "7srinkless"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM menu_items";
$result = $conn->query($sql);

$menuItems = [];

if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {
        $menuItems[] = $row;
    }
}

$conn->close();


header('Content-Type: application/json');
echo json_encode($menuItems);
?>
