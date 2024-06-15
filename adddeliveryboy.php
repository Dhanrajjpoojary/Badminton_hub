<!DOCTYPE html>
<html>
<head>
  <title>Delivery Boy Registration</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 500px;
      margin: 0 auto;
      padding: 40px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #333;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      font-weight: bold;
      color: #333;
    }

    input[type="text"],
    input[type="email"],
    input[type="tel"],
    input[type="password"],
    input[type="date"] {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      font-size: 14px;
    }

    .error-message {
      color: red;
      font-size: 12px;
      margin-top: 5px;
    }

    .success-message {
      color: green;
      font-size: 14px;
      text-align: center;
      margin-top: 20px;
    }

    .submit-btn {
      width: 100%;
      padding: 12px;
      background-color: #4caf50;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 14px;
      text-transform: uppercase;
    }

    .logo {
      display: block;
      margin: 0 auto;
      width: 120px;
      height: 120px;
      border-radius: 50%;
      background-color: #4caf50;
      line-height: 120px;
      text-align: center;
      font-size: 40px;
      font-weight: bold;
      color: #fff;
      text-transform: uppercase;
      letter-spacing: 2px;
    }
    .back-button {
      display: block;
      text-align: center;
      margin-top: 20px;
    }
    .delivery-boys-table {
      position: absolute;
      top: 0;
      right: 0;
      width: 20%;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .delivery-boys-table table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    .delivery-boys-table th,
    .delivery-boys-table td {
      padding: 8px;
      border-bottom: 1px solid #ddd;
      text-align: left;
    }
    .delivery-boys-table th {
      background-color: #f2f2f2;
    }
    .delivery-boys-table .delete-btn {
      background-color: #ff3333;
      color: #fff;
      border: none;
      padding: 4px 8px;
      cursor: pointer;
     }
    .delivery-boys-table .delete-btn:hover {
      background-color: #cc0000;
    }
  </style>
  <?php
  // Check if the form is submitted
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'], $_POST['email'], $_POST['date'], $_POST['phnum'], $_POST['password'], $_POST['address'])) {
    // Get the form values
    $name = $_POST['name'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $phnum = $_POST['phnum'];
    $password = $_POST['password'];
    $address = $_POST['address'];

    // Perform the insert operation only if all form fields are present
    if (!empty($name) && !empty($email) && !empty($date) && !empty($phnum) && !empty($password) && !empty($address)) {
      // Execute the insert operation
      $conn = mysqli_connect('localhost', 'root', '', 'badminto');

      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }

      $sql = "INSERT INTO delivery_boy (name, email, date, phnum, password, address) VALUES ('$name', '$email', '$date', '$phnum', '$password', '$address')";

      if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        header("Location: adddeliveryboy.php"); // Redirect to confirmation page or change it to the desired page
        exit;
      } else {
        echo "<div class='error-message'>Error: " . mysqli_error($conn) . "</div>";
      }

      mysqli_close($conn);
    }
  }
  ?>
</head>
<body>
  <div class="container">
    <span class="logo">DB</span>
    <h2>Delivery Boy Registration</h2>
    
      
      <form
          name="myForm"
          action="z11.php"
          method="post"
          onsubmit="return validateForm()"
        >
         
        <div class="form-group">
              <input
                type="text"
                placeholder="Enter Username"
                name="name"
                required
              />
              <div class="error-message" id="nameError"></div>

              <input
                type="email"
                placeholder="Enter Email ID"
                name="email"
                required
              />
              <div class="error-message" id="emailError"></div>

              <input type="date" name="date" required />

              <input
                type="number"
                placeholder="Enter Phone number"
                name="phnum"
                required
              />
              <div class="error-message" id="phnumError"></div>

              <input
                id="pass1"
                type="password"
                placeholder="Enter Password"
                name="password"
                required
              />
              <div class="error-message" id="passwordError"></div>

              <input
                id="pass2"
                type="password"
                placeholder="Confirm Password"
                name="cpassword"
                required
              />
              <div class="error-message" id="cpasswordError"></div>

              <textarea
                name="address"
                id=""
                cols="50"
                rows="5"
                placeholder="Enter Address"
              ></textarea>
              <input type="submit" class="submit-btn" value="Register">
</div>
</form>

    <a href="ad.html" class="back-button">Back</a>
  </div>
  <div class="delivery-boys-table">
    <?php
    // Check if the delete request is submitted
    if (isset($_POST['delete_id']) && !empty($_POST['delete_id'])) {
      $deleteId = $_POST['delete_id'];

      // Perform the delete operation only if a valid ID is provided
      if (!empty($deleteId)) {
        $conn = mysqli_connect('localhost', 'root', '', 'badminto');

        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }

        // SQL statement to delete a delivery boy by ID
        $deleteSql = "DELETE FROM delivery_boy WHERE name = '$deleteId'";

        if (mysqli_query($conn, $deleteSql)) {
          echo "<p>Delivery boy with name $deleteId has been deleted successfully.</p>";
        } else {
          echo "<p>Error deleting delivery boy: " . mysqli_error($conn) . "</p>";
        }

        mysqli_close($conn);
      }
    }

    // Display the table of delivery boys
    $conn = mysqli_connect('localhost', 'root', '', 'badminto');
    $sql = "SELECT * FROM delivery_boy";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      echo "<h3>Registered Delivery Boys:</h3>";
      echo "<table>";
      echo "<tr><th>ID</th><th>Name</th><th>Action</th></tr>";

      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $name = $row['name'];

        echo "<tr>";
        echo "<td>$id</td>";
        echo "<td>$name</td>";
        echo "<td>";
        echo "<form method='POST' action=''>";
        echo "<input type='hidden' name='delete_id' value='$name'>";
        echo "<button type='submit' class='delete-btn'>Delete</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
      }

      echo "</table>";
    } else {
      echo "<p>No delivery boys registered.</p>";
    }

    mysqli_close($conn);
    ?>
  </div>
  <script>
      function validateForm() {
        var name = document.forms["myForm"]["name"].value;
        var email = document.forms["myForm"]["email"].value;
        var phnum = document.forms["myForm"]["phnum"].value;
        var password = document.forms["myForm"]["password"].value;
        var cpassword = document.forms["myForm"]["cpassword"].value;

        // Initialize an error variable
        var error = "";

        // Regular expression patterns
        var namePattern = /^[a-zA-Z\s]+$/;
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        var phonePattern = /^\d{10}$/;
        var passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]).{8,}$/;

        if (!namePattern.test(name)) {
          error += "Name must contain only letters.\n";
          document.getElementById("nameError").innerText =
            "Name must contain only letters.";
        } else {
          document.getElementById("nameError").innerText = "";
        }

        if (!emailPattern.test(email)) {
          error += "Invalid email format. Must be example@gmail.com.\n";
          document.getElementById("emailError").innerText =
            "Invalid email format. Must be example@gmail.com.";
        } else {
          document.getElementById("emailError").innerText = "";
        }

        if (!phonePattern.test(phnum)) {
          error += "Phone number must be 10 digits.\n";
          document.getElementById("phnumError").innerText =
            "Phone number must be 10 digits.";
        } else {
          document.getElementById("phnumError").innerText = "";
        }

        if (!passwordPattern.test(password)) {
          error +=
            "Password must be at least 8 characters long and contain at least one lowercase letter, one uppercase letter, one digit, and one special character.\n";
          document.getElementById("passwordError").innerText =
            "Password must be at least 8 characters long and contain at least one lowercase letter, one uppercase letter, one digit, and one special character.";
        } else {
          document.getElementById("passwordError").innerText = "";
        }

        if (password !== cpassword) {
          error += "Passwords do not match.\n";
          document.getElementById("cpasswordError").innerText =
            "Passwords do not match.";
        } else {
          document.getElementById("cpasswordError").innerText = "";
        }

        if (error !== "") {
          alert(error);
          return false; // Prevent form submission
        }
      }
    </script>
</body>
</html>




