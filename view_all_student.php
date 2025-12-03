<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Student & Results</title>
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
$sql = "SELECT * FROM student_results";
$result = $db->query($sql);
?>

<body>
    <h3>All Students</h3>

    <?php
    session_start();
    if (isset($_SESSION['success'])) {
        echo "<p style='color: green;'>" . htmlspecialchars($_SESSION['success']) . "</p>";
        unset($_SESSION['success']);
    }
    ?>
    <table>
        <tr>
            <th>Student ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Mobile</th>
            <th>Course</th>
            <th>Result</th>
            <th>Action</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['student_id']) ?></td>
                    <td><?= htmlspecialchars($row['student_name']) ?></td>
                    <td><?= htmlspecialchars($row['address']) ?></td>
                    <td><?= htmlspecialchars($row['mobile']) ?></td>
                    <td><?= htmlspecialchars($row['module_name']) ?></td>
                    <td><?= htmlspecialchars($row['totalmarks']) ?></td>
                    <td>
                        <a href="edit_student.php?id=<?= urlencode($row['student_id']) ?>">Edit</a>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">No records found.</td>
            </tr>
        <?php endif; ?>

    </table>
</body>

</html>