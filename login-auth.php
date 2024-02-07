<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    // Get user inputs and sanitize them
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password']; // No need to sanitize password

    // Database configuration file
    require 'db-config.php';

    // Establish database connection
    $conn = new mysqli($host, $db_user, $db_pass, $db_name);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SELECT statement to retrieve hashed password
    $sql = "SELECT `password` FROM `users` WHERE `email` = ?";
    $stmt = $conn->prepare($sql);

    // Bind parameter and execute the statement
    $stmt->bind_param("s", $email);
    $stmt->execute();

    // Bind the result variable
    $stmt->bind_result($hashedPassword);

    // Fetch the result
    $stmt->fetch();

    // Verify the password
    if (password_verify($password, $hashedPassword)) {
        // Password is correct, redirect to the dashboard or another page
        header("Location: dashboard.html");
        exit;
    } else {
        echo "Invalid login credentials";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
