<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

    $stmt = $conn->prepare("DELETE FROM menu_items WHERE dish_name = ?");
    $stmt->bind_param("s", $dishName);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(['message' => 'Menu item deleted successfully!']);
        } else {
            echo json_encode(['message' => 'No menu item found with that name.']);
        }
    } else {
        echo json_encode(['message' => 'Database error: ' . $stmt->error]);
    }
    $stmt->close();
}

$conn->close();
?>
