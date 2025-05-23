<?php
session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "HoFast";

$_SESSION['error_message'] = '';

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        throw new Exception("Database connection failed");
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $password = trim($_POST['password']);

        if (empty($email) || empty($password)) {
            throw new Exception("Please enter both email and password.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format");
        }


        $stmt = $conn->prepare("SELECT id, first_name, last_name, email, password FROM users WHERE email = ?");
        if (!$stmt) {
            throw new Exception("Database error: " . $conn->error);
        }

        $stmt->bind_param("s", $email);
        if (!$stmt->execute()) {
            throw new Exception("Database error: " . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {

                session_regenerate_id(true);
                

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['first_name'] = $user['first_name'];
                $_SESSION['last_name'] = $user['last_name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['logged_in'] = true;

                unset($_SESSION['error_message']);

                header("Location: Home.php");
                exit();
            } else {
                throw new Exception("Incorrect email or password.");
            }
        } else {
            throw new Exception("Incorrect email or password.");
        }

        $stmt->close();
    }
} catch (Exception $e) {
    $_SESSION['error_message'] = $e->getMessage();
    header("Location: Sign_in.php");
    exit();
} finally {
    if (isset($conn)) {
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HoFast - Sign in</title>
    <link rel="shortcut icon" href="./source/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./Home.css">
</head>
<body class="signin">
    <aside id="slider_bar">
        <div class="close" onclick="close_slider()">
            <img src="./source/close.svg" width="25" alt="close">
        </div>

        <ul>
            <a href="./Home.php"><li>Home</li></a>
            <a href="./Hotels.php"><li>Hotels</li></a>
            <a href="./About.php"><li>About</li></a>
            <a href="./Sign_in.php" class="flex-row active">
                <img src="./source/person-circle.svg" width="30" alt="">
                <li>Log in</li>
            </a>
            <a href="./Sign_up.php" class="flex-row">
                <img src="./source/person-circle.svg" width="30" alt="">
                <li>Sign up</li>
            </a>
        </ul>
    </aside>

    <nav>
        <div class="nav_box center flex-row">
            <div class="menue close" style="position: absolute; right: 50px;" onclick="open_slider()">
                <img src="./source/menu.svg" width="25" alt="">
            </div>
            <div class="logo center">
                <img src="./source/logo.png" alt="">
            </div>
            <div class="bottom center">
                <ul>
                    <a href="./Home.php"><li>Home</li></a>
                    <a href="./Hotels.php"><li>Hotels</li></a>
                    <a href="./About.php"><li>About</li></a>
                    <a href="./Sign_in.php" class="center active">
                        <img src="./source/person-circle.svg" width="30" alt="">
                        <li>Log in</li>
                    </a>
                    <a href="./Sign_up.php" class="center">
                        <img src="./source/person-circle.svg" width="30" alt="">
                        <li>Sign up</li>
                    </a>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="tree_leaf_right">
            <img src="./source/Tree_leafs.jpg" alt="">
        </div>
        <div class="tree_leaf_left">
            <img src="./source/Tree_leafs.jpg" alt="">
        </div>
        <section class="center flex-col">
            <h1 class="title">HoFast</h1>
            <h2 class="subtitle">Sign in</h2>
            <p class="description">Enter your email to sign in for this app</p>

            <?php if (!empty($_SESSION['error_message'])): ?>
                <div class="error-box">
                    <?php 
                        echo $_SESSION['error_message']; 
                        unset($_SESSION['error_message']);
                    ?>
                </div>
            <?php endif; ?>

            <form action="Sign_in.php" method="POST">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="email@domain.com" required>

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="password" required>

                <button type="submit">Login Now</button>
            </form>

            <p class="terms">
                By clicking continue, you agree to our 
                <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
            </p>
        </section>
    </div>
    <script src="./index.js"></script>
</body>
</html>
