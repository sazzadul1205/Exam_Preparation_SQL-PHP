<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
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

session_start();
?>

<body>

    <form action="">
        <h3>Login Please</h3>
        <label for="email">email:</label>
        <input type="email" id="email" name="email" required>
        <br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <button type="submit" name="login">Login</button>
    </form>

    <?php
    if (isset($_GET['login'])) {
        $email = $_GET['email'];
        $password = $_GET['password'];
        $hashed_password = md5($password);
        $sql = "SELECT * FROM users WHERE email='$email' AND password='$hashed_password'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            $_SESSION['email'] = $email;
            echo "Login Successful. Welcome, " . $email;
        } else {
            echo "Invalid email or password.";
        }
    }
    ?>

</body>

</html>