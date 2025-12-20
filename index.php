
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "sql203.infinityfree.com";
$username = "if0_40706571";
$password = "m52izdmRW6LyT";
$dbname = "if0_40706571_mm25b002";

// Create connection using Object-Oriented style
$conn = new mysqli($servername, $username, $password, $dbname, 3306);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $written = isset($_POST['written']) ? trim($_POST['written']) : '';

    $roll = trim($_POST['roll']);
    
    // Validation
    if (empty($name) || empty($email) || empty($written) || empty($roll)) {
        echo "<h2 style='color: red; text-align: center;'>ERROR: All fields are required!</h2>";
        echo "<p style='text-align: center;'><a href='index.html'>Go Back</a></p>";
        exit;
    }
    
    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<h2 style='color: red; text-align: center;'>ERROR: Invalid email format!</h2>";
        echo "<p style='text-align: center;'><a href='index.html'>Go Back</a></p>";
        exit;
    }
    
    // Insert into database
    $sql = "INSERT INTO contacts (name, email, written, roll) VALUES ('" . $conn->real_escape_string($name) . "', '" . $conn->real_escape_string($email) . "', '" . $conn->real_escape_string($written) . "', '" . $conn->real_escape_string($roll) . "')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<h2 style='color: green; text-align: center;'>SUCCESS!</h2>";
        echo "<p style='text-align: center;'>Your Contact details have been submitted successfully!</p>";
        echo "<p style='text-align: center;'><a href='index.html'>Submit Another Response</a></p>";
    } else {
        echo "<h2 style='color: red; text-align: center;'>Database Error</h2>";
        echo "<p style='text-align: center;'>" . $conn->error . "</p>";
        echo "<p style='text-align: center;'><a href='index.html'>Go Back</a></p>";
    }
    
    $conn->close();
}
?>