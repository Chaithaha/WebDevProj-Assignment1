<?php
session_start();
require('Includes/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);
    // Get product info from database
    $query = "SELECT * FROM Products WHERE ID = $product_id";
    $result = mysqli_query($connect, $query);
    $product = mysqli_fetch_assoc($result);

    if ($product && $product['Inventory'] > 0) {

        // Cart Logic

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        // Logic for user to add mulitple items of the same product as long as the inventory exists.

        if (isset($_SESSION['cart'][$product_id])) {
            if ($_SESSION['cart'][$product_id]['quantity'] < $product['Inventory']) {
                $_SESSION['cart'][$product_id]['quantity']++;
                // Decrease inventory in database
                $update = "UPDATE Products SET Inventory = Inventory - 1 WHERE ID = $product_id AND Inventory > 0";
                mysqli_query($connect, $update);
            }
        } else {

            // Add a new product to cart
            
            $_SESSION['cart'][$product_id] = [
                'id' => $product['ID'],
                'name' => $product['Item_Name'],
                'price' => $product['Price'],
                'image' => $product['Image'],
                'quantity' => 1
            ];
            // Decrease inventory in database
            $update = "UPDATE Products SET Inventory = Inventory - 1 WHERE ID = $product_id AND Inventory > 0";
            mysqli_query($connect, $update);
        }
    }
}

// Redirect back to index.php

header('Location: index.php');
exit; 