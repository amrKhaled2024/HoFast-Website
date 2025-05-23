<?php
session_start();
$loggedIn = isset($_SESSION['user_id']);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "HoFast";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$hotel_id = $room_type_id = $room_number = $beds = $price_per_night = $description = "";
$room_id = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $room_id = isset($_POST['room_id']) ? intval($_POST['room_id']) : '';
    $hotel_id = intval($_POST['hotel_id']);
    $room_type_id = intval($_POST['room_type_id']);
    $room_number = htmlspecialchars(trim($_POST['room_number']));
    $beds = intval($_POST['beds']);
    $price_per_night = floatval($_POST['price_per_night']);
    $description = htmlspecialchars(trim($_POST['description']));
    $is_reserved = isset($_POST['is_reserved']) ? 1 : 0;


    if (empty($hotel_id) || empty($room_type_id) || empty($room_number) || empty($beds) || empty($price_per_night)) {
        $error = "Please fill in all required fields";
    } else {
        if (empty($room_id)) {

            $check = $conn->prepare("SELECT room_id FROM rooms WHERE hotel_id = ? AND room_number = ?");
            $check->bind_param("is", $hotel_id, $room_number);
            $check->execute();
            $check->store_result();
            
            if ($check->num_rows > 0) {
                $error = "Room number already exists for this hotel";
                $check->close();
            }
        }

        if (empty($error)) {
            if (!empty($room_id)) {

                $stmt = $conn->prepare("UPDATE rooms SET hotel_id=?, room_type_id=?, room_number=?, beds=?, price_per_night=?, description=?, is_reserved=? WHERE room_id=?");
                $stmt->bind_param("iisidsii", $hotel_id, $room_type_id, $room_number, $beds, $price_per_night, $description, $is_reserved, $room_id);
            } else {

                $stmt = $conn->prepare("INSERT INTO rooms (hotel_id, room_type_id, room_number, beds, price_per_night, description, is_reserved) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("iisidsi", $hotel_id, $room_type_id, $room_number, $beds, $price_per_night, $description, $is_reserved);
            }
            
            if ($stmt->execute()) {
                header("Location: Admin_rooms.php?success=1");
                exit();
            } else {
                $error = "Error saving room: " . $conn->error;
            }
        }
    }
}


$sql = "SELECT r.*, h.name as hotel_name, rt.type_name as room_type 
        FROM rooms r
        JOIN hotels h ON r.hotel_id = h.id
        JOIN room_types rt ON r.room_type_id = rt.type_id
        ORDER BY r.room_id DESC";
$result = $conn->query($sql);


$hotels = $conn->query("SELECT * FROM hotels ORDER BY name");


$roomTypes = $conn->query("SELECT * FROM room_types ORDER BY type_name");

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HoFast - Admin Rooms</title>
    <link rel="stylesheet" href="../Home.css">
    <link rel="shortcut icon" href="../source/logo.png" type="image/x-icon" />
    <style>
        tr:hover { background-color: #f1f1f1; cursor: pointer; }
        .error { color: red; margin: 10px 0; position: absolute; top:60px; }
        .success { color: green; margin: 10px 0; position: absolute; top:60px; }
        #admin_room_form { margin-bottom: 20px; }
        #admin_room_form div { margin-bottom: 10px; }
        #admin_room_form label { display: inline-block; width: 120px; }
        #admin_room_form textarea{ width: 100%; }
        #rooms_table { width: 100%; border-collapse: collapse; }
        #rooms_table th, #rooms_table td { padding: 8px; border: 1px solid #ddd; }
        #rooms_table td a{ display:flex; justify-content:center; width:100%; height:100%; }
        #rooms_table th { background-color:rgb(12, 68, 0); text-align: left; }
        #rooms_table img { max-width: 50px; height: auto; }
        .action-buttons { margin-top: 10px; }
        button { padding: 8px 15px; cursor: pointer; }
        textarea { width: 300px; height: 100px; }
        .status-available { color: green; }
        .status-reserved { color: red; }
    </style>
</head>
<body class="signin">
    <aside id="slider_bar">
        <div class="close" onclick="close_slider()">
            <img src="../source/close.svg" width="25" alt="close" />
        </div>
        <ul>
            <a href="../Admin/Admin_hotel.php">
                <li>Hotels</li>
            </a>
            <a href="../Admin/Admin_rooms.php">
                <li>Rooms</li>
            </a>
            <a href="../Admin/Admin_users.php">
                <li>Users</li>
            </a>
        </ul>
    </aside>
    <nav>
        <div class="nav_box center flex-row">
            <div class="menue close" style="position: absolute; right: 50px;" onclick="open_slider()">
                <img src="../source/menu.svg" width="25" alt="" />
            </div>
            <div class="logo center">
                <img src="../source/logo.png" alt="" />
            </div>
            <div class="bottom center">
                <ul>
                    <a href="../Admin/Admin_hotel.php">
                        <li>Hotels</li>
                    </a>
                    <a href="../Admin/Admin_rooms.php">
                        <li>Rooms</li>
                    </a>
                    <a href="../Admin/Admin_users.php">
                        <li>Users</li>
                    </a>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container" id="Admin_page">
        <h1>Admin Dashboard - Rooms</h1>
        <div class="content">
            <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
            <?php if (isset($_GET['success'])) echo "<div class='success'>Operation successful!</div>"; ?>

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="admin_room_form">
                <input type="hidden" name="room_id" id="room_id" value="">
                
                <div>
                    <label for="hotel_id">Hotel:</label>
                    <select name="hotel_id" id="hotel_id" required>
                        <option value="">Select Hotel</option>
                        <?php while($hotel = $hotels->fetch_assoc()): ?>
                            <option value="<?= $hotel['id'] ?>"><?= htmlspecialchars($hotel['name']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                
                <div>
                    <label for="room_type_id">Room Type:</label>
                    <select name="room_type_id" id="room_type_id" required>
                        <option value="">Select Room Type</option>
                        <?php while($type = $roomTypes->fetch_assoc()): ?>
                            <option value="<?= $type['type_id'] ?>"><?= htmlspecialchars($type['type_name']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                
                <div>
                    <label for="room_number">Room Number:</label>
                    <input type="text" name="room_number" id="room_number" required>
                </div>

                <div>
                    <label for="beds">Number of Beds:</label>
                    <input type="number" name="beds" id="beds" min="1" max="10" required>
                </div>

                <div>
                    <label for="price_per_night">Price Per Night ($):</label>
                    <input type="number" name="price_per_night" id="price_per_night" min="0" step="0.01" required>
                </div>

                <div>
                    <label for="description">Description:</label>
                    <textarea name="description" id="description"></textarea>
                </div>

                <div>
                    <label>
                        <input type="checkbox" name="is_reserved" id="is_reserved"> Reserved
                    </label>
                </div>

                <div class="action-buttons">
                    <button type="submit" id="submit_button">Add Room</button>
                    <button type="button" onclick="resetForm()" style="background-color:gray;">Reset</button>
                </div>
            </form>

            <table id="rooms_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Hotel</th>
                        <th>Room Type</th>
                        <th>Room Number</th>
                        <th>Beds</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if ($result && $result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr data-room_id='{$row['room_id']}'
                                    data-hotel_id='{$row['hotel_id']}'
                                    data-room_type_id='{$row['room_type_id']}'
                                    data-room_number='" . htmlspecialchars($row['room_number']) . "'
                                    data-beds='{$row['beds']}'
                                    data-price_per_night='{$row['price_per_night']}'
                                    data-description='" . htmlspecialchars($row['description']) . "'
                                    data-is_reserved='{$row['is_reserved']}'>
                                    <td>{$row['room_id']}</td>
                                    <td>" . htmlspecialchars($row['hotel_name']) . "</td>
                                    <td>" . htmlspecialchars($row['room_type']) . "</td>
                                    <td>" . htmlspecialchars($row['room_number']) . "</td>
                                    <td>{$row['beds']}</td>
                                    <td>$" . number_format($row['price_per_night'], 2) . "</td>
                                    <td class='" . ($row['is_reserved'] ? 'status-reserved' : 'status-available') . "'>" . 
                                        ($row['is_reserved'] ? 'Reserved' : 'Available') . "</td>
                                    <td><a href='delete_room.php?id={$row['room_id']}' onclick='return confirm(\"Are you sure you want to delete this room?\")'>
                                        <img src='../source/trash.svg' width='20' alt='Delete'></a>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>No rooms found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="../index.js"></script>
    <script>
        // Function to populate form when clicking a table row
        document.querySelectorAll("#rooms_table tbody tr").forEach(row => {
            row.addEventListener("click", (e) => {
                // Don't trigger if clicking on delete button
                if (e.target.tagName === 'A' || e.target.tagName === 'IMG') {
                    return;
                }
                
                document.getElementById("room_id").value = row.dataset.room_id;
                document.getElementById("hotel_id").value = row.dataset.hotel_id;
                document.getElementById("room_type_id").value = row.dataset.room_type_id;
                document.getElementById("room_number").value = row.dataset.room_number;
                document.getElementById("beds").value = row.dataset.beds;
                document.getElementById("price_per_night").value = row.dataset.price_per_night;
                document.getElementById("description").value = row.dataset.description;
                document.getElementById("is_reserved").checked = row.dataset.is_reserved === '1';

                document.getElementById("submit_button").innerText = "Update Room";
            });
        });

        // Function to reset the form
        function resetForm() {
            document.getElementById("room_id").value = "";
            document.getElementById("hotel_id").value = "";
            document.getElementById("room_type_id").value = "";
            document.getElementById("room_number").value = "";
            document.getElementById("beds").value = "";
            document.getElementById("price_per_night").value = "";
            document.getElementById("description").value = "";
            document.getElementById("is_reserved").checked = false;

            document.getElementById("submit_button").innerText = "Add Room";
        }
    </script>
</body>
</html>