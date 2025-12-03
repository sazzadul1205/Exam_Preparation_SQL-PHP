<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
</head>
<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "idb_bisew_evidence";
$db = new mysqli($host, $user, $pass, $db);
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>

<body>
    <form action="">
        <h3>Add New Student</h3>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br><br>
        <label for="address">Address</label>
        <textarea name="address" id="address" cols="30" rows="5" required></textarea>
        <br><br>
        <label for="mobile">Mobile</label>
        <input type="text" id="mobile" name="mobile" required>
        <br><br>
        <button type="submit" name="add">Add Student</button>

    </form>

    <?php
    if (isset($_GET['add'])) {
        $name = $_GET['name'];
        $address = $_GET['address'];
        $mobile = $_GET['mobile'];
        $sql = "CALL AddStudent('$name', '$address', '$mobile')";
        $db->query($sql);
        if ($db->affected_rows) {
            echo "Student Added Successfully.";
        } else {
            echo "Error adding student.";
        }
    }
    ?>
</body>

</html>