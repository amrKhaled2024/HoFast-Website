<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "HoFast";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    $_SESSION['error_message'] = "Connection failed: " . $conn->connect_error;
    header("Location: Sign in.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $_SESSION['error_message'] = "Please enter both email and password.";
        header("Location: Sign in.php");
        exit();
    }

    $stmt = $conn->prepare("SELECT id, first_name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['first_name'] = $user['first_name'];

            header("Location: Home.php");
            exit();
        } else {
            $_SESSION['error_message'] = "Incorrect password.";
            header("Location: Sign in.php");
            exit();
        }
    } else {
        $_SESSION['error_message'] = "User not found.";
        header("Location: Sign in.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
