<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
</head>

<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "idb_bisew_evidence";

$db = new mysqli($host, $user, $pass, $dbname);
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$message = "";
session_start();

// Handle form submission for updating
if (isset($_POST['update'])) {
    $id = $_POST['student_id'];
    $name = trim($_POST['name']);
    $address = trim($_POST['address']);
    $mobile = trim($_POST['mobile']);

    if ($name === "" || $address === "" || $mobile === "") {
        $message = "All fields are required.";
    } else {
        $stmt = $db->prepare("UPDATE students SET name=?, address=?, mobile=? WHERE id=?");
        $stmt->bind_param("sssi", $name, $address, $mobile, $id);
        if ($stmt->execute()) {
            $_SESSION['success'] = "Student updated successfully.";
            header("Location: view_all_student.php");
            exit();
        } else {
            $message = "Error updating student: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Fetch student by ID (from GET parameter)
$student = null;
if (isset($_GET['id'])) {
    $studentId = (int)$_GET['id'];
    $stmt = $db->prepare("SELECT * FROM students WHERE id=?");
    $stmt->bind_param("i", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
    $stmt->close();
}

if (!$student && isset($_GET['id'])) {
    echo "<p>Student not found.</p>";
    exit;
}
?>

<body>
    <h2>Edit Student</h2>

    <?php if ($message !== ""): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <?php if ($student): ?>
        <form method="post" action="">
            <input type="hidden" name="student_id" value="<?= $student['id'] ?>">

            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($student['name']) ?>" required><br><br>

            <label for="address">Address:</label><br>
            <textarea id="address" name="address" cols="30" rows="5" required><?= htmlspecialchars($student['address']) ?></textarea><br><br>

            <label for="mobile">Mobile:</label><br>
            <input type="text" id="mobile" name="mobile" value="<?= htmlspecialchars($student['mobile']) ?>" required><br><br>

            <button type="submit" name="update">Update Student</button>
        </form>
    <?php else: ?>
        <p>No student selected.</p>
    <?php endif; ?>

</body>

</html>