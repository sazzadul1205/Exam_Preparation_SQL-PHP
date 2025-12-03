<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manufactory</title>
</head>

<?php
$host = "localhost";
$user = "root";
$pass = "";
$db_name = "exam_db";

// Connect to database
$db = new mysqli($host, $user, $pass, $db_name);
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Fetch manufacturers
$sql = "SELECT * FROM manufacfacture";
$result = $db->query($sql);
?>

<body>
    <!-- navbar.php -->
    <nav style="background-color: #333; padding: 10px;">
        <a href="ProductTable.php" style="color: white; margin-right: 15px; text-decoration: none;">Products</a>
        <a href="Manufacture_Product.php" style="color: white; margin-right: 15px; text-decoration: none;">Manufacturers</a>
        <a href="insert_manufacturer.php" style="color: white; margin-right: 15px; text-decoration: none;">Add Manufacturer</a>
        <a href="expecsive_products_view.php" style="color: white; margin-right: 15px; text-decoration: none;">Expensive Products</a>
    </nav>

    <h3>Manufacturer Table</h3>
    <?php
    session_start();
    if (isset($_SESSION['success_message'])) {
        echo "<p style='color: green;'>" . $_SESSION['success_message'] . "</p>";
        unset($_SESSION['success_message']);
    }
    if (isset($_SESSION['fail_message'])) {
        echo "<p style='color: red;'>" . $_SESSION['fail_message'] . "</p>";
        unset($_SESSION['fail_message']);
    }

    ?>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Manufacturer ID</th>
                <th>Manufacturer Name</th>
                <th>Address</th>
                <th>Contact No</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['contact_no']; ?></td>
                        <td>
                            <a href="delete_product.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this manufacturer?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No manufacturers found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>

</html>