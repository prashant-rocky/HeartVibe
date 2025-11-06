<?php
// Database connection
$servername = "localhost";
$username = "root";  // default for XAMPP
$password = "";      // default password is blank
$dbname = "heartvibe";  // your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check DB connection
if ($conn->connect_error) {
    die("❌ Database connection failed: " . $conn->connect_error);
}

// Check if POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $conn->real_escape_string($_POST['email']);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<span style='color:red;'>❌ Invalid email address.</span>";
        exit;
    }

    // Insert into 'subscribe' table
    $sql = "INSERT INTO subscribe (email) VALUES ('$email')";

    if ($conn->query($sql) === TRUE) {
        echo "<span style='color:green;'>✅ Thank you for subscribing to HeartVibe!</span>";
    } else {
        echo "<span style='color:red;'>⚠️ You may have already subscribed.</span>";
    }

    $conn->close();
} else {
    echo "<span style='color:red;'>Invalid request.</span>";
}
?>
