<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Menu Pop-up</title>
    <link rel="stylesheet" href="./style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            background-color: black;
            color: white;
            border-radius: 5px;
        }

        #confirmationMessage {
            background-color: black;
            width: 100%;
            color: goldenrod;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: auto;
        }

        .popup {
            width: 80%;
            max-height: 80vh;
            background-color: goldenrod;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .navbar {
            width: 100%;
            display: flex;
            justify-content: space-around;
            background-color: rgba(0, 0, 0, 0.219);
            margin-bottom: 20px;
            border: 1px solid black;
        }

        .navbar button {
            background: transparent;
            border: none;
            color: rgb(255, 255, 255);
            font-size: 18px;
            cursor: pointer;
        }

        .menu-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            width: 100%;
        }

        .menu-card {
            display: flex;
            justify-content: space-between;
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 10px;
            width: 48%;
            margin: 10px 0;
            padding: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .menu-image {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 10px;
        }

        .menu-card img {
            width: 100px;
            height: 100px;
            border-radius: 10px;
            object-fit: cover;
        }

        .menu-details {
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin-right: auto;
            text-align: left;
        }

        .menu-card h3 {
            margin: 10px 0;
        }

        .description {
            font-size: 12px;
            margin: 5px 0;
        }

        .price {
            font-weight: bold;
            margin-top: 5px;
        }

        .total-container {
            position: fixed;
            bottom: 10px;
            right: 10px;
            background-color: goldenrod;
            color: black;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 18px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        .popup .popup-heading {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: black;
        }

        .close-button {
            padding: 10px;
            background-color: black;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 10px;
            width: 100px;
        }

        .adjust {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .quantity-controlss {
            display: flex;
            align-items: center;
            margin-left: 10px;


        }

        .quantity {
            margin-top: 4px;
        }

        .quantity-controls button {
            margin: 0 5px;
            background-color: black;
            height: 29px;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 60px;
            height: 30px;
            margin-top: 5px;


        }

        .add-button {
            background-color: black;
            color: white;
            margin-top: 5px;
            width: 140px;
            max-width: 200px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
        }

        .add-button:hover {
            background-color: green;

        }


        @media (max-width: 768px) {
            .popup {
                width: 90%;
                max-height: 90vh;
                padding: 10px;
                margin-top: 84px;
            }

            .navbar {
                flex-direction: column;
                align-items: center;
                margin-bottom: 10px;
            }

            .navbar button {
                width: 100%;
                margin-bottom: 5px;
                text-align: center;
            }

            .menu-card {
                width: 100%;
                flex-direction: column;
                align-items: center;
                text-align: center;
                /* Center the text in the menu card */
            }

            .menu-details {
                display: flex;
                /* Use flexbox */
                flex-direction: column;
                /* Stack items vertically */
                align-items: center;
                /* Center items horizontally */
                text-align: center;
                /* Center the text */
                margin: 10px 0;
                /* Add some margin for spacing */
            }

            .description {
                text-align: center;
                /* Center the description */
                font-size: 14px;
                /* Adjust font size if necessary */
                margin: 0;
                /* Remove margin for better centering */
            }

            .menu-image {
                margin: 10px 0;
            }

            .menu-card img {
                width: 120px;
                /* Increase the image size */
                height: 120px;
                /* Increase the image height */
                margin-bottom: 10px;
                /* Add some margin below the image */
            }

            .quantity-controls {
                margin-top: 10px;
            }

            .add-button {
                width: 100%;
                height: 35px;
                margin-top: 10px;
            }

            .total-container {
                bottom: 20px;
                right: 20px;
                font-size: 16px;
                padding: 10px 15px;
            }

            .close-button {
                width: 80px;
                font-size: 14px;
            }

            .popup-heading {
                font-size: 20px;
            }
        }

        .download-button {
            position: absolute;
            top: 10px;
            left: 10px;
            padding: 5px 10px;
            background-color: black;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .hidden-image {
            display: none;
        }

        .download-button {
            width: 170px;
            display: flex;
            align-items: center;
         
            gap: 5px;
         
        }
    </style>
</head>
<body>

<div class="body_show_menu">
    <form id="menuForm" action="./directorder.php" method="GET">
        <div id="menuPopup" class="popup">
            <h2 class="popup-heading">Menu</h2>
            <div class="navbar">
                <button type="button" onclick="showSection('snacks')">Snacks & Starters</button>
                <button type="button" onclick="showSection('rice')">Rice & Noodles</button>
                <button type="button" onclick="showSection('dal')">Dal & Vegies</button>
                <button type="button" onclick="showSection('south')">South Indian</button>
                <button type="button" onclick="showSection('roti')">Roti & Paranthas</button>
                <button type="button" onclick="showSection('rolls')">Rolls & Sandwich</button>
                <button type="button" onclick="showSection('sweets')">Sweets & Beverages</button>
                <button type="button" onclick="showSection('combos')">Meals & Combo</button>
            </div>
            <div class="menu-container" id="menuContainer"></div>
            <div class="adjust">
                <button type="submit" onclick="passTotalAmount()">Submit</button>
            </div>
        </div>
    </form>

    <div id="totalContainer" class="total-container">
        Total (including GST): ₹<span id="totalPrice">0</span>
    </div>
</div>

<script>
    let totalItems = [];

    async function fetchMenuItems() {
        const response = await fetch('fetch_menu.php');
        const menuItems = await response.json();
        // console.log("menuItems",menuItems);
        
        return menuItems;
       
    }

    async function showSection(sectionId) {
        const menuContainer = document.getElementById('menuContainer');
        menuContainer.innerHTML = '';

        const menuItems = await fetchMenuItems();

        menuItems.filter(item => item.category === sectionId).forEach(item => {
            const card = document.createElement('div');
            card.className = 'menu-card';

            card.innerHTML = `
                <div class="menu-details">
                    <h3>${item.dish_name}</h3>
                    <p class="description">${item.description}</p>
                    <p class="price">₹${item.price}</p>
                </div>
                <div class="quantity-controlss">
                    <button class="add-button" type="button" onclick="addItem('${item.dish_name}', ${item.price}, this)">Add</button>
                    <div class="quantity-controls" style="display: none;">
                        <button type="button" onclick="changeQuantity('decrement', '${item.dish_name}', ${item.price}, this)">-</button>
                        <span class="quantity">0</span>
                        <button type="button" onclick="changeQuantity('increment', '${item.dish_name}', ${item.price}, this)">+</button>
                    </div>
                </div>
                <div class="menu-image">
                    <img src="${item.image_path}" alt="${item.dish_name}">
                </div>
            `;

            menuContainer.appendChild(card);
        });
    }

    function addItem(itemName, itemPrice, button) {
        const quantityControls = button.nextElementSibling;
        quantityControls.style.display = "flex"; 
        button.style.display = "none"; 

        let quantityElement = quantityControls.querySelector('.quantity');
        let currentQuantity = parseInt(quantityElement.textContent) || 0;

        currentQuantity += 1; 
        quantityElement.textContent = currentQuantity;

        const existingItem = totalItems.find(item => item.name === itemName);
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            totalItems.push({
                name: itemName,
                price: itemPrice,
                quantity: currentQuantity
            });
        }

        updateTotal();
    }

    function changeQuantity(action, itemName, itemPrice, button) {
        const quantityElement = button.parentElement.querySelector('.quantity');
        let currentQuantity = parseInt(quantityElement.textContent);

        if (action === 'increment') {
            currentQuantity += 1;
        } else if (action === 'decrement' && currentQuantity > 0) {
            currentQuantity -= 1;
        }

        quantityElement.textContent = currentQuantity;

        const item = totalItems.find(item => item.name === itemName);
        if (item) {
            item.quantity = currentQuantity;
            if (currentQuantity === 0) {
                totalItems = totalItems.filter(i => i.name !== itemName);
                button.parentElement.style.display = "none"; 
                button.parentElement.previousElementSibling.style.display = "block"; 
            }
        }

        updateTotal();
    }

    function updateTotal() {
        const totalPrice = totalItems.reduce((total, item) => total + (item.price * item.quantity), 0);
        document.getElementById('totalPrice').textContent = totalPrice;
    }

    function passTotalAmount() {
        const totalAmount = totalItems.reduce((total, item) => total + (item.price * item.quantity), 0);
        document.getElementById('totalPrice').textContent = totalAmount;
    }

    // Initial load to show the first category
    fetchMenuItems().then(() => showSection('snacks'));
</script>

</body>
</html>
