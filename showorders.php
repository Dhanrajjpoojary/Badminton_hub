<?php
@include 'config.php';
session_start();

$select = "SELECT * FROM payment1 WHERE delivery_stat <> 'Delivered' AND delivery_stat <> 'Returned'";

$result = mysqli_query($conn, $select);
$sql = "INSERT INTO delivery_or_return (o_id, fname, lname, address, amount, o_date, delivery_stat)
SELECT p1.id, p1.fname, p1.lname, p1.address, p1.amount, p1.o_date, p1.delivery_stat
FROM payment1 p1
WHERE p1.delivery_stat NOT IN ('Delivered', 'Returned')
AND NOT EXISTS (
  SELECT 1
  FROM delivery_or_return dor
  WHERE dor.o_id = p1.id
)";

// Execute the SQL statement
mysqli_query($conn, $sql);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $deliveryBoy = $_POST['delivery_boy'];
    $orderId = $_POST['order_id'];

    // Establish a database connection
   $conn = mysqli_connect('localhost','root', '','badminto');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Update the "assigned_to" field in the database for the corresponding order ID
    $updateQuery = "UPDATE delivery_or_return SET assigned_to = '$deliveryBoy' WHERE o_id = '$orderId'";

    if (mysqli_query($conn, $updateQuery)) {
        // Redirect back to the same page to avoid re-executing the POST request
       
       
    } else {
        echo "Error assigning delivery boy: " . mysqli_error($conn);
    }

   
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thribhuvan Badminton Hub</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: rgb(177, 177, 177);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
        }

        .table-container {
            margin: 30px;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <h1 class="text-white ml-4 mt-4">Delivery and Return Details</h1>
    <div class="table-container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Payment ID</th>
                    <th scope="col">User Booked</th>
                    <th scope="col">Delivery Status</th>
                    <th scope="col">Assign Delivery Boy</th>
                    <!-- New column header -->
                    <th scope="col">Status</th>
                    <!-- New column header -->
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($data = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $data['pname']; ?></td>
                            <td><?php echo $data['pcost']; ?></td>
                            <td><?php echo $data['id']; ?></td>
                            <td><?php echo $data['fname'] . ' ' . $data['lname']; ?></td>
                            <td><?php echo $data['delivery_stat']; ?></td>
                            <td>
                                <form action="" method="post">
                                    <select name="delivery_boy">
                                        <?php
                                        $deliveryBoyResult = mysqli_query($conn, "SELECT name FROM delivery_boy");
                                        while ($deliveryBoyData = mysqli_fetch_assoc($deliveryBoyResult)) {
                                            $selected = ($deliveryBoyData['name'] == $data['assigned_to']) ? 'selected' : '';
                                            echo '<option value="' . $deliveryBoyData['name'] . '" ' . $selected . '>' . $deliveryBoyData['name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <input type="hidden" name="order_id" value="<?php echo $data['id']; ?>">
                                    <input type="submit" value="Assign">
                                </form>
                            </td>
                            <td>
                                <?php
                                $orderId = $data['id'];
                                $checkAssignedQuery = "SELECT assigned_to FROM delivery_or_return WHERE o_id = '$orderId'";
                                $checkAssignedResult = mysqli_query($conn, $checkAssignedQuery);
                                if (mysqli_num_rows($checkAssignedResult) > 0) {
                                    $assignedData = mysqli_fetch_assoc($checkAssignedResult);
                                    if ($assignedData['assigned_to'] != '') {
                                        echo 'Assigned to ' . $assignedData['assigned_to'];

                                    } else {
                                        echo 'Not Assigned';
                                    }
                                } else {
                                    echo 'Not Assigned';
                                }
                                ?>
                            </td>
                        </tr>
                    <?php
                }
            } else {
                ?>
                    <tr>
                        <td colspan="7">No Orders!!!</td>
                    </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <a href="ad.html" class="btn btn-primary">Back</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ND91+VN6F5vnGKG3iGsQj2c1GgT3poJm6r59wN9e0PFRNH2rV+kSDt9HxIaIlHHj" crossorigin="anonymous"></script>
</body>

</html>