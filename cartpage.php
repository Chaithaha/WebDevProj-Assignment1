<?php
session_start();
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="cartpage.php">Cart</a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="container mt-5">
      <h1 class="mb-4">Your Cart</h1>
      <?php if (empty($cart)): ?>
        <div class="alert alert-info">Your cart is empty. Go add some candles!</div>
      <?php else: ?>
        <table class="table table-bordered align-middle bg-white">
          <thead>
            <tr>
              <th>Image</th>
              <th>Product Name</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($cart as $item): ?>
              <?php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; ?>
              <tr>
                <td><img src="<?php echo $item['image']; ?>" alt="Product Image" style="width:60px; height:60px; object-fit:contain;"></td>
                <td><?php echo $item['name']; ?></td>
                <td>$<?php echo $item['price']; ?></td>
                <td><?php echo $item['quantity']; ?></td>
                <td>$<?php echo $subtotal; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <div class="text-end fw-bold fs-5">Total: $<?php echo $total; ?></div>
      <?php endif; ?>
    </div>
</body>
</html>