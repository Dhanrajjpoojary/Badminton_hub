
<?php
session_start();
include 'config.php';

if (isset($_SESSION['email'])) {
  $userId = $_SESSION['email'];
  
  // Delete functionality
  if (isset($_POST['delete'])) {
    $delete = $_POST['cdelete'];

    // Retrieve the quantity from the cart1 table
    $select_query = "SELECT pquantity FROM cart1 WHERE pname = '$delete' AND email = '$userId'";
    $select_result = mysqli_query($conn, $select_query);
    $cart_data = mysqli_fetch_assoc($select_result);

    if ($cart_data) {
      $quantity = $cart_data['pquantity'];
      $select_query = "SELECT pquantity FROM products WHERE pname = '$delete'";
      $result = mysqli_query($conn, $select_query);
      $select = mysqli_fetch_assoc($result);
      $updatedq = intval($select['pquantity']) + intval($quantity);
      $update_query = "UPDATE products SET pquantity = $updatedq WHERE pname = '$delete'";
      mysqli_query($conn, $update_query);

      $delete_query = "DELETE FROM cart1 WHERE pname = '$delete' AND email = '$userId'";
      mysqli_query($conn, $delete_query);
      // Rest of your code here...
    } else {
      // Handle the case when no rows are found
    }
    // Update the products table with the retrieved quantity
  }

  $query = "SELECT * FROM cart1 WHERE email='$userId'";
  $result = mysqli_query($conn, $query);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>Cart</title>
  <link rel="stylesheet" href="home.css">
  <link rel="stylesheet" href="./../../fonts/Poppins-Medium.ttf">
  <style>
    /* styles.css */
    body {
    background-color: #F2F2F2; /* Dull cement white */
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
  }

.navbar-container {
  background-color: #333;
  color: white;
  height: 100px;
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


    .small-container {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .cartpage {
      margin: 80px auto;
    }

    .cart-info {
      display: flex;
      flex-wrap: wrap;
    }

   

    
    .btn {
      background-color: #333;
      color: white;
      border: none;
      padding: 5px 10px;
      cursor: pointer;
    }

    .btn:hover {
      background-color: #555;
    }

    tr:nth-child(even) {
      background-color: white;
    }
    .profile-button {
    position: absolute;
    left: 90%;
    background-color: white ;
    border-radius: 25px;
    padding: 10px;
   
  }
  
  .profile-button a {
    
    color: black;
    margin-bottom: 10px;
     text-align: center;
     font-size: 17px;
     font-weight:bold; 

  }

 

    .cart-info {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
    }

    .item {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
      padding: 10px;
      background-color: #fff;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
      width: calc(50% - 20px); /* 2 items per row */
      margin-right: 20px;
    }

    .item:nth-child(3n) {
      width: calc(33.33% - 20px); /* 3 items per row */
      margin-right: 20px;
    }

    .item:nth-child(2n) {
      margin-right: 0;
    }

    .item-details {
      flex: 1;
      margin-right: 20px;
    }

    .item-details h4 {
      font-size: 18px;
      margin: 0 0 5px;
    }

    .item-details p {
      font-size: 14px;
      margin: 0;
    }

    .item-image img {
      width: 80px; /* Adjust the size as needed */
      height: 80px; /* Adjust the size as needed */
      object-fit: cover;
    }

    .item-action {
      margin-left: auto;
    }

    .empty-cart {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      width: 100%;
      padding: 30px;
      background-color: #fff;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .empty-cart i {
      font-size: 48px;
      margin-bottom: 20px;
      color: #aaa;
    }

    .empty-message {
      font-size: 24px;
      margin: 0;
    }

    .empty-submessage {
      font-size: 16px;
      margin: 10px 0 0;
      color: #888;
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
  </style>
</head>

<body>
<div class="navbar-container">
  <header>
    <p>Badminton Hub</p>
  </header>
  <header>
    <p>  </p>
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

  <div>
    <?php if ($result && mysqli_num_rows($result) > 0) { ?>
      <div class="cart-info">
        <?php 
          $total = 0;
          while ($data = mysqli_fetch_assoc($result)) {
            $quantity = $data['pquantity'];
            $cost = $data['pcost'];
            $subtotal = $cost * $quantity;
            $total += $subtotal;
        ?>
          <div class="item">
            <div class="item-details">
              <h4><?php echo $data['pname']; ?></h4>
              <p>Quantity: <?php echo $data['pquantity']; ?></p>
              <p>Date Added: <?php echo $data['date']; ?></p>
              <p>Price: <?php echo $subtotal; ?></p>
            </div>
            <div class="item-image">
              <img src="./image/<?php echo $data['pimage']; ?>" alt="Product Image">
            </div>
            <div class="item-action">
              <form action="" method="post">
                <input type="hidden" name="cdelete" value="<?php echo $data['pname']; ?>">
                <button type="submit" name="delete" class="btn btn-dark">Remove</button>
              </form>
            </div>
          </div>
        <?php } ?>
      </div>

      <div style="display: flex; align-items: center; justify-content: center; flex-direction: column;">
        <p style="color: black; font-size: 30px;">Total = <?php echo $total; ?></p>
        <button type="button" class="btn btn-primary"><a href="paymenttt.php">Proceed for Payment</a></button>
      </div>

    <?php } else { ?>
      <div class="cart-info">
        <div class="empty-cart">
          <i class="fas fa-shopping-cart"></i>
          <p class="empty-message">Oops! Your cart is empty.</p>
          <p class="empty-submessage">Start shopping and add some items to your cart!</p>
        </div>
      </div>
    <?php } ?>
  </div>
</body>
</html>
