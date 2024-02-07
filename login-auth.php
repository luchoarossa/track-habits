<?php
session_start();
require_once 'db-config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo "Please enter both email and password.";
    } else {

    // Fetch user from database based on email
    $stmt = $link->prepare("SELECT id, email, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verify password
    if ($user && password_verify($password, $user['password'])) {
        // Password is correct, set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        // Redirect to dashboard or home page
        header("Location: dashboard.php");
        exit;
    } else {
        // Incorrect email or password
        echo "Invalid email or password. Please try again.";
    }
}
}
?>
