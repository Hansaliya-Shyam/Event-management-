<?php 
// DB credentials.
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'event_db'); // Changed database name to 'event_db'

// Establish database connection using PDO.
try {
    $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}

// Establish database connection using MySQLi.
$conn = mysqli_connect("localhost", "root", "", "event_db"); // Changed database name to 'event_db'
if (!$conn) {
    die("MySQLi Connection failed: " . mysqli_connect_error()); // Added error handling for MySQLi
}
?>