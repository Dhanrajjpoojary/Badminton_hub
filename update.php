
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet" />
  <!-- <link rel="stylesheet" href="padd.css" /> -->
  <title>Manage Products</title>
</head>
<style>
body {
  margin: 0;
  padding: 0;
  font-family: 'Ubuntu', sans-serif;
  background-color: #f4f4f4;
}

.maincontainer {
  text-align: center;
}

.imgcontainer {
  background-color: #333;
  padding: 20px;
}

.imgcontainer1 {
  background-color: #333;
  padding: 10px;
}

.imgcontainer p {
  margin: 0;
}

.divcontainer {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  padding: 20px;
  background-color: #fff;
  margin: 20px;
}

.divcontainer .container {
  margin: 10px 0;
}

.divcontainer input[type='text'],
.divcontainer input[type='number'],
.divcontainer textarea,
.divcontainer select {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

.divcontainer button {
  background-color: #4caf50;
  color: #fff;
  border: none;
  padding: 10px 20px;
  cursor: pointer;
}

.divcontainer button span {
  display: inline-block;
  width: 16px;
  height: 16px;
  margin-right: 8px;
  border: 2px solid #fff;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

.divcontainer a {
  color: #fff;
  text-decoration: none;
  font-size: 16px;
  margin-left: 10px;
}

.product-list {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.product-item {
  background-color: #fff;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
  border-radius: 4px;
  width: 300px;
  margin: 20px;
}

.product-details {
  padding: 20px;
}

.product-details img {
  width: 100%;
  height: auto;
}

.product-details h3 {
  margin: 0;
}

.product-actions {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 10px;
  background-color: #f4f4f4;
}

.product-actions a {
  color: #4caf50;
  text-decoration: none;
  padding: 6px 10px;
  margin: 0 4px;
}

.back-link {
  text-align: center;
  margin: 20px;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

</style>
<body>
  <div class="maincontainer">
   
  </div>
  <div class="imgcontainer">
    <p style="font-family: 'Ubuntu-Bold', sans-serif; color: white; font-size: 30px;">Manage Products</p>
  </div>
  <div class="product-list">
    <?php
      @include 'config.php';

      // Fetch products from the database
      $selectProducts = "SELECT * FROM products";
      $result = mysqli_query($conn, $selectProducts);

      if (mysqli_num_rows($result) > 0) {
        while ($product = mysqli_fetch_assoc($result)) {
    ?>
    <div class="product-item">
      <div class="product-details">
        <img src="image/<?php echo $product['imgg']; ?>" alt="Product Image" />
        <h3><?php echo $product['pname']; ?></h3>
        <p><?php echo $product['pdescript']; ?></p>
        <p>Category: <?php echo $product['pcat']; ?></p>
        <p>Price: Rs.<?php echo $product['pcost']; ?></p>
        <p>Quantity: <?php echo $product['pquantity']; ?></p>
      </div>
      <div class="product-actions">
        <a href="update_product.php?id=<?php echo $product['p_id']; ?>">Edit</a>
        <a href="delete_product.php?id=<?php echo $product['p_id']; ?>">Delete</a>
      </div>
    </div>
    <?php
        }
      } else {
        echo "<p>No products found!</p>";
      }
    ?>
  </div>
  <div class="back-link">
    <a href="ad.html">Back</a>
  </div>
</body>
</html>
