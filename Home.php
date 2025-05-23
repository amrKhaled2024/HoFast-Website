<?php
    session_start();
    $loggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HoFast - Home</title>
    <link rel="shortcut icon" href="./source/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./Home.css">
</head>

<body id="all">
    <aside id="slider_bar">
        <div class="close" onclick="close_slider()">
            <img src="./source/close.svg" width="25" alt="close">
        </div>
 
        <ul>
            <a href="./Home.php" class="active">
                <li>Home</li>
            </a>
            <a href="./Hotels.php">
                <li>Hotels</li>
            </a>
            <a href="./About.php">
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
    <nav id="nav">
        <?php if ($loggedIn): ?>
            <div class="welcoming" id="welcoming">
                <p>Welcome Back <span style="color:green;"><?php echo htmlspecialchars($_SESSION['first_name']); ?></span> , Enjoy the offers % ❤️</p>
                <div class="close" onclick="close_welcoming()" style="position:absolute; right:10px; border:none;">
                    <img src="./source/close.svg" width="20" alt="close" >
                </div>
            </div>
        <?php endif; ?>
        <div class="nav_box center flex-row">
            <div class="menue close" style="position: absolute; right: 50px;" onclick="open_slider()">
                <img src="./source/menu.svg" width="25" alt="">
            </div>
            <div class="logo center">
                <img src="./source/logo.png">
            </div>
            <div class="bottom center">
                <ul>
                    <a href="./Home.php">
                        <li class="active">Home</li>
                    </a>
                    <a href="./Hotels.php">
                        <li>Hotels</li>
                    </a>
                    <a href="./About.php">
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
            </div>
        </div>
    </nav>
    <div class="container">
        <section class="center page1">
            <div class="tree_leaf_right">
                <img src="./source/Tree_leafs.jpg" alt="">
            </div>
            <div class="tree_leaf_left">
                <img src="./source/Tree_leafs.jpg" alt="">
            </div>
            <div class="txt center">
                <div class="header_txt flex-col">
                    <h1>
                        <ul>
                            <li>Discover</li>
                            <li>Book</li>
                            <li>Relax</li>
                        </ul>
                    </h1>
                    <p class="quote">Be Steady to change your life, Just </p>
                    <p class="button_click center">Book now</p>
                </div>
            </div>
            <div class="search-container center flex-col">
                <h3>Find Your Perfect Stay</h3>
                <form class="search-form">
                    <input type="text" placeholder="Enter Destination" required>
                    <input type="date" required>
                    <input type="date" required>
                    <button type="submit">Search</button>
                </form>
            </div>
            <div class="scroll_down full-width center">
                <img src="./source/scroll_down.png" width="30px" alt="">
            </div>
        </section>
        <section class="center page2 flex-col">
            <div class="head2 center full-width flex-col">
                <h2>Where Will You Stay Next?</h2>
                <p> Find the Best Hotels for Every Journey!</p>
            </div>
            <p class="button_click center">START JOURNEY</p>
            <div class="photos full-width center">
                <img src="./source/hotelsview.jpeg" alt="">
                <img src="./source/room1.webp" alt="">
                <img src="./source/pyramids.jpg" alt="">
            </div>
        </section>
        <section class="center page3 flex-col">
            <div class="head2 center full-width flex-col">
                <h2 style="margin-top: 20px;">You will find us <strong style="color: #2F4F2F;">Everywhere</strong></h2>
                <p>Always with you to make you feel safe</p>
            </div>
            <div class="places full-width center">
                <div class="global center">
                    <div class="country center">
                        <p>Dubai</p>
                        <p>UAE</p>
                    </div>
                    <div class="country center">
                        <p>Paris</p>
                        <p>France</p>
                    </div>
                    <div class="country center">
                        <p>New York City</p>
                        <p>USA</p>
                    </div>
                    <div class="country center">
                        <p>London</p>
                        <p>UK</p>
                    </div>
                    <div class="country center">
                        <p>Tokyo</p>
                        <p>Japan</p>
                    </div>
                    <div class="country center">
                        <p>Rome</p>
                        <p>Italy</p>
                    </div>
                    <div class="country center">
                        <p>Bangkok</p>
                        <p>Thailand</p>
                    </div>
                    <div class="country center">
                        <p>Istanbul</p>
                        <p>Turkey</p>
                    </div>
                    <div class="country center">
                        <p>Barcelona</p>
                        <p>Spain</p>
                    </div>
                    <div class="country center">
                        <p>Cairo</p>
                        <p>Egypt</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="comment_sec">
            <div class="comments" >
                <div class="head2 center full-width flex-col">
                    <h2 style="margin-top: 20px; margin-bottom: 40px; margin-top: 40px;">Our Customers Comments</h2>
                </div>
                <h2></h2>
                <ul id="comment_all">
                    <li class="center">
                        <div class="profile_com_info">
                            <div class="profile_com d-flex flex-row">
                                <div class="account">
                                    <img src="./source/person-circle.svg" width="40">
                                    <p class="prof_name">Hala_Ashraf2024</p>
                                </div>
                                <div class="stars">
                                    <img src="./source/star-sharp.png" class="star_true">
                                    <img src="./source/star-sharp.png" class="star_true">
                                    <img src="./source/star-sharp.png" class="star_true">
                                    <img src="./source/star-outline.svg">
                                    <img src="./source/star-outline.svg">

                                </div>
                            </div>
                            <div class="comment_text">
                                <p>The website is amazing</p>
                            </div>
                        </div>
                    </li>
                    <li class="center">
                        <div class="profile_com_info">
                            <div class="profile_com d-flex flex-row">
                                <div class="account">
                                    <img src="./source/person-circle.svg" width="40">
                                    <p class="prof_name">Mona_ahmed99</p>
                                </div>
                                <div class="stars">
                                    <img src="./source/star-sharp.png" class="star_true">
                                    <img src="./source/star-sharp.png" class="star_true">
                                    <img src="./source/star-sharp.png" class="star_true">
                                    <img src="./source/star-sharp.png" class="star_true">
                                    <img src="./source/star-outline.svg">
                                </div>
                            </div>
                            <div class="comment_text">
                                <p>من احلى المواقع اللي شوفتها اخر فترة ❤️</p>
                            </div>
                        </div>
                    </li>
                    <li class="center">
                        <div class="profile_com_info">
                            <div class="profile_com d-flex flex-row">
                                <div class="account">
                                    <img src="./source/person-circle.svg" width="40">
                                    <p class="prof_name">Mahmoud_Hassan182</p>
                                </div>
                                <div class="stars">
                                    <img src="./source/star-sharp.png" class="star_true">
                                    <img src="./source/star-sharp.png" class="star_true">
                                    <img src="./source/star-sharp.png" class="star_true">
                                    <img src="./source/star-sharp.png" class="star_true">
                                    <img src="./source/star-sharp.png" class="star_true">
                                </div>
                            </div>
                            <div class="comment_text">
                                <p>The best booking website ever!!</p>
                            </div>
                        </div>
                    </li>
                </ul>
                <li class="center" style="border: none;">
                    <div class="AddComment">
                        <input type="text" id="AddCommentText">
                        <div class="send">
                            <img src="./source/Send.png" width="" onclick="SendComment()">
                        </div>
                    </div>
                </li>
            </div>
        </section>
    </div>
    <script>
        function SendComment(){
            comment_all.innerHTML += `<li class="center">
                                <div class="profile_com_info">
                                    <div class="profile_com d-flex flex-row">
                                        <div class="account">
                                            <img src="./source/person-circle.svg" width="40">
                                            <p class="prof_name"><?= htmlspecialchars($_SESSION['first_name']) . htmlspecialchars($_SESSION['last_name']) ?></p>
                                        </div>
                                        <div class="stars">
                                            <img src="./source/star-sharp.png" class="star_true">
                                            <img src="./source/star-sharp.png" class="star_true">
                                            <img src="./source/star-sharp.png" class="star_true">
                                            <img src="./source/star-sharp.png" class="star_true">
                                            <img src="./source/star-sharp.png" class="star_true">
                                        </div>
                                    </div>
                                    <div class="comment_text">
                                        <p>${comment_txt.value}</p>
                                    </div>
                                </div>
                            </li>`;
                            comment_txt.value = "";
        }
    </script>
    <script src="./index.js"></script>
</body>
</html>