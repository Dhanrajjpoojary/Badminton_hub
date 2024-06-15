
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require ('PHPmailer/Exception.php');
require ('PHPmailer/SMTP.php');
require ('PHPmailer/PHPMailer.php');

session_start();

@include 'config.php';


$conn = mysqli_connect('localhost', 'root', '', 'badminto');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$email=$_SESSION['email'];
$query = "SELECT * FROM cart1 where email='$email'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);
$total = 0;






 if (isset($_POST['pay'])) {
  $currentdate = date('Y-m-d');
 $total = 0;

  $pnames = $_POST['p'];
  $pquantities = $_POST['q'];
  $totals = $_POST['r'];
  $count = is_array($pquantities) ? count($pquantities) : 0;

  for ($i = 0; $i < $count; $i++) {
      $cost = $data['pcost'];
      $total += $cost * $quantities[$i];
  }

  
               $total = 0;
            
              mysqli_data_seek($result, 0); // Reset the result pointer to the beginning 
  while($data = mysqli_fetch_assoc($result)) {
   
   
   
      $quantity = $data['pquantity'];
      $cost = $data['pcost'];
      $subtotal = $cost * $quantity;
      $total += $subtotal;
  }
  $str="Will Be Delivered Shortly!!!";  
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $pin = mysqli_real_escape_string($conn, $_POST['pin']);
   // $amount = $_POST['s'];
 // Generate unique code
 $uniqueCode = generateUniqueCode($conn);
    // Inserting into table
   $payment = "INSERT INTO payment1 (fname, lname, email, address, pin, amount, o_date, pname, pcost, pquantity,dcode,delivery_stat) VALUES ('$fname', '$lname', '$email', '$address', '$pin', '$total', '$currentdate', '$pnames', '$totals', '$pquantities',' $uniqueCode',' $str')";
mysqli_query($conn, $payment);

    $query = "DELETE FROM cart1 WHERE  email = '$email'";
$result = mysqli_query($conn, $query);


$q = "SELECT id FROM payment1 where dcode=' $uniqueCode'";
$re = mysqli_query($conn, $q);
$d = mysqli_fetch_assoc($re);
$d1=$d['id'];
  // Create a new PHPMailer instance
  $mail = new PHPMailer(true);

  try {
      // SMTP configuration
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP host
      $mail->SMTPAuth = true;
      $mail->Username = 'dhanrajjpoojary25@gmail.com'; // Replace with your SMTP username
      $mail->Password = 'kqbwbseeysdvftjg'; // Replace with your SMTP password
      $mail->Port = 587; // Replace with your SMTP port (if different)

      // Sender and recipient settings
      $mail->setFrom('dhanrajjpoojary25@gmail.com', 'Badminton Hub'); // Replace with your email address and name
      $mail->addAddress($email, $fname . ' ' . $lname); // Email and name of the recipient

      // Email content
      $mail->isHTML(true);
      $mail->Subject = 'Payment Details';
      $mail->Body = 
      'Dear Customer, your has been placed successfully!!! Details are as follows<br>'.
          'First Name: ' . $fname . '<br>' .
          'Last Name: ' . $lname . '<br>' .
          'Email: ' . $email . '<br>' .
          'Order ID: ' . $d1 . '<br>' .
          'Delivery Code: ' . $uniqueCode . '<br>' .
          'Order Date: ' . $currentdate . '<br>' .
          'Product Names: ' . $pnames . '<br>' .
          'Product Quantities: ' . $pquantities . '<br>' .
          'Total Amount: ' . $total . '<br>' .
          'Delivery Status: ' . $str. '<br>' .
         'Kindly note that keep your delivery code confidential and only share it with our delivery person only after you receive your delivery';


      // Send the email
      $mail->send();
    echo '<script>alert("Paid Successfully!!!"); window.location = "orders.php";</script>';
  } catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}
}
function generateUniqueCode($conn, $length = 5) {
  $characters = '0123456789';
  $code = '';

  do {
      $code = '';
      for ($i = 0; $i < $length; $i++) {
          $code .= $characters[rand(0, strlen($characters) - 1)];
      }
      $query = "SELECT dcode FROM payment1 WHERE dcode = '$code'";
      $result = mysqli_query($conn, $query);
  } while (mysqli_num_rows($result) > 0);

  return $code;
}

?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
   
    <title>Payment</title>

    <link
      rel="canonical"
      href="https://getbootstrap.com/docs/5.1/examples/checkout/"
    />

    <!-- Bootstrap core CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />

    <!-- Favicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
       body{
           margin: 30px;
       }
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <script>
        function show1(){
  document.getElementById('visible').style.display ='block';
}
function show2(){
  document.getElementById('visible').style.display = 'none';
}

function validateExpiration() {
    var selectedMonth = document.getElementById("cc-expiration-month").value;
    var selectedYear = document.getElementById("cc-expiration-year").value;

    var currentYear = new Date().getFullYear();
    var currentMonth = new Date().getMonth() + 1;

    if (
      selectedYear < currentYear ||
      (selectedYear == currentYear && selectedMonth < currentMonth)
    ) {
      document.getElementById("cc-expiration-month").setCustomValidity(
        "Please select a future expiration date"
      );
    } else {
      document.getElementById("cc-expiration-month").setCustomValidity("");
    }
  }
    </script>

    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet" />
  </head>
  <body class="bg-light">
    <div class="container">
      <main>
        <div class="row g-5">
          <div class="col-md-5 col-lg-4 order-md-last">
          
              
            <h4 class="d-flex justify-content-between align-items-center mb-3">
              <span class="text-primary">Your cart</span>
              <span class="badge bg-primary rounded-pill">Price</span>
            </h4>
            
           
  <ul class="list-group mb-3">
             
              
              <div>
              
              <?php
               $total = 0;
              $_SESSION['email'];
              $pnames = "";
$pquantities = "";
$totals = "";
$query = "SELECT * FROM cart1 where email='$email'";
$result = mysqli_query($conn, $query);
              mysqli_data_seek($result, 0); // Reset the result pointer to the beginning 
  while($data = mysqli_fetch_assoc($result)) {
   
   
   
      $quantity = $data['pquantity'];
      $cost = $data['pcost'];
      $subtotal = $cost * $quantity;
      $total += $subtotal;
 
// Store the data in variables
    $pnames .= $data['pname'] . ",";
    $pquantities .= $data['pquantity'] . ",";
    $totals .= ($data['pcost'] * $data['pquantity']) . ",";
    
    ?> 
   <li class="list-group-item d-flex justify-content-between lh-sm">
  <div>
                  <h6 class="my-0"><?php echo $data['pname']; ?> </h6>
                  <small class="text-muted"><?php echo $data['pquantity']; ?></small>
  </div>
                  <span class="text-muted"><?php echo $data['pcost']* $data['pquantity']; ?></span>
                  </li>
                 
                 
                 
                 
                  <?php }
                  // Remove the trailing comma from each variable
$pnames = rtrim($pnames, ",");
$pquantities = rtrim($pquantities, ",");
$totals = rtrim($totals, ",");?>
              
             
              <li class="list-group-item d-flex justify-content-between">
                <span>Total (Rupees)
                </span>
                <strong><i class="fa fa-rupee"></i><?php echo $total; ?></strong>
              </li>
            </ul>

              
              
              
            
          </div>
          <div class="col-md-7 col-lg-8">
          <?php
               
              $_SESSION['email'];
             
$query1 = "SELECT * FROM register where email='$email'";
$result1 = mysqli_query($conn, $query1);
             
$data1 = mysqli_fetch_assoc($result1);

          ?>
            <h4 class="mb-3">Billing address</h4>
            <form action="paymentt.php" method="post"> 
              <div class="row g-3">
                <div class="col-sm-6">
                  <label for="firstName" class="form-label">First name</label>
                  <input
                    type="text"
                    name="fname"
                    class="form-control"
                    id="firstName"
                    placeholder=""
                    value="<?php echo  $data1['name']; ?>"
                    required
                  />
                  <div class="invalid-feedback">
                    Valid first name is required.
                  </div>
                </div>

                <div class="col-sm-6">
                  <label for="lastName" class="form-label">Last name</label>
                  <input
                    type="text"
                    name="lname"
                    class="form-control"
                    id="lastName"
                    placeholder=""
                    value=""
                    required
                  />
                  <div class="invalid-feedback">
                    Valid last name is required.
                  </div>
                </div>

               

                <div class="col-12">
                  <label for="email" class="form-label"
                    >Email </label
                  >
                  <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com" value="<?php echo $email?>" readonly />

                  <div class="invalid-feedback">
                    Please enter a valid email address for shipping updates.
                  </div>
                </div>

                <div class="col-12">
                  <label for="address" class="form-label">Address</label>
                  <input
                    type="text"
                    name="address"
                    class="form-control"
                    id="address"
                    placeholder="1234 Main St"
                    required
                    value="<?php echo  $data1['address']; ?>"
                  />
                  <div class="invalid-feedback">
                    Please enter your shipping address.
                  </div>
                </div>

                

                

                <div class="col-md-3">
                  <label for="zip" class="form-label">PIN</label>
                  <input
                    type="text"
                    name="pin"
                    class="form-control"
                    id="zip"
                    placeholder=""
                    required
                  />
                  <div class="invalid-feedback">Zip code required.</div>
                </div>
              </div>

              <hr class="my-4" />

              <div class="form-check">
                <input
                  type="checkbox"
                  class="form-check-input"
                  id="same-address"
                />
                <label class="form-check-label" for="same-address"
                  >Shipping address is the same as my billing address</label
                >
              </div>

              <div class="form-check">
                <input
                  type="checkbox"
                  class="form-check-input"
                  id="save-info"
                />
                <label class="form-check-label" for="save-info"
                  >Save this information for next time</label
                >
              </div>

              <hr class="my-4" />

              <h4 class="mb-3">Payment</h4>

<div class="my-3">
  <div class="form-check">
    <input
      id="credit"
      name="paymentMethod"
      type="radio"
      class="form-check-input"
      checked
      required
      onclick="show1()"
    />
    <label class="form-check-label" for="credit">Credit card</label>
  </div>
  <div class="form-check">
    <input
      id="debit"
      name="paymentMethod"
      type="radio"
      class="form-check-input"
      required
      onclick="show1()"
    />
    <label class="form-check-label" for="debit">Debit card</label>
  </div>
  <div class="form-check">
    <input
      id="paypal"
      name="paymentMethod"
      type="radio"
      class="form-check-input"
      required
      onclick="show2()"
    />
    <label class="form-check-label" for="paypal">Cash On Delivery</label>
  </div>
</div>

<div id="visible" style="display: none;">
  <div class="row gy-3">
    <div class="col-md-6">
      <label for="cc-name" class="form-label">Card holders name</label>
      <input
        type="text"
        class="form-control"
        id="cc-name"
        placeholder=""
        required
        pattern="[A-Za-z ]+"
        oninvalid="this.setCustomValidity('Please enter a valid name of holder')"
        oninput="this.setCustomValidity('')"
      />
      <small class="text-muted">Full name as displayed on card</small>
      <div class="invalid-feedback">Name on card is required</div>
    </div>

    <div class="col-md-3">
      <label for="cc-expiration-month" class="form-label">Expiration Month</label>
      <select
        class="form-select"
        id="cc-expiration-month"
        required
        onchange="validateExpiration()"
      >
        <option value="" selected disabled>Select Month</option>
        <option value="01">January</option>
        <option value="02">February</option>
        <option value="03">March</option>
        <option value="04">April</option>
        <option value="05">May</option>
        <option value="06">June</option>
        <option value="07">July</option>
        <option value="08">August</option>
        <option value="09">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
        <!-- Add options for other months -->
      </select>
      <div class="invalid-feedback">Expiration month required</div>
    </div>

    <div class="col-md-3">
      <label for="cc-expiration-year" class="form-label">Expiration Year</label>
      <select
        class="form-select"
        id="cc-expiration-year"
        required
        onchange="validateExpiration()"
      >
        <option value="" selected disabled>Select Year</option>
        <script>
          var currentYear = new Date().getFullYear();
          for (var year = currentYear; year <= currentYear + 10; year++) {
            document.write('<option value="' + year + '">' + year + '</option>');
          }
        </script>
      </select>
      <div class="invalid-feedback">Expiration year required</div>
    </div>

    <div class="col-md-3">
      <label for="cc-cvv" class="form-label">CVV</label>
      <input
        type="text"
        class="form-control"
        id="cc-cvv"
        placeholder=""
        required
        pattern="[0-9]{3}"
        oninvalid="this.setCustomValidity('Please enter a valid 3-digit CVV')"
        oninput="this.setCustomValidity('')"
      />
      <div class="invalid-feedback">Security code required</div>
    </div>
  </div>
</div>
              <hr class="my-4" />
            
              <button class="w-100 btn btn-primary btn-lg" type="submit" value="pay"name="pay" >
                Continue to checkout
              </button>
               <?php

echo '<input type="hidden" name="p" value="' . $pnames . '">';
echo '<input type="hidden" name="q" value="' . $pquantities . '">';
echo '<input type="hidden" name="r" value="' . $totals . '">';

?>
</form>
           
          </div>
        </div>
      </main>
    </div>

    

  </body>
</html>