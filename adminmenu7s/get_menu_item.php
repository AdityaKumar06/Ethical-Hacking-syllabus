<?php
$host = 'localhost';
$db = '7srinkless';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['dishName'])) {
    $dishName = $_GET['dishName'];
    $stmt = $conn->prepare("SELECT dish_name, price, description FROM menu_items WHERE dish_name = ?");
    $stmt->bind_param("s", $dishName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(null);
    }
    $stmt->close();
}

$conn->close();
?>
