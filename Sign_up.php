<?php
    session_start();
    $error_message = ""; 
    $servername = "localhost";   
    $username = "root";          
    $password = "";              
    $dbname = "HoFast"; 

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            $error_message = "Connection failed: " . $conn->connect_error;
        } else {
            $first_name = trim($_POST['first_name']);
            $last_name = trim($_POST['last_name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $confirm_password = trim($_POST['confirm_password']);

            if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
                $error_message = "Please complete all fields.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error_message = "Please enter a valid email address.";
            } elseif ($password !== $confirm_password) {
                $error_message = "Passwords do not match.";
            }  else {
                 $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $first_name, $last_name, $email, $hashed_password);

                if ($stmt->execute()) {
                    header("Location: Sign_in.php");
                    exit();
                } else {
                    $error_message = "Error: " . $stmt->error;
                }

                $stmt->close();
            }
            $conn->close();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HoFast - Sign up</title>
    <link rel="shortcut icon" href="./source/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="Home.css">
</head>
<body class="signin">

    <?php
        if (!empty($_SESSION['error_message'])): ?>
        <div class="error-box">
            <?php 
                echo $_SESSION['error_message'];
                unset($_SESSION['error_message']); 
            ?>
        </div>
    <?php endif; ?>


    <aside id="slider_bar">
        <div class="close" onclick="close_slider()">
            <img src="./source/close.svg" width="25" alt="close">
        </div>

        <ul>
            <a href="./Home.php">
                <li >Home</li>
            </a>
            <a href="./Hotels.php">
                <li>Hotels</li>
            </a>
            <a href="./About.php">
                <li>About</li>
            </a>
            <a href="./Sign_in.php" class="flex-row ">
                <img src="./source/person-circle.svg" width="30" alt="">
                <li>Log in</li>
            </a>
            <a href="./Sign_up.php" class="flex-row active">
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
                    <a href="./Home.php">
                        <li>Home</li>
                    </a>
                    <a href="./Hotels.php">
                        <li>Hotels</li>
                    </a>
                    <a href="./About.php">
                        <li>About</li>
                    </a>
                    <a href="./Sign_in.php" class="center ">
                        <img src="./source/person-circle.svg" width="30" alt="">
                        <li>Log in</li>
                    </a>
                    <a href="./Sign_up.php" class="center active">
                        <img src="./source/person-circle.svg" width="30" alt="">
                        <li>Sign up</li>
                    </a>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container_signup">
        <div class="tree_leaf_right">
            <img src="./source/Tree_leafs.jpg" alt="">
        </div>
        <div class="tree_leaf_left">
            <img src="./source/Tree_leafs.jpg" alt="">
        </div>
        <section class="center flex-col">
            <h1 class="title">HoFast</h1>
            <h2 class="subtitle">Sign Up</h2>
            <p class="description">Enter your email to sign Up for this app</p>
            
            <form id="SignUpForm" action="Sign_up.php" method="POST">
                <label for="FName">First Name</label>
                <input type="text" name="first_name" id="FName" placeholder="Enter Name" required>

                <label for="Lname">Last Name</label>
                <input type="text" name="last_name"  id="Lname" placeholder="Enter Name" required>

                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter Email">

                <label for="FName">Birth Date</label>
                <input type="date" id="bdate" required>

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Enter Password" id="password" required>

                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password"  placeholder="Confirm Password"  required>


                <button type="submit">Sign Up</button>
            </form>

            <p class="terms">
                By clicking continue, you agree to our 
                <a href="#">Terms of Service</a> and 
                <a href="#">Privacy Policy</a>
            </p>
        </section>
        
    </div>
    <script src="./index.js"></script>    
    
</body>
</html>