<?php
    session_start();
    $loggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HoFast - About</title>
    <link rel="shortcut icon" href="./source/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="Home.css">
</head>

<body class="About">
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
            <a href="./About.php" class="active">
                <li>About</li>
            </a>
            <?php if (!$loggedIn): ?>
                <a href="./Sign_in.php" class="center ">
                    <img src="./source/person-circle.svg" width="30" alt="">
                    <li>Log in</li>
                </a>
                <a href="./Sign_up.php" class="center">
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
                        <li class="active">About</li>
                    </a>
                    <?php if (!$loggedIn): ?>
                        <a href="./Sign_in.php" class="center ">
                            <img src="./source/person-circle.svg" width="30" alt="">
                            <li>Log in</li>
                        </a>
                        <a href="./Sign_up.php" class="center">
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
            </div>
        </div>
    </nav>
    <div class="container">
        <section class="center flex-col">
            <div class="head2 center full-width flex-col" style="position: relative; top: 0px;">
                <h2>About Page</h2>
                <p>A <b>success</b> story that began with a struggling <b>youth</b></p>
            </div>
            <div class="paragraph">
                <h2>The Story of <strong>HoFast</strong> – A Dream Turned into Reality</h2>
                <p>In 2017, four ambitious friends – <b>Amr Khaled</b>, <b>Eyad Magdy</b>, <b>Ziad Saeed</b>, and <b>Badr Mohamed</b> – sat
                    together, fueled by a shared vision: to create a place where people could escape the ordinary and
                    immerse themselves in comfort, luxury, and unforgettable experiences. Back then, it was just a
                    dream—an idea born from late-night discussions and endless brainstorming sessions. We wanted more
                    than just a hotel; we wanted to redefine hospitality, to build a place that felt like home yet
                    offered the elegance of a five-star experience.</p>

                <h2>From a Vision to Reality</h2>
                <p>With nothing but passion and determination, we started our journey. We researched, traveled, and
                    learned from the best in the industry. There were challenges—countless setbacks, financial
                    struggles, and moments of doubt—but we never gave up. We believed in our dream and worked tirelessly
                    to make it a reality.

                    After years of dedication, <strong>HoFast</strong> finally opened its doors. Every detail, from the elegant
                    architecture to the warm ambiance, reflects our journey. We built more than just a hotel—we built a
                    story, a legacy, a place where guests can create memories that last a lifetime.
                </p>

                <h2>Our Promise</h2>
                <p>Today, <strong>HoFast</strong> stands as a testament to our perseverance. We promise to deliver an experience
                    that blends luxury with warmth, tradition with innovation, and hospitality with heart. Whether
                    you’re here for a relaxing getaway, a business trip, or a special celebration, we welcome you as
                    part of our story.

                    This is our dream, and we invite you to be a part of it.</p>
            </div>
        </section>
    </div>
</body>
<script src="./index.js"></script>    

</html>