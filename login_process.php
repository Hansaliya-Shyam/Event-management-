<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "event_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Fetch user data from the database
    $sql = "SELECT * FROM user_register WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Login successful
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            echo "<script>alert('Login successful!'); window.location.href='dashboard.php';</script>";
        } else {
            echo "<script>alert('Invalid password.'); window.location.href='loginpage.php';</script>";
        }
    } else {
        echo "<script>alert('User not found.'); window.location.href='loginpage.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href='loginpage.php';</script>";
}

$conn->close();
?>