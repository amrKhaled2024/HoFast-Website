<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "HoFast";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = $address = $city = $rating = $description = $image = $phone = $email = "";
    $id = "";


    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $id = isset($_POST['id']) ? intval($_POST['id']) : '';
        $name = htmlspecialchars(trim($_POST['name']));
        $address = htmlspecialchars(trim($_POST['address']));
        $city = htmlspecialchars(trim($_POST['city']));
        $rating = floatval($_POST['rating']);
        $description = htmlspecialchars(trim($_POST['description']));
        $image = htmlspecialchars(trim($_POST['image']));
        $phone = htmlspecialchars(trim($_POST['phone']));
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

        if (!empty($name) && !empty($address) && !empty($city)) {
            if (!empty($id)) {
                // UPDATE 
                $stmt = $conn->prepare("UPDATE hotels SET name=?, address=?, city=?, rating=?, description=?, image=?, phone=?, email=? WHERE id=?");
                $stmt->bind_param("ssssssssi", $name, $address, $city, $rating, $description, $image, $phone, $email, $id);
            } else {
                // INSERT 
                $stmt = $conn->prepare("INSERT INTO hotels (name, address, city, rating, description, image, phone, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssss", $name, $address, $city, $rating, $description, $image, $phone, $email);
            }
            
            if ($stmt->execute()) {
                header("Location: Admin_hotel.php?success=1");
                exit();
            } else {
                $error = "Error saving hotel: " . $conn->error;
            }
        } else {
            $error = "Please fill in all required fields (Name, Address, City)";
        }
    }

    $sql = "SELECT * FROM hotels";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HoFast - Admin</title>
    <link rel="stylesheet" href="../Home.css">
    <link rel="shortcut icon" href="../source/logo.png" type="image/x-icon" />
    <style>
        tr:hover {
             background-color: #f1f1f1; 
            cursor: pointer; 
        }
        .error {
             color: red; 
            margin: 10px 0; 
        }
        .success { 
            color: green; margin: 10px 0; 
            position: absolute;
            top:60px;
        }
        #admin_hotel_form { 
            margin-bottom: 20px; 
        }
        #admin_hotel_form div { 
            margin-bottom: 10px; 
        }
        #admin_hotel_form label { 
            display: inline-block; 
            width: 120px; 
        }
        #admin_hotel_form textarea{
            width: 100%;
        }
        #hotels_table { 
            width: 100%; 
            border-collapse: collapse; 
        }
        #hotels_table th, #hotels_table td { 
            padding: 8px; 
            border: 1px solid #ddd; 
        }
        #hotels_table td a{
            display:flex;
            justify-content:center;
            width:100%;
            height:100%;
        }
        #hotels_table th { 
            background-color:rgb(12, 68, 0); 
            text-align: left; 
        }
        #hotels_table img { 
            max-width: 50px; 
            height: auto; 
        }
        .action-buttons { 
            margin-top: 10px; 
        }
        button { 
            padding: 8px 15px; 
            cursor: pointer; 
        }
        textarea { 
            width: 300px; 
            height: 100px; 
        }
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
                    <a href="../Admin/Admin_users.php">
                        <li>Users</li>
                    </a>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container" id="Admin_page">
        <h1>Admin Dashboard - Hotels</h1>
        <div class="content">
            <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
            <?php if (isset($_GET['success'])) echo "<div class='success'>Operation successful!</div>"; ?>

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="admin_hotel_form">
                <input type="hidden" name="id" id="hotel_id" value="">
                
                <div>
                    <label for="hotel_name">Hotel Name:</label>
                    <input type="text" name="name" id="hotel_name" required>
                </div>
                
                <div>
                    <label for="hotel_address">Address:</label>
                    <input type="text" name="address" id="hotel_address" required>
                </div>
                
                <div>
                    <label for="hotel_city">City:</label>
                    <input type="text" name="city" id="hotel_city" required>
                </div>

                <div>
                    <label for="hotel_rating">Rating:</label>
                    <input type="number" name="rating" id="hotel_rating" step="0.1" min="0" max="5">
                </div>

                <div>
                    <label for="hotel_description">Description:</label>
                    <textarea name="description" id="hotel_description"></textarea>
                </div>

                <div>
                    <label for="hotel_image">Image URL:</label>
                    <input type="text" name="image" id="hotel_image">
                </div>

                <div>
                    <label for="hotel_phone">Phone:</label>
                    <input type="text" name="phone" id="hotel_phone">
                </div>

                <div>
                    <label for="hotel_email">Email:</label>
                    <input type="email" name="email" id="hotel_email">
                </div>

                <div class="action-buttons">
                    <button type="submit" id="submit_button">Add Hotel</button>
                    <button type="button" onclick="resetForm()" style="background-color:gray;">Reset</button>
                </div>
            </form>

            <table id="hotels_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Rating</th>
                        <th>Description</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody >
                    <?php 
                    if ($result && $result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr data-id='{$row['id']}'
                                    data-name='" . htmlspecialchars($row['name']) . "'
                                    data-address='" . htmlspecialchars($row['address']) . "'
                                    data-city='" . htmlspecialchars($row['city']) . "'
                                    data-rating='" . htmlspecialchars($row['rating']) . "'
                                    data-description='" . htmlspecialchars($row['description']) . "'
                                    data-image='" . htmlspecialchars($row['image']) . "'
                                    data-phone='" . htmlspecialchars($row['phone']) . "'
                                    data-email='" . htmlspecialchars($row['email']) . "'>
                                    <td>{$row['id']}</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['address']}</td>
                                    <td>{$row['city']}</td>
                                    <td>{$row['rating']}</td>
                                    <td>{$row['description']}</td>
                                    <td>{$row['phone']}</td>
                                    <td>{$row['email']}</td>
                                    <td><a href='delete_hotel.php?id={$row['id']}'><img src='../source/trash.svg' width='20'></a></td>
                                </tr>";
                        }
                    }
                    ?>
                </tbody>

            </table>
        </div>
    </div>

    <script src="../index.js"></script>
    <script>

        document.querySelectorAll("#hotels_table tbody tr").forEach(row => {
            row.addEventListener("click", (e) => {

                if (e.target.tagName === 'A' || e.target.tagName === 'IMG') {
                    return;
                }
                
                document.getElementById("hotel_id").value = row.dataset.id;
                document.getElementById("hotel_name").value = row.dataset.name;
                document.getElementById("hotel_address").value = row.dataset.address;
                document.getElementById("hotel_city").value = row.dataset.city;
                document.getElementById("hotel_rating").value = row.dataset.rating;
                document.getElementById("hotel_description").value = row.dataset.description;
                // document.getElementById("hotel_image").value = row.dataset.image;
                document.getElementById("hotel_phone").value = row.dataset.phone;
                document.getElementById("hotel_email").value = row.dataset.email;

                document.getElementById("submit_button").innerText = "Update Hotel";
            });
        });


        function resetForm() {
            document.getElementById("hotel_id").value = "";
            document.getElementById("hotel_name").value = "";
            document.getElementById("hotel_address").value = "";
            document.getElementById("hotel_city").value = "";
            document.getElementById("hotel_rating").value = "";
            document.getElementById("hotel_description").value = "";
            // document.getElementById("hotel_image").value = "";
            document.getElementById("hotel_phone").value = "";
            document.getElementById("hotel_email").value = "";

            document.getElementById("submit_button").innerText = "Add Hotel";
        }
    </script>
</body>
</html>