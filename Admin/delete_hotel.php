<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "HoFast";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $sql = "DELETE FROM hotels WHERE id = $id";
        $conn->query($sql);
    }

    $conn->close();
    header("Location: Admin_hotel.php");
    exit;
?>