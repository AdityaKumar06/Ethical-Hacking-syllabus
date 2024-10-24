<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Menu Management</title>
    <link rel="stylesheet" href="./style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        form {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            background-color: black;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }

        button:hover {
            background-color: green;
        }

        .message {
            margin-top: 10px;
            color: green;
        }

        /* Popup styles */
        .popup {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
        }
    </style>
</head>

<body>
    <h1>Admin Menu Management</h1>
    <form id="addMenuItemForm" enctype="multipart/form-data">
        <label for="dishName">Dish Name:</label>
        <input type="text" id="dishName" name="dishName" required>

        <label for="category">Category:</label>
        <select id="category" name="category" required>
            <option value="snacks">Snacks & Starters</option>
            <option value="rice">Rice & Noodles</option>
            <option value="dal">Dal & Vegies</option>
            <option value="south">South Indian</option>
            <option value="roti">Roti & Paranthas</option>
            <option value="rolls">Rolls & Sandwich</option>
            <option value="sweets">Sweets & Beverages</option>
            <option value="combos">Meals & Combo</option>
        </select>

        <label for="price">Price (in ₹):</label>
        <input type="number" id="price" name="price" required>

        <label for="description">Description:</label>
        <input type="text" id="description" name="description" required>

        <label for="image">Upload Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required>

        <button type="submit">Add Menu Item</button>
        <button type="button" id="openUpdatePopup">Update Menu Item</button>
        <button type="button" id="openDeletePopup">Delete Menu Item</button>
        <div class="message" id="message"></div>
    </form>

    <!-- Update Popup Modal -->
    <div class="popup" id="updatePopup">
        <div class="popup-content">
            <h2>Update Menu Item</h2>
            <label for="updateDishName">Dish Name:</label>
            <input type="text" id="updateDishName" name="updateDishName" required>

            <label for="updatePrice">Price (in ₹):</label>
            <input type="number" id="updatePrice" name="updatePrice">

            <label for="updateDescription">Description:</label>
            <input type="text" id="updateDescription" name="updateDescription">

            <button id="submitUpdate">Submit Update</button>
            <button id="closeUpdatePopup">Cancel</button>
        </div>
    </div>

    <!-- Delete Popup Modal -->
    <div class="popup" id="deletePopup">
        <div class="popup-content">
            <h2>Delete Menu Item</h2>
            <label for="deleteDishName">Dish Name:</label>
            <input type="text" id="deleteDishName" name="deleteDishName" required>

            <button id="submitDelete">Confirm Delete</button>
            <button id="closeDeletePopup">Cancel</button>
        </div>
    </div>

    <script>
        // Add Menu Item Form Submission
        document.getElementById('addMenuItemForm').addEventListener('submit', function (event) {
            event.preventDefault();
            const formData = new FormData(this);

            fetch('add_menu_item.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('message').textContent = data.message;
                document.getElementById('addMenuItemForm').reset();
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('message').textContent = 'An error occurred. Please try again.';
            });
        });

        // Open Update Popup
        document.getElementById('openUpdatePopup').addEventListener('click', function() {
            const dishName = prompt("Enter the dish name to update:"); // Example way to get dish name
            if (dishName) {
                fetch(`get_menu_item.php?dishName=${dishName}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data) {
                            document.getElementById('updateDishName').value = data.dish_name;
                            document.getElementById('updatePrice').value = data.price;
                            document.getElementById('updateDescription').value = data.description;
                            document.getElementById('updatePopup').style.display = 'flex';
                        } else {
                            alert("Dish not found.");
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        });

        // Close Update Popup
        document.getElementById('closeUpdatePopup').addEventListener('click', function() {
            document.getElementById('updatePopup').style.display = 'none';
        });

        // Submit Update
        document.getElementById('submitUpdate').addEventListener('click', function() {
            const dishName = document.getElementById('updateDishName').value;
            const price = document.getElementById('updatePrice').value;
            const description = document.getElementById('updateDescription').value;

            const formData = new FormData();
            formData.append('dishName', dishName);
            if (price) formData.append('price', price);
            if (description) formData.append('description', description);

            fetch('update_menu_item.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('message').textContent = data.message;
                document.getElementById('updatePopup').style.display = 'none';
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('message').textContent = 'An error occurred. Please try again.';
            });
        });

        // Open Delete Popup
        document.getElementById('openDeletePopup').addEventListener('click', function() {
            document.getElementById('deletePopup').style.display = 'flex';
        });

        // Close Delete Popup
        document.getElementById('closeDeletePopup').addEventListener('click', function() {
            document.getElementById('deletePopup').style.display = 'none';
        });

        // Submit Delete
        document.getElementById('submitDelete').addEventListener('click', function() {
            const dishName = document.getElementById('deleteDishName').value;

            const formData = new FormData();
            formData.append('dishName', dishName);

            fetch('delete_menu_item.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('message').textContent = data.message;
                document.getElementById('deletePopup').style.display = 'none';
                document.getElementById('addMenuItemForm').reset(); // Clear the form after deletion
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('message').textContent = 'An error occurred. Please try again.';
            });
        });
    </script>
</body>

</html>
