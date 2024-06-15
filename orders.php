<?php

@include 'config.php';
session_start();

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="home.css">
    <title>Cart</title>
    <style>
      body {
        margin: 0;
        padding: 0;
        background-color: rgb(177, 177, 177);
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
          Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
      }
      ol,
      ul {
        list-style: none;
      }
      a {
        color: white;
        text-decoration: none;
      }
      a:hover {
        color: white;
      }
      
      .small-container {
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .cartpage {
        margin: 0;
  padding: 0;
      }
      .cart-info {
        display: flex;
        flex-wrap: wrap;
      }
      .header {
        width: 100%;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
      }
      table {
        font-family: "Roboto", sans-serif;
        border-collapse: collapse;
        width: 100%;
      }
      th {
        background-color: #303f9f;
        color: white;
        font-weight: bold;
        padding: 15px;
        text-align: left;
      }
      td {
        border-bottom: 1px solid #ddd;
        padding: 15px;
        text-align: left;
      }
      tr:nth-child(even) {
        background-color: #f2f2f2;
      }
      .empty-orders {
        text-align: center;
        padding: 20px;
        font-style: italic;
        color: black;
        font-size: 20px;
      }
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
    <div class="cartpage">
  
    <?php
@include 'config.php';
//session_start();

if (isset($_SESSION['email'])) {
  $userEmail = $_SESSION['email'];

  $select = "SELECT * FROM payment1 WHERE email = '$userEmail'";
  $result = mysqli_query($conn, $select);

  if (mysqli_num_rows($result) > 0) {
    ?>
    <div class="header">
      <h2>Your Orders</h2>
    </div>
    <div class="cart-info">
      <table>
        <tr>
          <th>Product Name</th>
          <th>Price</th>
          <th>Ordered Date</th>
          <th>ID</th>
          <th>Status</th>
          <th>Delivery Code</th>
          <th>Invoice</th>
          <th>Action</th>
        </tr>
        <?php
         $currentdate = date('Y-m-d');
        while ($data = mysqli_fetch_assoc($result)) {
          $productNames = explode(",", $data['pname']);
          $productQuantities = explode(",", $data['pquantity']);
//           $d_date_timestamp = strtotime($data['d_date']);
// $currentdate_timestamp = strtotime($currentdate);
          ?>
          <tr>
            <td><?php echo implode(", ", $productNames); ?></td>
            <td>Rs.<?php echo $data['amount']; ?></td>
            <td><?php echo $data['o_date']; ?></td>
            <td><?php echo $data['id'] ?></td>
            <td><?php echo $data['delivery_stat'] ?></td>
            <td><?php echo $data['dcode'] ?></td>
            <td><a href="invoice.php?id=<?php echo $data['id']; ?>" style="color: black; font-family: 'Ubuntu-Bold', sans-serif">Bill</a></td>
            <td>
           <?php
           if ($data['delivery_stat'] <> 'Delivered'&&$data['delivery_stat'] <> 'yet to return'&&$data['delivery_stat'] <> 'Returned') {
    ?>
    <button style="background-color: red; color: white; padding: 5px 10px;" onclick="cancelOrder(<?php echo $data['id']; ?>)">Cancel order</button>
    <?php
} elseif ( $data['r_order'] <> 'yes'&& strtotime($data['r_within'])>=strtotime( $currentdate) ) {
    ?>
    <button style="background-color: red; color: white; padding: 5px 10px;" onclick="openModal(<?php echo $data['id']; ?>)">Return Order</button>

    <?php
} else {
    ?>
     <a href="feedback.php?id=<?php echo $data['id']; ?>&email=<?php echo $data['email']; ?>"><button style="background-color: red; color: white; padding: 5px 10px;">Give feedback</button></a>
   

   
   <?php
}
?>

            </td>  
          </tr>
          <?php
        }
        ?>
      </table>
    </div>
    <?php
  } else {
    ?>
    <div class="empty-orders">
      No Orders!!!
    </div>
    <?php
  }
} else {
  // Handle the case when the email session variable is not set
}
?>

<script>
function cancelOrder(orderId) {
  if (confirm("Are you sure you want to cancel this order?")) {
    // Send an AJAX request to delete the row in payment1 table
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "cancel_order.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Reload the page to reflect the updated order list
        location.reload();
      }
    };
    xhr.send("orderId=" + orderId);
  }
}

function returnOrder(orderId) {
    if (confirm("Are you sure you want to return this order?")) {
      // Send an AJAX request to update the r_order field
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "return_order.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          // Reload the page to reflect the updated order status
          location.reload();
        }
      };
      xhr.send("orderId=" + orderId);
    }
  }
  function confirmReturn() {
  var returnReason = document.getElementById("returnReason").value;
  if (returnReason !== "") {
    closeModal(); // Close the modal before showing the confirm dialog
    if (confirm("Are you sure you want to return this order?")) {
      // Send an AJAX request to update the r_order and return_reason fields
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "return_order.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          // Reload the page to reflect the updated order status
          location.reload();
        }
      };
      xhr.send("orderId=" + orderId + "&returnReason=" + returnReason);
    }
  } else {
    alert("Please select a reason for returning.");
  }
}
var orderId;

function openModal(id) {
  orderId = id;
  var modal = document.getElementById("reasonModal");
  modal.style.display = "block";
}
function closeModal() {
  var modal = document.getElementById("reasonModal");
  modal.style.display = "none";
}

</script>


    </div>
    <!-- Modal for selecting reason -->
<div id="reasonModal" class="modal">
  <div class="modal-content">
    <h4>Select Reason for Returning</h4>
    <select id="returnReason">
      <option value="Defective">Defective</option>
      <option value="Wrong Item">Wrong Item</option>
      <option value="Not Satisfied">Not Satisfied</option>
      <option value="Prefer Not To Say">Wrong Item</option>
      <!-- Add more options as needed -->
    </select>
    <br>
    <button onclick="confirmReturn()">Confirm Return</button>
    <button onclick="closeModal()">Cancel</button>
  </div>
</div>
  </body>
  <style>
  /* Modal Styles */
  .modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
  }

  .modal-content {
    background-color: #fefefe;
    margin: 10% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 300px;
    max-width: 80%;
    text-align: center;
  }

  .modal-content h4 {
    margin-top: 0;
  }

  .modal-content select {
    width: 100%;
    margin-bottom: 10px;
    padding: 5px;
  }

  .modal-content button {
    margin: 5px;
    padding: 5px 10px;
    background-color: red;
    color: white;
    border: none;
    cursor: pointer;
  }

  .modal-content button:hover {
    opacity: 0.8;
  }
</style>

</html>
