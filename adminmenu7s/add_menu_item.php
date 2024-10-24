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
    $category = $_POST['category'];
    $price = $_POST['price'];
    $description = $_POST['description'];

 
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $uploadFileDir = './images/';
        $dest_path = $uploadFileDir . $fileName;

        if (move_uploaded_file($fileTmpPath, $dest_path)) {
          
            $stmt = $conn->prepare("INSERT INTO menu_items (dish_name, category, price, description, image_path) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssdss", $dishName, $category, $price, $description, $dest_path);

            if ($stmt->execute()) {
                echo json_encode(['message' => 'Menu item added successfully!']);
            } else {
                echo json_encode(['message' => 'Database error: ' . $stmt->error]);
            }
            $stmt->close();
        } else {
            echo json_encode(['message' => 'File upload failed.']);
        }
    } else {
        echo json_encode(['message' => 'Invalid file upload.']);
    }
}

$conn->close();
?>
