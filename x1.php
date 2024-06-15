<?php
session_start();

// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'badminto');

// Check if the code has already been executed

    // Main logic
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the selected start date and time
        $startDateTime = $_POST['start_datetime'];
        $startTimestamp = strtotime($startDateTime);

        // Retrieve the selected end date and time
        $endDateTime = $_POST['end_datetime'];
        $endTimestamp = strtotime($endDateTime);

        // Retrieve the discount percentages for each category
        $raquetsDiscount = $_POST['raquets_discount'];
        $shuttlesDiscount = $_POST['shuttles_discount'];
        $shoesDiscount = $_POST['shoes_discount'];
        $grippersDiscount = $_POST['grippers_discount'];

        // Insert the form details into the table
        $sqlInsert = "INSERT INTO bigbillion (start_datetime, end_datetime, raquets_discount, shuttles_discount, shoes_discount, grippers_discount) VALUES ('$startDateTime', '$endDateTime', '$raquetsDiscount', '$shuttlesDiscount', '$shoesDiscount', '$grippersDiscount')";
        $resultInsert = $conn->query($sqlInsert);

        if ($resultInsert) {
            $_SESSION['success_message'] = "Entry inserted successfully into bigbillion table.";

            // Copy data from source_table to destination_table
            $sqlCopyData = "INSERT INTO billionproducts (p_id1, pname1, pdescript1, pcost1, pcat1, imgg1, pquantity1)
                            SELECT p_id, pname, pdescript, pcost, pcat, imgg, pquantity
                            FROM products";
            $resultCopyData = $conn->query($sqlCopyData);

            if ($resultCopyData) {
                $_SESSION['success_message'] .= " Data copied successfully from products table to billionproducts table.";

                // Update pcost1 column in billionproducts table based on the discount values
                $sqlUpdate = "UPDATE billionproducts
                              SET pcost1 = pcost1 - (pcost1 * CASE
                                  WHEN pcat1 = 'Racquet' THEN $raquetsDiscount/100
                                  WHEN pcat1 = 'Shuttle' THEN $shuttlesDiscount/100
                                  WHEN pcat1 = 'Shoes' THEN $shoesDiscount/100
                                  WHEN pcat1 = 'Gripper' THEN $grippersDiscount/100
                                  ELSE 0
                              END)";
                $resultUpdate = $conn->query($sqlUpdate);

                if ($resultUpdate) {
                    $_SESSION['success_message'] .= " pcost1 updated successfully for categories.";
                    // Set the flag to indicate that the code has been executed
                  

                    // Redirect to another page
                    header("Location: ad.html");
                    exit();
                } else {
                    $_SESSION['error_message'] .= " Error updating pcost1 for categories: " . $conn->error;
                }
            } else {
                $_SESSION['error_message'] = "Error copying data from products table to billionproducts table: " . $conn->error;
            }
        } else {
            $_SESSION['error_message'] = "Error inserting entry into bigbillion table: " . $conn->error;
        }
    }


// Check if the end_datetime is less than or equal to the current time
$currentTimestamp = time();
$sqlClearEntries = "DELETE FROM bigbillion WHERE end_datetime <= NOW()";
$resultClearEntries = mysqli_query($conn, $sqlClearEntries);


?>




<!DOCTYPE html>
<html>

<head>
    <title> Big Badminton Days</title>
    <style>
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="datetime-local"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2> Big Badminton Days</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <label for="start_datetime">Select start date and time:</label>
            <input type="datetime-local" id="start_datetime" name="start_datetime"required>

            <label for="end_datetime">Select end date and time:</label>
            <input type="datetime-local" id="end_datetime" name="end_datetime"required>

            <label for="raquets_discount">Racquets discount (%):</label>
            <input type="number" id="raquets_discount" name="raquets_discount"required>

            <label for="shuttles_discount">Shuttles discount (%):</label>
            <input type="number" id="shuttles_discount" name="shuttles_discount"required>

            <label for="shoes_discount">Shoes discount (%):</label>
            <input type="number" id="shoes_discount" name="shoes_discount"required>

            <label for="grippers_discount">Grippers discount (%):</label>
            <input type="number" id="grippers_discount" name="grippers_discount"required>

            <?php
    $sqlSelect1 = "SELECT * FROM billionproducts";
    $resultSelect1 = $conn->query($sqlSelect1);
    if ($resultSelect1->num_rows == 1) {
        $disableButton = 'disabled';
    } else {
        $disableButton = '';
    }
?>

<input type="submit" value="Submit" <?php echo $disableButton; ?>>

        </form>
    </div>
</body>

</html>
