<?php
// Database connection
$servername = "localhost";
$username = "root"; // default username in localhost (XAMPP)
$password = ""; // default password is blank
$dbname = "heartvibe"; // change if your DB name is different

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize message variable
$message_status = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize form data
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $subject = $conn->real_escape_string($_POST['subject']);
    $message = $conn->real_escape_string($_POST['message']);

    // Insert data into table
    $sql = "INSERT INTO contact (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

    if ($conn->query($sql) === TRUE) {
        $message_status = "✅ Your message has been sent successfully! Thank you for contacting HeartVibe ❤️";
    } else {
        $message_status = "❌ Sorry, something went wrong. Please try again later.";
    }

    $conn->close();
}
?>

<!-- Display the success or error message -->
<?php if (!empty($message_status)): ?>
    <div style="margin: 20px auto; padding: 15px; border-radius: 8px; background: #f9f9f9; color: #333; max-width: 600px; text-align: center; font-family: Arial, sans-serif;">
        <?php echo $message_status; ?>
    </div>
<?php endif; ?>
