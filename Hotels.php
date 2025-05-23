<?php
    session_start();
    $loggedIn = isset($_SESSION['user_id']);

    $host = 'localhost';
    $dbname = 'HoFast'; 
    $user = 'root';
    $pass = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }


    $city = $_GET['city'] ?? '';
    $rating = $_GET['rating'] ?? '';

    $query = "SELECT * FROM hotels WHERE 1";
    $params = [];

    if ($city) {
        $query .= " AND city = :city";
        $params[':city'] = $city;
    }

    if ($rating) {
        $query .= " AND rating = :rating";
        $params[':rating'] = $rating;
    }



    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $hotels = $stmt->fetchAll(PDO::FETCH_ASSOC);


    $popularCities = [
        'Paris', 'London', 'New York', 'Tokyo', 'Dubai',
        'Barcelona', 'Rome', 'Sydney', 'Los Angeles', 'Berlin',
        'Amsterdam', 'Hong Kong', 'Singapore', 'Bangkok', 'Istanbul',
        'Mumbai', 'Rio de Janeiro', 'Cairo', 'Toronto', 'Chicago',
        'Madrid', 'Vienna', 'Prague', 'Moscow', 'Seoul',
        'Beijing', 'Shanghai', 'Miami', 'San Francisco', 'Las Vegas',
        'Venice', 'Florence', 'Athens', 'Lisbon', 'Dublin',
        'Edinburgh', 'Cape Town', 'Marrakech', 'Buenos Aires', 'Mexico City'
    ];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HoFast - Hotels</title>
    <link rel="shortcut icon" href="./source/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./Home.css">
</head>
<body class="Hotels">
    <aside id="slider_bar">
        <div class="close" onclick="close_slider()">
            <img src="./source/close.svg" width="25" alt="close">
        </div>
        <ul>
            <a href="./Home.php"><li>Home</li></a>
            <a href="./Hotels.php" class="active"><li>Hotels</li></a>
            <a href="./About.php"><li>About</li></a>
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
            <div class="logo center"><img src="./source/logo.png" alt=""></div>
            <div class="bottom center">
                <ul>
                    <a href="./Home.php"><li>Home</li></a>
                    <a href="./Hotels.php"><li class="active">Hotels</li></a>
                    <a href="./About.php"><li>About</li></a>
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
        <div class="head2 center full-width flex-col">
            <h2>Where Will You Stay Next?</h2>
            <p>Find the Best Hotels for Every Journey!</p>
        </div>

        <div class="all_hotels">
            <div class="left">
                <form action="Hotels.php" method="GET" class="filter-box">
                    <h3>Filter Hotels</h3>

                    <label for="city">City</label>
                    <select name="city" id="city">
                        <option value="">All Cities</option>
                        <?php foreach ($popularCities as $popularCity): ?>
                            <option value="<?= htmlspecialchars($popularCity) ?>" 
                                <?= $city == $popularCity ? 'selected' : '' ?>>
                                <?= htmlspecialchars($popularCity) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label for="rating">Star Rating</label>
                    <select name="rating" id="rating">
                        <option value="">All</option>
                        <?php for ($i = 5; $i >= 1; $i--): ?>
                            <option value="<?= $i ?>" <?= $rating == $i ? 'selected' : '' ?>>
                                <?= str_repeat("⭐", $i) ?>
                            </option>
                        <?php endfor; ?>
                    </select>


                    <button type="submit">Apply Filters</button>
                </form>
            </div>

            <div class="right">
                <?php if (count($hotels) === 0): ?>
                    <p style="padding: 20px; font-weight: bold;">No hotels found matching your filters.</p>
                <?php else: ?>
                    <?php foreach ($hotels as $hotel): ?>
                        <div class="hotel" onclick="window.location.href='Rooms.php?hotel_id=<?= $hotel['id'] ?>'">
                            <div class="thumbnail">
                                <img src="./source/Hotels_imgs/hotel_<?= htmlspecialchars($hotel['id']) ?>.jpg" alt="<?= htmlspecialchars($hotel['name']) ?>">
                            </div>
                            <div class="hotel-info">
                                <h3 class="hotel-name"><?= htmlspecialchars($hotel['name']) ?></h3>
                                <p class="hotel-description"><?= htmlspecialchars($hotel['description']) ?></p>
                                <div class="down">
                                    <p class="hotel-location"><?= htmlspecialchars($hotel['city']) ?></p>
                                    <div class="hotel-rating"><?= htmlspecialchars($hotel['rating']) ?> ⭐</div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="./index.js"></script>
</body>
</html>
