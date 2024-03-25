<?php
// Step 1: Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$database = "souk1";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Fetch user data and order data from the database
$sql = "SELECT users.name, orders.id AS order_id, orders.address, orders.created_at AS order_date 
        FROM users 
        JOIN orders ON users.id = orders.user";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Souk Admin Panel</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Admin Panel</h2>
    <table>
        <tr>
            <th>User Name</th>
            <th>Order ID</th>
            <th>Address</th>
            <th>Order Date</th>
        </tr>
        <?php
        // Step 3: Display the data in a tabular format
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['order_id'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "<td>" . $row['order_date'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No orders found</td></tr>";
        }
        ?>
    </table>
</body>

</html>

<?php
// Close connection
$conn->close();
?>
