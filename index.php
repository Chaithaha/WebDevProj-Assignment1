<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP-Assignment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Navigation Bar -->

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cartpage.php">Cart</a>
          </li>
        </ul>
      </div>
    </nav>

    <!-- Creating "List of Products" header --> 
     
    <div class = "container-fluid">
        <div class="container"> 
            <div class = "row" align="center"> 
                <div class = "col"> 
                    <h1 class = "display-5 mt-10 mb-10"> List of Products </h1>
                </div>
        </div>
    </div>

    <!-- PHP to SQL Connection string -->

    <?php 
    require('Includes/connection.php');
    $query = 'SELECT * FROM Products';
    $Products = mysqli_query($connect, $query); 
    ?>

<!-- Creating card like format to diplay products --> 

    <div class="container mt-4">
      <div class="row">
        <?php while($product = mysqli_fetch_assoc($Products)): ?>
          <?php $imagePath = !empty($product['Image']) ? $product['Image'] : 'Media'; ?>
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="card h-100">
              <img src="<?php echo $imagePath; ?>" class="card-img-top" alt="Product Image">              
              <div class="card-body">
                <h5 class="card-title"><?php echo $product['Item_Name']; ?></h5>
                <p class="card-text">$<?php echo $product['Price']; ?></p>
                <small>Inventory: <?php echo $product['Inventory']; ?></small>
                <?php if ($product['Inventory'] > 0): ?>
                  <form method="post" action="add_to_cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $product['ID']; ?>">
                    <button type="submit" class="btn btn-primary w-100">Add to Cart</button>
                  </form>
                <?php else: ?>
                  <span style="color: red; font-weight: bold;">Out of Stock</span>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    </div>

</body>
</html>