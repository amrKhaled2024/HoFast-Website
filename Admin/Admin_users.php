<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "HoFast";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $first_name = $last_name = $email = $password = "";
    $id = "";
    $error = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $id = isset($_POST['id']) ? intval($_POST['id']) : '';
        $first_name = htmlspecialchars(trim($_POST['first_name']));
        $last_name = htmlspecialchars(trim($_POST['last_name']));
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $password = trim($_POST['password']);


        if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
            $error = "Please fill in all required fields";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format";
        } else {
            if (empty($id)) {
                $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
                $check->bind_param("s", $email);
                $check->execute();
                $check->store_result();
                
                if ($check->num_rows > 0) {
                    $error = "Email already exists";
                    $check->close();
                }
            }

            if (empty($error)) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                
                if (!empty($id)) {
                    // UPDATE 
                    $stmt = $conn->prepare("UPDATE users SET first_name=?, last_name=?, email=?, password=? WHERE id=?");
                    $stmt->bind_param("ssssi", $first_name, $last_name, $email, $hashed_password, $id);
                } else {
                    // INSERT 
                    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password, role) VALUES (?, ?, ?, ?, 'user')");
                    $stmt->bind_param("ssss", $first_name, $last_name, $email, $hashed_password);
                }
                
                if ($stmt->execute()) {
                    header("Location: Admin_users.php?success=1");
                    exit();
                } else {
                    $error = "Error saving user: " . $conn->error;
                }
            }
        }
    }

    $sql = "SELECT * FROM users WHERE role != 'admin' ORDER BY id DESC";
    $result = $conn->query($sql);
    $conn->close();
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
            position: absolute; 
            top:60px; 
        }
        .success { 
            color: green; 
            margin: 10px 0; 
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
            display: inline-block; width: 120px; 
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
        <h1>Admin Dashboard - Users</h1>
        <div class="content">
            <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
            <?php if (isset($_GET['success'])) echo "<div class='success'>Operation successful!</div>"; ?>

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="admin_hotel_form">
                <input type="hidden" name="id" id="user_id" value="">
                
                <div>
                    <label for="first_name">First Name:</label>
                    <input type="text" name="first_name" id="first_name" required>
                </div>
                
                <div>
                    <label for="last_name">Last Name:</label>
                    <input type="text" name="last_name" id="last_name" required>
                </div>
                
                <div>
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" required>
                </div>

                <div>
                    <label for="password">Password:</label>
                    <input type="text" name="password" id="password" required>
                </div>

                <div class="action-buttons">
                    <button type="submit" id="submit_button">Add User</button>
                    <button type="button" onclick="resetForm()" style="background-color:gray;">Reset</button>
                </div>
            </form>

            <table id="hotels_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if ($result && $result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr data-id='{$row['id']}'
                                    data-first_name='" . htmlspecialchars($row['first_name']) . "'
                                    data-last_name='" . htmlspecialchars($row['last_name']) . "'
                                    data-email='" . htmlspecialchars($row['email']) . "'
                                    data-password='" . htmlspecialchars($row['password']) . "'>
                                    <td>{$row['id']}</td>
                                    <td>" . htmlspecialchars($row['first_name']) . "</td>
                                    <td>" . htmlspecialchars($row['last_name']) . "</td>
                                    <td>" . htmlspecialchars($row['email']) . "</td>
                                    <td>" . htmlspecialchars($row['password']) . "</td>
                                    <td><a href='delete_user.php?id={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this user?\")'><img src='../source/trash.svg' width='20' alt='Delete'></a></td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No users found</td></tr>";
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
                
                document.getElementById("user_id").value = row.dataset.id;
                document.getElementById("first_name").value = row.dataset.first_name;
                document.getElementById("last_name").value = row.dataset.last_name;
                document.getElementById("email").value = row.dataset.email;
                document.getElementById("password").value = row.dataset.password;

                document.getElementById("submit_button").innerText = "Update User";
            });
        });

        function resetForm() {
            document.getElementById("user_id").value = "";
            document.getElementById("first_name").value = "";
            document.getElementById("last_name").value = "";
            document.getElementById("email").value = "";
            document.getElementById("password").value = "";

            document.getElementById("submit_button").innerText = "Add User";
        }
    </script>
</body>
</html>