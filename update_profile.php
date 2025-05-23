<?php
    session_start();
    $userId = $_SESSION['user_id'];

    $_SESSION['first_name'] = $_POST['first_name'];

    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];

    $conn = new mysqli("localhost", "root", "", "HoFast");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("UPDATE users SET first_name=?, last_name=?, email=? WHERE id=?");
    $stmt->bind_param("sssi", $firstName, $lastName, $email, $userId);

    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: Account.php");
    exit;
?>
