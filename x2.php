



<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

@include 'config.php';
session_start();
//$userEmail = $_SESSION['email'];


  if (isset($_POST['addcart'])) {
    $userEmail = $_SESSION['email'];
    $currentdate = date('Y-m-d');
    $p_name = $_POST['pname'];
    $p_price = $_POST['pcost'];
    $p_image = $_POST['imgg'];
    $quantity = $_POST['quantity'];

    // Check if the product quantity is sufficient
    $selectProduct = "SELECT * FROM products WHERE pname = '$p_name'";
    $productResult = mysqli_query($conn, $selectProduct);
    $productData = mysqli_fetch_assoc($productResult);

    if ($quantity > $productData['pquantity']) {
      echo '<script>alert("Insufficient Quantity"); window.location = "x2.php";</script>';
      exit();
    }

    $select = "SELECT * FROM cart1 WHERE pname = '$p_name' AND email = '$userEmail'";
    $result = mysqli_query($conn, $select);
    $data1 = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) > 0 && $data1['pname'] == $p_name) {
      // Product already added to cart, update the quantity
      $newQuantity = intval($data1['pquantity']) + intval($quantity);

      // Check if the updated quantity is within the available product quantity
      if ($newQuantity > $productData['pquantity']) {
        echo '<script>alert("Insufficient Quantity"); window.location = "x2.php";</script>';
        exit();
      }
      else{

      $updateQuery = "UPDATE cart1 SET pquantity = '$newQuantity' WHERE pname = '$p_name' AND email = '$userEmail'";
      mysqli_query($conn, $updateQuery);

      // Subtract the added quantity from the product quantity in the database
      $updatedQuantity = intval($productData['pquantity']) - intval($quantity);
      $updateProductQuery = "UPDATE products SET pquantity = '$updatedQuantity' WHERE pname = '$p_name'";
      mysqli_query($conn, $updateProductQuery);

      echo 'Quantity updated in cart!';
      }
    } else {
      // Check if the product quantity is sufficient
      // if ($quantity > $productData['pquantity']) {
      //   echo 'Insufficient quantity!';
      //   exit();
      // }

      // Update the product quantity in the database
      $updatedQuantity = intval($productData['pquantity']) - intval($quantity);
      $updateProductQuery = "UPDATE products SET pquantity = '$updatedQuantity' WHERE pname = '$p_name'";
      mysqli_query($conn, $updateProductQuery);

      $insert = "INSERT INTO cart1 (pname, pimage, pcost, date, email, pquantity) VALUES ('$p_name', '$p_image', '$p_price', '$currentdate', '$userEmail', '$quantity')";
      if (mysqli_query($conn, $insert)) {
        echo 'Added to cart!';
      } else {
        echo 'Error: ' . mysqli_error($conn);
      }
    }
  }


 
     


  if (isset($_POST['addcart1'])) {
    $userEmail = $_SESSION['email'];
   // $userEmail = $_SESSION['email'];
    $currentdate = date('Y-m-d');
    $p_name = $_POST['pname1'];
    $p_price = $_POST['pcost1'];
    $p_image = $_POST['imgg1'];
    $quantity = $_POST['quantity1'];

    // Check if the product quantity is sufficient
    $selectProduct = "SELECT * FROM billionproducts WHERE pname1 = '$p_name'";
    $productResult = mysqli_query($conn, $selectProduct);
    $productData = mysqli_fetch_assoc($productResult);

    if ($quantity > $productData['pquantity1']) {
      echo '<script>alert("Insufficient Quantity"); window.location = "x2.php";</script>';
      exit();
    }

    $select = "SELECT * FROM cart1 WHERE pname = '$p_name' AND email = '$userEmail'";
    $result = mysqli_query($conn, $select);
    $data1 = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) > 0 && $data1['pname'] == $p_name) {
      // Product already added to cart, update the quantity
      $newQuantity = intval($data1['pquantity']) + intval($quantity);

      // Check if the updated quantity is within the available product quantity
      if ($newQuantity > $productData['pquantity1']) {
        echo '<script>alert("Insufficient Quantity"); window.location = "x2.php";</script>';
        exit();
      }

      $updateQuery = "UPDATE cart1 SET pquantity = '$newQuantity' WHERE pname = '$p_name' AND email = '$userEmail'";
      mysqli_query($conn, $updateQuery);

      // Subtract the added quantity from the product quantity in the database
      $updatedQuantity = intval($productData['pquantity1']) - intval($quantity);
      $updateProductQuery = "UPDATE billionproducts SET pquantity1 = '$updatedQuantity' WHERE pname1 = '$p_name'";
      mysqli_query($conn, $updateProductQuery);

      echo 'Quantity updated in cart!';
    } else {
      // Check if the product quantity is sufficient
      // if ($quantity > $productData['pquantity1']) {
      //   echo 'Insufficient quantity!';
      //   exit();
      // }

      // Update the product quantity in the database
      // $updatedQuantity = intval($productData['pquantity']) - intval($quantity);
      // $updateProductQuery = "UPDATE products SET pquantity = '$updatedQuantity' WHERE pname = '$p_name'";
      // mysqli_query($conn, $updateProductQuery);

      $insert = "INSERT INTO cart1 (pname, pimage, pcost, date, email, pquantity) VALUES ('$p_name', '$p_image', '$p_price', '$currentdate', '$userEmail', '$quantity')";
      if (mysqli_query($conn, $insert)) {
        echo 'Added to cart!';
      } else {
        echo 'Error: ' . mysqli_error($conn);
      }
    }
  }

?>



<html lang="en">
  <head>
  <meta http-equiv="refresh" content="60">
    <title>Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

 
    <link
      href="https://fonts.googleapis.com/css?family=Bentham|Playfair+Display|Raleway:400,500|Suranna|Trocchi"
      rel="stylesheet"
    />
   
    <link rel="stylesheet" href="home.css" />
  </head>
  <style>
    
    body {
  background-color: #F2F2F2; /* Dull cement white */
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
}

.navbar-container {
  background-color: #333;
  color: white;
  height: 80px; /* Decreased height */
}

.logo {
  font-size: 36px;
  margin: 0;
}

.highlight {
  color: #FFD700; /* Change this to the desired highlight color */
}

nav ul {
  list-style: none;
  display: flex;
  justify-content: flex-start;
  align-items: center;
  padding: 0;
  margin: 0;
}

nav ul li {
  margin-right: 15px;
}

nav ul li a {
  color: white;
  text-decoration: none;
  font-size: 18px;
}

nav ul li a:hover {
  color: #ccc;
}
.profile-button {
  position: absolute;
  left: 90%;
  background-color: white;
  border-radius: 25px;
  padding: 10px;
}

.profile-button a {
  color: black;
  margin-bottom: 10px;
  text-align: center;
  font-size: 17px;
  font-weight: bold;
}
.navbar-container header {
  padding: 20px;
  text-align: center;
}

.navbar-container header p {
  margin: -14px 0 0; /* Adjust the margin-top value as needed */
  font-size: 24px;
  font-weight: bold;
  text-decoration: underline;
  transition: color 0.5s ease;
}

.navbar-container header:hover p {
  color: #FFD700;
}
  
    
    
    #select1 {
      flex-direction: row;
      width: 10em;
      height: 2em;
      font-size: larger;
      color: white;
      padding-left: 20px;
      outline: none;
      border-radius: 2em;
      border: 2px solid white;
      background-color: rgb(46, 46, 46);
      position: absolute;
      top: 0;
      left: 15%;
    }
    .select {
      position: relative;
      top: 10px;
      left: 30%;
    }
    .Search-btn {
  border-radius: 25px;
  width: 100px;
  height: 30px;
  padding: 10px 0;
  margin-left: 20px;
  font-weight: bold;
  border: none;
  background: #2196F3; /* Blue color */
  color: #ffffff; /* White text color */
  position: absolute;
  top: 20px; /* Adjust the value to move the button down */
  left: 28%;
  transform: translateY(-50%);
}


.search-span {
  background: #ffffff; /* White background */
  height: 100%;
  width: 0;
  border-radius: 25px;
  position: absolute;
  left: 0;
  bottom: 0;
  z-index: -1;
  transition: 0.5s;
}

.Search-btn:hover span {
  width: 100%;
}

.Search-btn:hover {
  background: #ffffff; /* White background on hover */
  color: #2196F3; /* Blue text color on hover */
}


  

.text__animation1 {
    align-items: center;
    display: flex;
    justify-content: center;
}
.title1 {
  animation: 3s linear 0s normal none infinite running npa;
  color: white;
  font-size: 5em;
  line-height: 1;
  margin: 0;
  padding: 0;
  text-align: center;
}

@-webkit-keyframes npa {
    0% {
        text-shadow: -6px 4px 0px red;
    }
    10% {
        text-shadow: 4px -6px 0px green;
    }
    20% {
        text-shadow: -9px 4px 0px blue;
    }
    30% {
        text-shadow: 4px -6px 0px yellow;
    }
    40% {
        text-shadow: -8px 4px 0px orange;
    }
    50% {
        text-shadow: 4px 5px 0px purple;
    }
    60% {
        text-shadow: -6px 4px 0px brown;
    }
    70% {
        text-shadow: 4px 7px 0px pink;
    }
    80% {
        text-shadow: -9px -4px 0px lime;
    }
    90% {
        text-shadow: 4px -6px 0px cyan;
    }
    100% {
        text-shadow: -9px 4px 0px teal;
    }
}

@keyframes npa {
    0% {
        text-shadow: -6px 4px 0px red;
    }
    10% {
        text-shadow: 4px -6px 0px green;
    }
    20% {
        text-shadow: -9px 4px 0px blue;
    }
    30% {
        text-shadow: 4px -6px 0px yellow;
    }
    40% {
        text-shadow: -8px 4px 0px orange;
    }
    50% {
        text-shadow: 4px 5px 0px purple;
    }
    60% {
        text-shadow: -6px 4px 0px brown;
    }
    70% {
        text-shadow: 4px 7px 0px pink;
    }
    80% {
        text-shadow: -9px -4px 0px lime;
    }
    90% {
        text-shadow: 4px -6px 0px cyan;
    }
    100% {
        text-shadow: -9px 4px 0px teal;
    }
}

.navbar-container {
  background-color: #333;
  color: white;
  height: 80px; /* Decreased height */
}

.logo {
  font-size: 36px;
  margin: 0;
}

.highlight {
  color: #FFD700; /* Change this to the desired highlight color */
}

nav ul {
  list-style: none;
  display: flex;
  justify-content: flex-start;
  align-items: center;
  padding: 0;
  margin: 0;
}

nav ul li {
  margin-right: 15px;
}

nav ul li a {
  color: white;
  text-decoration: none;
  font-size: 18px;
}

nav ul li a:hover {
  color: #ccc;
}
.profile-button {
  position: absolute;
  left: 90%;
  background-color: white;
  border-radius: 25px;
  padding: 10px;
}

.profile-button a {
  color: black;
  margin-bottom: 10px;
  text-align: center;
  font-size: 17px;
  font-weight: bold;
}
.navbar-container header {
  padding: 20px;
  text-align: center;
}

.navbar-container header p {
  margin: -14px 0 0; /* Adjust the margin-top value as needed */
  font-size: 24px;
  font-weight: bold;
  text-decoration: underline;
  transition: color 0.5s ease;
}

.navbar-container header:hover p {
  color: #FFD700;
}
  
/* Reset default styles */
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

/* Main product wrapper */
.product-wrapper {
  max-width: 900px; /* Adjust the width as per your requirement */
  margin: 0 auto; /* Center the container horizontally */
  display: flex;
  flex-wrap: wrap; /* Allow products to wrap to the next line */
  justify-content: space-between; /* Add space between products */
}

/* Product container */
.product-container {
  width: calc(33.33% - 20px); /* Adjust the width to display three products */
  padding: 10px;
  box-sizing: border-box;
  margin-bottom: 40px; /* Add margin at the bottom */
  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2); /* Add shadow effect */
}

/* Responsive adjustments */
@media screen and (max-width: 991px) {
  .product-container {
    width: calc(50% - 20px); /* Adjust the width to display two products */
  }
}


/* Product image */
.product-img {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 200px; /* Adjust the height as per your requirement */
}

.product-img img {
  display: block;
  max-height: 100%;
  max-width: 100%;
  object-fit: contain;
}

/* Product information container */
.product-info {
  margin-top: 10px;
}

/* Product title */
.product-title {
  font-size: 24px;
  font-weight: 500;
  margin-bottom: 10px;
}

/* Product category */
.product-category {
  font-size: 14px;
  color: #878787;
  margin-bottom: 10px;
}

/* Product description */
.product-description {
  font-size: 16px;
  margin-bottom: 10px;
  line-height: 1.5;
}

/* Product stock status */
.product-stock {
  font-size: 14px;
  margin-bottom: 10px;
}

/* Out of stock */
.out-of-stock {
  color: #ff0000;
}

/* Limited stock */
.limited-stock {
  color: #ff8800;
}

/* In stock */
.in-stock {
  color: #00aa00;
}

/* Quantity input container */
.quantity-input-container {
  margin-top: 10px;
}

/* Quantity input label */
.quantity-input-label {
  display: block;
  font-size: 14px;
  margin-bottom: 5px;
}

/* Quantity input */
.quantity-input {
  width: 60px;
  padding: 5px;
  font-size: 14px;
}

/* Product price and button container */
.product-price-btn {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

/* Product price */
.product-price {
  font-size: 24px;
  font-weight: bold;
  color: #ff5722;
}

/* Currency symbol */
.currency-symbol {
  margin-right: 5px;
}

/* Add to cart form */
.add-to-cart-form {
  position: relative;
}

/* Add to cart button */
.add-to-cart-btn {
  padding: 10px 20px;
  background-color: #ff5722;
  color: #ffffff;
  border: none;
  border-radius: 2px;
  font-size: 16px;
  cursor: pointer;
}

/* Add to cart button hover effect */
.add-to-cart-btn:hover {
  background-color: #f44336;
}

/* Add to cart button absolute positioning */
.add-to-cart-btn {
  position: absolute;
  right: 0;
  bottom: 0;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  -webkit-transform: translate(-50%, -50%);
}

/* Responsive adjustments */
@media screen and (max-width: 767px) {
  .product-container {
    width: 100%;
  }
}



  </style>

  <body>
  <div class="navbar-container">
  <header>
    <p>Badminton Hub</p>
  </header>
 
  <nav>
    <ul id="mainMenu">
    <li><a href="home.php"><i class="fas fa-home"></i> Home</a></li>
  <li><a href="services.php"><i class="fas fa-cogs"></i> Services</a></li>
  <li><a href="x2.php"><i class="fas fa-shopping-bag"></i> Products</a></li>
  <li><a href="orders.php"><i class="fas fa-clipboard-list"></i> Orders</a></li>
  
      <li><a href="cart.php"><strong><i class="fas fa-shopping-cart"></i> Cart</strong></a></li>
      <li class="profile-button"><a href="profile.php"><i class="fas fa-user"></i> Profile</a></li>
    </ul>
  </nav>
</div>




   
    
   
   
   
   
   

    <div class="select">
  <label style="color: black; font-size: large; padding-right: 10px">What are you looking for?</label>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
    <select name="select_product" id="select1">
    <option value="all" <?php if(!isset($_GET['select_product']) || $_GET['select_product'] === 'all') echo 'selected'; ?>>All Products</option>
        
    <option value="Racquet" <?php if(isset($_GET['select_product']) && $_GET['select_product'] === 'Racquet') echo 'selected'; ?>>Racquets</option>
      <option value="Shuttle" <?php if(isset($_GET['select_product']) && $_GET['select_product'] === 'Shuttle') echo 'selected'; ?>>Shuttle</option>
      <option value="Shoes" <?php if(isset($_GET['select_product']) && $_GET['select_product'] === 'Shoes') echo 'selected'; ?>>Shoes</option>
      <option value="Gripper" <?php if(isset($_GET['select_product']) && $_GET['select_product'] === 'Gripper') echo 'selected'; ?>>Grippers</option>
    </select>
    <button class="Search-btn" type="submit" name="search">
      <span class="search-span"></span>Search
    </button>
  </form>
</div>
<script>
setTimeout(function() {
      location.reload(); // Reload the page after the specified time
    }, 60000); // 60000 milliseconds = 60 seconds
  </script>


<?php
@include 'config.php';







$sqlSelect = "SELECT * FROM bigbillion WHERE start_datetime<=NOW() AND  end_datetime >= NOW()";
$resultSelect = mysqli_query($conn, $sqlSelect);



if (mysqli_num_rows($resultSelect) >0){  

  ?>


<div class="text__animation1 bg-image--1 fullscreen">
		<h2 class="title1">Sale Is Live!!!</h2>
	</div>

<?php
}?>

    
    <div class="container"> 
    
    
    <?php
@include 'config.php';




$currentDateTime = date('Y-m-d H:i:s');


$currentDateTime = mysqli_real_escape_string($conn, $currentDateTime); // Escape the value to prevent SQL injection

$sqlSelect = "SELECT * FROM bigbillion WHERE start_datetime<=NOW() AND  end_datetime >= NOW()";
$resultSelect = mysqli_query($conn, $sqlSelect);

$sqlSelect1 = "SELECT * FROM billionproducts ";
$resultSelect1 = mysqli_query($conn, $sqlSelect1);


$sqlSelect2 = "SELECT * FROM bigbillion WHERE  end_datetime <=NOW()";
$resultSelect2 = mysqli_query($conn, $sqlSelect2);



if (mysqli_num_rows($resultSelect) >0&&mysqli_num_rows($resultSelect1) >0){
  $data = mysqli_fetch_assoc($resultSelect);

// if ($currentDateTime >= $startDateTime && $currentDateTime <= $endDateTime){
    $ch = 0;
// Check if a specific category is selected
if (isset($_GET['search']) && isset($_GET['select_product'])) {
  $selectedCategory = $_GET['select_product'];

  if ($selectedCategory === 'all') {
    // Fetch all products from the database
    $query = "SELECT * FROM billionproducts";
  } else {
    // Perform a database query to retrieve products of the selected category
    $query = "SELECT * FROM billionproducts WHERE pcat1 = '$selectedCategory'";
  }
} else {
  // Fetch all products from the database
  $query = "SELECT * FROM billionproducts";
}

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
  $productCount = 0; // Initialize product count
  echo '<div class="product-wrapper">'; // Start product wrapper
  while ($data = mysqli_fetch_assoc($result)) {
    // Display product information here
    $productId = $data['p_id1']; // Unique identifier for each product
    ?>

    <div class="product-container" id="product<?php echo $productId; ?>">
      <div class="product-img">
        <img src="./image/<?php echo $data['imgg1']; ?>" height="420" width="327" />
      </div>

      <div class="product-info">
        <div class="product-text">
          <h1 class="product-title"><?php echo $data['pname1']; ?></h1>
          <p class="product-category">Type: <?php echo $data['pcat1']; ?></p>
          <p class="product-description">
            <?php echo $data['pdescript1']; ?>
          </p>
          <?php if ($data['pquantity1'] == 0) : ?>
            <p class="product-stock out-of-stock">Out of Stock</p>
          <?php elseif ($data['pquantity1'] < 10) : ?>
            <p class="product-stock limited-stock">Hurry! Only a few left</p>
          <?php else : ?>
            <p class="product-stock in-stock">In Stock: <?php echo $data['pquantity1']; ?></p>
          <?php endif; ?>

          <?php if ($data['pquantity1'] > 0) : ?>
            <div class="quantity-input-container">
              <label class="quantity-input-label" for="quantity-input-<?php echo $productId; ?>">Quantity:</label>
              <input type="number" id="quantity-input-<?php echo $productId; ?>" class="quantity-input" name="quantity[<?php echo $productId; ?>]" value="1" min="1" max="<?php echo $data['pquantity1']; ?>" oninput="updateHiddenInput(this.value, '<?php echo $productId; ?>')">
            </div>
          <?php endif; ?>
        </div>

        <div class="product-price-btn">
          <p class="product-price">
            <span class="currency-symbol">&#x20B9;</span><?php echo $data['pcost1']; ?><span></span>
          </p>

          <?php if ($data['pquantity1'] > 0) : ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="add-to-cart-form">
              <input type="hidden" name="pname1" value="<?php echo $data['pname1']; ?>">
              <input type="hidden" name="pcost1" value="<?php echo $data['pcost1']; ?>">
              <input type="hidden" name="imgg1" value="<?php echo $data['imgg1']; ?>">
              <input type="hidden" name="quantity1" value="1" min="1" max="<?php echo $data['pquantity1']; ?>" id="hiddenQuantity-<?php echo $productId; ?>">
              <button type="submit" name="addcart1" class="add-to-cart-btn">Add To Cart</button>
            </form>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <?php
    $productCount++; // Increment product count

    // Check if two products have been displayed
    if ($productCount % 2 == 0) {
      echo '</div><div class="product-wrapper">'; // Start a new product wrapper for the next row
    }
  }

  echo '</div>'; // Close the last product wrapper

  echo '<p style="color: white; position: relative; left: 90%; top: 20%">That\'s All!!!</p>';
} else {
  echo '<p style="color: white; position: relative; left: 90%; top: 20%">No Products To Display!!!</p>';
}

  }


// Display the products



elseif(mysqli_num_rows($resultSelect2) >0){




 
    // Update 'pquantity' field in the 'product' table with values from 'billionproducts'
    $sqlUpdateProduct = "UPDATE products
                         INNER JOIN billionproducts ON products.p_id = billionproducts.p_id1
                         SET products.pquantity = billionproducts.pquantity1";
    $resultUpdateProduct = mysqli_query($conn, $sqlUpdateProduct);
   
        // Delete all entries from the 'billionproducts' table
        
        
        $sqlDeleteBillionProducts1 = "DELETE FROM bigbillion";
        $resultDeleteBillionProducts1 = mysqli_query($conn, $sqlDeleteBillionProducts1);
        $sqlDeleteBillionProducts = "DELETE FROM billionproducts";
        $resultDeleteBillionProducts = mysqli_query($conn, $sqlDeleteBillionProducts);
       
}else{

    $ch = 0;
    // Check if a specific category is selected
    if (isset($_GET['search']) && isset($_GET['select_product'])) {
      $selectedCategory = $_GET['select_product'];
    
      if ($selectedCategory === 'all') {
        // Fetch all products from the database
        $query = "SELECT * FROM products";
      } else {
        // Perform a database query to retrieve products of the selected category
        $query = "SELECT * FROM products WHERE pcat = '$selectedCategory'";
      }
    } else {
      // Fetch all products from the database
      $query = "SELECT * FROM products";
    }
    
    $result = mysqli_query($conn, $query);
    
    // Display the products
    
    if (mysqli_num_rows($result) > 0) {
  $productCount = 0; // Initialize product count
  echo '<div class="product-wrapper">'; // Start product wrapper
  while ($data = mysqli_fetch_assoc($result)) {
    // Display product information here
    $productId = $data['p_id']; // Unique identifier for each product
    ?>

    <div class="product-container" id="product<?php echo $productId; ?>">
      <div class="product-img">
        <img src="./image/<?php echo $data['imgg']; ?>" height="420" width="327" />
      </div>

      <div class="product-info">
        <div class="product-text">
          <h1 class="product-title"><?php echo $data['pname']; ?></h1>
          <p class="product-category">Type: <?php echo $data['pcat']; ?></p>
          <p class="product-description">
            <?php echo $data['pdescript']; ?>
          </p>
          <?php if ($data['pquantity'] == 0) : ?>
            <p class="product-stock out-of-stock">Out of Stock</p>
          <?php elseif ($data['pquantity'] < 10) : ?>
            <p class="product-stock limited-stock">Hurry! Only a few left</p>
          <?php else : ?>
            <p class="product-stock in-stock">In Stock: <?php echo $data['pquantity']; ?></p>
          <?php endif; ?>

          <?php if ($data['pquantity'] > 0) : ?>
            <div class="quantity-input-container">
              <label class="quantity-input-label" for="quantity-input-<?php echo $productId; ?>">Quantity:</label>
              <input type="number" id="quantity-input-<?php echo $productId; ?>" class="quantity-input" name="quantity[<?php echo $productId; ?>]" value="1" min="1" max="<?php echo $data['pquantity']; ?>" oninput="updateHiddenInput(this.value, '<?php echo $productId; ?>')">
            </div>
          <?php endif; ?>
        </div>

        <div class="product-price-btn">
          <p class="product-price">
            <span class="currency-symbol">&#x20B9;</span><?php echo $data['pcost']; ?><span></span>
          </p>

          <?php if ($data['pquantity'] > 0) : ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="add-to-cart-form">
              <input type="hidden" name="pname" value="<?php echo $data['pname']; ?>">
              <input type="hidden" name="pcost" value="<?php echo $data['pcost']; ?>">
              <input type="hidden" name="imgg" value="<?php echo $data['imgg']; ?>">
              <input type="hidden" name="quantity" value="1" min="1" max="<?php echo $data['pquantity']; ?>" id="hiddenQuantity-<?php echo $productId; ?>">
              <button type="submit" name="addcart" class="add-to-cart-btn">Add To Cart</button>
            </form>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <?php
    $productCount++; // Increment product count

    // Check if two products have been displayed
    if ($productCount % 2 == 0) {
      echo '</div><div class="product-wrapper">'; // Start a new product wrapper for the next row
    }
  }

  echo '</div>'; // Close the last product wrapper

  echo '<p style="color: white; position: relative; left: 90%; top: 20%">That\'s All!!!</p>';
} else {
  echo '<p style="color: white; position: relative; left: 90%; top: 20%">No Products To Display!!!</p>';
}

  }



?>


     
      
    </div>

    <footer class="footer">
      <div class="about">
        <p><strong>About</strong></p>
        <p><a href="contact.php">Contact Us</p>
        <p><a href="about.php">About us</p>
        <p>Our Social Media Handles:</p>
        <div class="icons">
          <a href="#"
            ><img src="whatsapp.png" alt="" width="20" height="20"
          /></a>
          <a href="#"
            ><img src="facebook.png" alt="" width="20" height="20"
          /></a>
          <a href="#"
            ><img src="instagram.png" alt="" width="20" height="20"
          /></a>
        </div>
      </div>

      <div class="help">
        <p><strong>Help</strong></p>
        <p><a href="payments.php">Payments</p>
        <p><a href="shipping.php">Shipping</p>
      </div>
      <div class="address">
        <p><strong>Visit our Shop:</strong></p>
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3884.197886376466!2d75.00047231461471!3d13.212889390697955!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bbb57ccb46f93fd%3A0x5463a907579f060!2sThribhuvan%20badminton%20Hub%20and%20Gutting%20centre!5e0!3m2!1sen!2sin!4v1640965345331!5m2!1sen!2sin"
          width="200"
          height="200"
          style="border: 0"
          allowfullscreen=""
          loading="lazy"
        ></iframe>
      </div>
    </footer>
  </body>
  <script>
    
  function updateHiddenInput(value, productId) {
    if (value == '' || value == 0 || value == 1) {
      value = 1;
    }
    document.getElementById("hiddenQuantity-" + productId).value = value;
  }

    
    


    setTimeout(function() {
      location.reload(); // Reload the page after the specified time
    }, 6000); 
  </script>
 
</html>


