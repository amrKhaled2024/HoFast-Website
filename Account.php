<?php
    session_start();
    $loggedIn = isset($_SESSION['user_id']);
    $userId = $_SESSION['user_id'];
    $firstName = $_SESSION['first_name'];
    $lastName = $_SESSION['last_name'];
    $email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HoFast - Account</title>
    <link rel="shortcut icon" href="./source/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./Home.css">
</head>
<body class="User">
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
            <?php if (!$loggedIn): ?>
                <a href="./Sign in.html" class="center ">
                    <img src="./source/person-circle.svg" width="30" alt="">
                    <li>Log in</li>
                </a>
                <a href="./Sign up.html" class="center active">
                    <img src="./source/person-circle.svg" width="30" alt="">
                    <li>Sign up</li>
                </a>
            <?php endif; ?>
            <?php if ($loggedIn): ?>
                <a href="./Account.php" class="userAccount">
                    <div class="progilePic">
                        <?php
                            $userId = $_SESSION['user_id'];
                        ?>
                        <img src="./source/users_imgs/userId_<?php echo htmlspecialchars($userId);?>.jpg" width="50">
                    </div>
                </a>
            <?php endif; ?>
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
                    <?php if (!$loggedIn): ?>
                        <a href="./Sign in.html" class="center">
                            <img src="./source/person-circle.svg" width="30" alt="">
                            <li>Log in</li>
                        </a>
                        <a href="./Sign up.html" class="center">
                            <img src="./source/person-circle.svg" width="30" alt="">
                            <li>Sign up</li>
                        </a>
                    <?php endif; ?>
                    <?php if ($loggedIn): ?>
                        <a href="./Account.php" class="userAccount">
                            <div class="progilePic">
                                <?php
                                    $userId = $_SESSION['user_id'];
                                ?>
                                <img src="./source/users_imgs/userId_<?php echo htmlspecialchars($userId);?>.jpg" width="50">
                                <div class="profile_slider">
                                    <span>Profile</span>
                                    <span>Saved</span>
                                    <span>Logout</span>
                                </div>
                            </div>
                        </a>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="all">
            <h1>Account Information</h1>
            <div class="info">
                <div class="profile_img">
                    <div class="circle"></div>
                    <div class="imageBox" id="imageBoxUser">
                        <div class="gray">
                            <div class="box"></div>
                        </div>
                        <input type="file" id="fileInput" accept="image/*" style="display:none" />
                        <img src="./source/users_imgs/userId_<?php echo htmlspecialchars($userId);?>.jpg">
                    </div>
                </div>
                <div class="info_form">
                    <input type="file" id="fileInput" accept="image/*" style="display:none"/>
                    <form id="SignUpForm" action="update_profile.php" method="POST">
                        <label for="FName">First Name</label>
                        <input type="text" name="first_name" id="FName" 
                            value="<?php echo htmlspecialchars($_SESSION['first_name']); ?>" required>

                        <label for="Lname">Last Name</label>
                        <input type="text" name="last_name" id="Lname" 
                            value="<?php echo htmlspecialchars($_SESSION['last_name']); ?>" required>

                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" 
                            value="<?php echo htmlspecialchars($email); ?>">

                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Enter New Password" disabled
                            value="**********">

                        <button type="submit">Update Profile</button>
                    </form>

                </div>

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./index.js"></script>    
</body>
</html>