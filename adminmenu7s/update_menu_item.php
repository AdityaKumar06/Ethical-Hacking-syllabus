<?php
$host = 'localhost';
$db = '7srinkless';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dishName = $_POST['dishName'];
    $price = isset($_POST['price']) ? $_POST['price'] : null;
    $description = isset($_POST['description']) ? $_POST['description'] : null;

   
    $stmt = $conn->prepare("SELECT price, description FROM menu_items WHERE dish_name = ?");
    $stmt->bind_param("s", $dishName);
    $stmt->execute();
    $result = $stmt->get_result();
    $current = $result->fetch_assoc();
    
    $price = $price !== null ? $price : $current['price'];
    $description = $description !== null ? $description : $current['description'];

    
    $stmt = $conn->prepare("UPDATE menu_items SET price = ?, description = ? WHERE dish_name = ?");
    $stmt->bind_param("dss", $price, $description, $dishName);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Menu item updated successfully!']);
    } else {
        echo json_encode(['message' => 'Database error: ' . $stmt->error]);
    }
    $stmt->close();
}

$conn->close();
?>
