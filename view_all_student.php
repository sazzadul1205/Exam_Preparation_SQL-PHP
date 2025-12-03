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
    <table>
        <tr>
            <th>Student ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Mobile</th>
            <th>Course</th>
            <th>Result</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['student_id'] . "</td>";
                echo "<td>" . $row['student_name'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "<td>" . $row['mobile'] . "</td>";
                echo "<td>" . $row['student_name'] . "</td>";
                echo "<td>" . $row['totalmarks'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No records found.</td></tr>";
        }
        ?>
    </table>
</body>

</html>