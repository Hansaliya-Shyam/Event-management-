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
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Secure password hashing

    // Check if username or email already exists
    $check_sql = "SELECT * FROM user_register WHERE username = '$username' OR email = '$email'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        echo "<script>alert('Username or email already exists.'); window.location.href='loginpage.php';</script>";
    } else {
        // Insert into user_register table
        $insert_sql = "INSERT INTO user_register (username, email, password) VALUES ('$username', '$email', '$password')";

        if ($conn->query($insert_sql)) {
            echo "<script>alert('Registration successful! Please log in.'); window.location.href='loginpage.php';</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "'); window.location.href='loginpage.php';</script>";
        }
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href='loginpage.php';</script>";
}

$conn->close();
?>