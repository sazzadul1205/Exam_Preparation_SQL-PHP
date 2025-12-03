<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Manufacturer</title>
</head>

<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "exam_db";
$db = new mysqli($host, $user, $pass, $db);
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>

<body>
    <!-- navbar.php -->
    <nav style="background-color: #333; padding: 10px;">
        <a href="ProductTable.php" style="color: white; margin-right: 15px; text-decoration: none;">Products</a>
        <a href="Manufacture_Product.php" style="color: white; margin-right: 15px; text-decoration: none;">Manufacturers</a>
        <a href="insert_manufacturer.php" style="color: white; margin-right: 15px; text-decoration: none;">Add Manufacturer</a>
        <a href="expecsive_products_view.php" style="color: white; margin-right: 15px; text-decoration: none;">Expensive Products</a>
    </nav>

    <form action="" method="post">
        <h3>Insert Manufacturer</h3>
        <label for="name">Manufacturer Name:</label>
        <input type="text" id="name" name="name" required>
        <br><br>
        <label for="address">Address</label>
        <textarea name="address" id="address" cols="30" rows="5" required></textarea>
        <br><br>
        <label for="contact">Contact</label>
        <input type="text" id="contact" name="contact" required>
        <br><br>
        <button type="submit" name="insert">Insert Manufacturer</button>
    </form>

    <?php
    if (isset($_POST['insert'])) {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $sql = "CALL Insert_Manufacturer('$name', '$address', '$contact')";
        if ($db->query($sql) === TRUE) {
            echo "Manufacturer Inserted Successfully.";
        } else {
            echo "Error inserting manufacturer: " . $db->error;
        }
    }
    ?>

</body>

</html>