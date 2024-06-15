<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

@include 'config.php';

// Assuming you have a database connection, you can retrieve the user profile data.
// Here's an example query based on the provided table name and fields.

// Assuming the user ID is stored in a session variable.
$userId = $_SESSION['email'];

// Prepare the query to retrieve the user profile data from the table.
$query = "SELECT name, password, email, address, date, phnum FROM register WHERE email = '$userId'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $profileData = mysqli_fetch_assoc($result);

    if (isset($_POST['update'])) {
        // Retrieve the submitted form data
        $oldPassword = $_POST['old_password'];
        $newPassword = $_POST['new_password'];
        $confirmPassword = $_POST['confirm_password'];

        // Validate the submitted data
        $errors = array();

        if ($newPassword !== $confirmPassword) {
            $errors[] = "New password and confirm password do not match";
            echo '<script>alert("New password and confirm password do not match!!!");</script>';
        } else {
            // Check if the old password matches the one stored in the database
            $storedPassword = $profileData['password'];

            if ($oldPassword == $storedPassword) {
                // The old password is correct, proceed with the password update
                // If there are no validation errors, update the password
                if (empty($errors)) {
                    // Update the password in the database
                    $updateQuery = "UPDATE register SET password = '$newPassword' WHERE email = '$userId'";
                    $updateResult = mysqli_query($conn, $updateQuery);

                    if ($updateResult) {
                        // Password updated successfully
                        echo '<script>alert("Password updated Successfully!!!"); window.location = "profile.php";</script>';
                        // You can redirect the user to a success page or display a success message.
                        exit();
                    } else {
                        // Handle the case when the password update fails
                        echo '<script>alert("Failed to update password"); window.location = "profile.php";</script>';
                        // You can redirect the user to an error page or display an error message.
                        exit();
                    }
                }
            } else {
                // The old password is incorrect
                $errors[] = "Invalid password";
                echo '<script>alert("Invalid old password");</script>';
            }
        }
    }

    // Rest of your code...

} else {
    // Handle the case when the profile data is not found.
    // You can redirect the user to an error page or display an error message.
    // For simplicity, let's redirect the user to the home page.
    header("Location: home.php");
    exit();
}

// Close the database connection.
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/home.css">
    <style>
        @import url("https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700&display=swap");

        body {
            background: #797878;
            font-family: "Ubuntu", sans-serif;
            background-image: url('home.jpg');
        }

        .container {
            background-color: #e9ecef;
            /* Grey background color */
        }

        /* Your CSS styles */
    </style>
</head>

<body>

    <section class="py-5 my-5">
        <div class="container">
            <p style="
              font-family: 'Ubuntu', sans-serif;
              color: black;
              font-size: 30px;
            ">
                Your Profile
            </p>
            <a class="btn btn-primary" href="home.php">Close</a>
            <div class="bg-white shadow rounded-lg d-block d-sm-flex">
                <div class="profile-tab-nav border-right">
                    <div class="p-4">
                        <div class="img-circle text-center mb-3">
                            <img src="profile.png" alt="Image" class="shadow">
                        </div>
                        <h4 class="text-center"><?php echo $profileData['name']; ?></h4>
                    </div>
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="account-tab" data-toggle="pill" href="#account" role="tab"
                            aria-controls="account" aria-selected="true">
                            <i class="fa fa-home text-center mr-1"></i> Account
                        </a>
                        <a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab"
                            aria-controls="password" aria-selected="false">
                            <i class="fa fa-key text-center mr-1"></i> Password
                        </a>
                    </div>
                </div>
                <div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                        <h3 class="mb-4">Account Details</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <p><?php echo $profileData['name']; ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date of Birth</label>
                                    <p><?php echo $profileData['date']; ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <p><?php echo $profileData['email']; ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone number</label>
                                    <p><?php echo $profileData['phnum']; ?></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <p><?php echo $profileData['address']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <a class="btn btn-primary" href="logout.php">Logout</a>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                        <h3 class="mb-4">Password Settings</h3>
                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Old Password</label>
                                        <input type="password" class="form-control" name="old_password" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input type="password" class="form-control" name="new_password" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" class="form-control" name="confirm_password" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary" name="update">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>

</html>
