<?php
    session_start();
    $loggedIn = isset($_SESSION['user_id']);

    $host = 'localhost';
    $dbname = 'HoFast'; 
    $user = 'root';
    $pass = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }


    $hotel_id = $_GET['hotel_id'] ?? '';


    $room_type_id = $_GET['room_type_id'] ?? '';
    $is_reserved = $_GET['is_reserved'] ?? '';
    $city = $_GET['city'] ?? '';
    $rating = $_GET['rating'] ?? '';
    $min_price = $_GET['min_price'] ?? '';
    $max_price = $_GET['max_price'] ?? '';
    $beds = $_GET['beds'] ?? '';


    $query = "SELECT r.room_id, r.hotel_id, r.room_type_id, r.is_reserved, r.room_number, 
                    r.beds, r.price_per_night, r.description as room_description,
                    h.name as hotel_name, h.city, h.rating, h.description as hotel_description
            FROM rooms r
            JOIN hotels h ON r.hotel_id = h.id
            WHERE 1";

    $params = [];


    if ($hotel_id) {
        $query .= " AND r.hotel_id = :hotel_id";
        $params[':hotel_id'] = $hotel_id;
    }

    if ($room_type_id) {
        $query .= " AND r.room_type_id = :room_type_id";
        $params[':room_type_id'] = $room_type_id;
    }

    if ($is_reserved !== '') {
        $query .= " AND r.is_reserved = :is_reserved";
        $params[':is_reserved'] = $is_reserved;
    }

    if ($city) {
        $query .= " AND h.city = :city";
        $params[':city'] = $city;
    }

    if ($rating) {
        $query .= " AND h.rating >= :rating";
        $params[':rating'] = $rating;
    }

    if ($min_price !== '') {
        $query .= " AND r.price_per_night >= :min_price";
        $params[':min_price'] = $min_price;
    }

    if ($max_price !== '') {
        $query .= " AND r.price_per_night <= :max_price";
        $params[':max_price'] = $max_price;
    }

    if ($beds !== '') {
        $query .= " AND r.beds = :beds";
        $params[':beds'] = $beds;
    }


    $roomTypes = [];
    try {
        $roomTypesStmt = $pdo->prepare("SELECT * FROM room_types");
        $roomTypesStmt->execute();
        $roomTypes = $roomTypesStmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {

    }


    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);


    $hotelDetails = null;
    if ($hotel_id) {
        $hotelStmt = $pdo->prepare("SELECT * FROM hotels WHERE id = ?");
        $hotelStmt->execute([$hotel_id]);
        $hotelDetails = $hotelStmt->fetch(PDO::FETCH_ASSOC);
    }

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
    <title>HoFast - Rooms</title>
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
            <?php if ($hotelDetails): ?>
                <h2><?= htmlspecialchars($hotelDetails['name']) ?></h2>
                <p><?= htmlspecialchars($hotelDetails['city']) ?> • <?= htmlspecialchars($hotelDetails['rating']) ?> ⭐</p>
            <?php else: ?>
                <h2>Available Rooms</h2>
                <p>Browse our selection of rooms</p>
            <?php endif; ?>
        </div>

        <div class="all_hotels">
            <div class="left">
                <form action="Rooms.php" method="GET" class="filter-box">
                    <h3>Filter Rooms</h3>

                    <?php if (!$hotel_id): ?>
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

                        <label for="rating">Minimum Rating</label>
                        <select name="rating" id="rating">
                            <option value="">Any</option>
                            <?php for ($i = 5; $i >= 1; $i--): ?>
                                <option value="<?= $i ?>" <?= $rating == $i ? 'selected' : '' ?>>
                                    <?= str_repeat("⭐", $i) ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    <?php endif; ?>

                    <label for="beds">Number of Beds</label>
                    <select name="beds" id="beds">
                        <option value="">Any</option>
                        <option value="1" <?= $beds == '1' ? 'selected' : '' ?>>Single (1 bed)</option>
                        <option value="2" <?= $beds == '2' ? 'selected' : '' ?>>Double (2 beds)</option>
                        <option value="3" <?= $beds == '3' ? 'selected' : '' ?>>Triple (3 beds)</option>
                        <option value="4" <?= $beds == '4' ? 'selected' : '' ?>>Quad (4 beds)</option>
                    </select>

                    <label for="min_price">Minimum Price ($)</label>
                    <input type="number" name="min_price" id="min_price" min="0" value="<?= htmlspecialchars($min_price) ?>">

                    <label for="max_price">Maximum Price ($)</label>
                    <input type="number" name="max_price" id="max_price" min="0" value="<?= htmlspecialchars($max_price) ?>">

                    <label for="is_reserved">Availability</label>
                    <select name="is_reserved" id="is_reserved">
                        <option value="">All</option>
                        <option value="0" <?= $is_reserved === '0' ? 'selected' : '' ?>>Available</option>
                        <option value="1" <?= $is_reserved === '1' ? 'selected' : '' ?>>Reserved</option>
                    </select>

                    <?php if ($hotel_id): ?>
                        <input type="hidden" name="hotel_id" value="<?= htmlspecialchars($hotel_id) ?>">
                    <?php endif; ?>

                    <button type="submit">Apply Filters</button>
                    <button type="button" onclick="window.location.href='Rooms.php'">Reset Filters</button>
                </form>
            </div>

            <div class="right">
                <?php if (count($rooms) === 0): ?>
                    <p style="padding: 20px; font-weight: bold;">No rooms found matching your filters.</p>
                <?php else: ?>
                    <?php foreach ($rooms as $room): ?>
                        <div class="room" onclick="window.location.href='RoomDetails.php?room_id=<?= $room['room_id'] ?>'">
                            <div class="room-thumbnail">
                                <?php
                                $imagePaths = [
                                    1 => 'Single-room.jpg',
                                    2 => 'Double-room.jpg',
                                    3 => 'Triple-room.jpg',
                                    4 => 'Quad-room.jpg'
                                ];
                                
                                $defaultImage = './source/rooms/Single-room.jpg';
                                
                                $imageFile = isset($imagePaths[$room['room_type_id']]) ? 
                                            $imagePaths[$room['room_type_id']] : 
                                            $defaultImage;
                                
                                $imagePath = './source/rooms/' . $imageFile;
                                
                                if (!file_exists($imagePath)) {
                                    $imagePath = './source/rooms/' . $defaultImage;
                                }
                                ?>
                                <img src="<?= $imagePath ?>" 
                                    alt="Room <?= htmlspecialchars($room['room_number']) ?>"
                                    onerror="this.src='./source/rooms/default-room.jpg'">
                            </div>
                            <div class="room-info">
                                <div class="room-type">
                                    <?= $room['beds'] == 1 ? 'Single Room' : 
                                       ($room['beds'] == 2 ? 'Double Room' : 
                                       ($room['beds'] == 3 ? 'Triple Room' : 'Quad Room')) ?>
                                </div>
                                <span class="room-status <?= $room['is_reserved'] ? 'reserved' : 'available' ?>">
                                    <?= $room['is_reserved'] ? 'Reserved' : 'Available' ?>
                                </span>
                                <div class="room-price">$<?= number_format($room['price_per_night'], 2) ?> per night</div>
                                <p class="room-number">Room #<?= htmlspecialchars($room['room_number']) ?> • 
                                    <span class="room-beds"><?= $room['beds'] ?> bed(s)</span>
                                </p>
                                <p><?= htmlspecialchars($room['room_description']) ?></p>
                                <?php if (!$hotel_id): ?>
                                    <p>Hotel: <a href="rooms.php?hotel_id=<?= $room['hotel_id'] ?>" class="hotel-link">
                                        <?= htmlspecialchars($room['hotel_name']) ?> (<?= htmlspecialchars($room['city']) ?> • <?= $room['rating'] ?> ⭐)
                                    </a></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="./index.js"></script>
       <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
         $(document).ready(function() {

            $('.room').each(function(index) {
                $(this).css('opacity', 0);
                $(this).delay(100 * index).animate({
                    opacity: 1,
                    marginTop: '0px'
                }, 400);
            });
            

            $('.room').hover(
                function() {

                    $(this).stop().animate({
                        'marginTop': '-10px'
                    }, 200);
                },
                function() {

                    $(this).stop().animate({
                        'marginTop': '0px'
                    }, 200);
                }
            );
            

            $('.filter-box input, .filter-box select').focus(function() {
                $(this).parent().animate({
                    'marginLeft': '10px'
                }, 150);
            }).blur(function() {
                $(this).parent().animate({
                    'marginLeft': '0px'
                }, 150);
            });
            

            setInterval(function() {
                $('.available').fadeTo(200, 0.8).fadeTo(200, 1);
            }, 2000);
            

            $('.room').on('click', function(e) {

                if ($(e.target).is('a') || $(e.target).parents('a').length) {
                    return;
                }
                window.location.href = 'RoomDetails.php?room_id=' + $(this).find('.room-info').data('room-id');
            });
            
            $('.filter-box').on('submit', function(e) {
                e.preventDefault();
                
                $('.room').addClass('hidden');
                
                setTimeout(() => {
                    this.submit();
                }, 500);
            });
            
            $('.filter-box button[type="button"]').on('click', function() {
                $('.room').addClass('hidden');
                setTimeout(() => {
                    window.location.href = 'Rooms.php';
                }, 500);
            });
        });
    </script>
</body>
</html>