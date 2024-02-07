<?php
// Include the database configuration file
include 'db-config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    // Retrieve form data and sanitize inputs
    $fullName = filter_var($_POST['fullName'], FILTER_SANITIZE_STRING);
    $username = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password']; // No need to sanitize password as it will be hashed

    // Validate input
    if (empty($fullName) || empty($username) || empty($password)) {
        // Handle empty fields
        echo "Please fill in all fields.";
    } elseif (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
        // Handle invalid email format
        echo "Invalid email format.";
    } else {
        // Check if email already exists in the database
        $stmt = $link->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Handle existing email
            echo "Email already registered. Please use a different email.";
        } else {
            // Hash the password for security
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            // Get the current date and time
            $date = date('Y-m-d H:i:s');
            
            // Insert user into database
            $stmt = $link->prepare("INSERT INTO users (date, fullName, username, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $date, $fullName, $username, $hashedPassword);
            
            if ($stmt->execute()) {
                // Registration successful
                echo "Registration successful!";
            } else {
                // Handle database insertion error
                echo "Error occurred while registering. Please try again.";
            }
        }
    }
} else {
    // Redirect users if they try to access this page directly
    header("Location: login.html");
    exit;
}
?>
