<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Student</title>
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

<?php

$sql = "SELECT * FROM students";
$result = $db->query($sql);

$students = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $students[] = [
            'id' => $row['id'],
            'name' => $row['name']
        ];
    }
}
?>

<body>
    <form action="">
        <h3>Select Student for Delete</h3>
        <label for="student">Student:</label>
        <select name="student" id="student">
            <?php foreach ($students as $student): ?>
                <option value="<?php echo $student['id']; ?>"><?php echo $student['name']; ?> - <?php echo $student['id']; ?></option>
            <?php endforeach; ?>
        </select>
        <br><br>
        <button type="submit" name="delete">Delete Student</button>
    </form>

    <?php
    if (isset($_GET['delete'])) {
        $studentId = $_GET['student'];
        $sql = "DELETE FROM students WHERE id = '$studentId'";
        $db->query($sql);
        if ($db->affected_rows) {
            echo "Student Deleted Successfully.";
        } else {
            echo "Error deleting student.";
        }
    }
    ?>

</body>

</html>