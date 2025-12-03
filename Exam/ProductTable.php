<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
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

// Fetch products
$sql = "SELECT * FROM product";
$result = $db->query($sql);
session_start();
?>

<body>
    <!-- navbar.php -->
    <nav style="background-color: #333; padding: 10px;">
        <a href="ProductTable.php" style="color: white; margin-right: 15px; text-decoration: none;">Products</a>
        <a href="Manufacture_Product.php" style="color: white; margin-right: 15px; text-decoration: none;">Manufacturers</a>
        <a href="insert_manufacturer.php" style="color: white; margin-right: 15px; text-decoration: none;">Add Manufacturer</a>
        <a href="expecsive_products_view.php" style="color: white; margin-right: 15px; text-decoration: none;">Expensive Products</a>
    </nav>


    <h3>Products Table</h3>
    <?php
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
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Manufacturer ID</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['manufacturer_id']; ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No products found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>

</html>