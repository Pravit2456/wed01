<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เมนูอาหารไทย</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>เมนูอาหารไทย</h1>
    </header>

    <div class="menu-container">
        <?php
        // เชื่อมต่อฐานข้อมูล
        $host = "localhost";
        $user = "root";
        $pass = "1234";
        $db = "thai_food";
        $conn = new mysqli($host, $user, $pass, $db);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // ดึงข้อมูลจากฐานข้อมูล
        $sql = "SELECT name, image, ingredients, recipe FROM menus";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='menu-item'>";
                echo "<img src='./" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "'>";
                echo "<h2>" . htmlspecialchars($row['name']) . "</h2>";
                echo "<p><strong>วัตถุดิบ:</strong> " . nl2br(htmlspecialchars($row['ingredients'])) . "</p>";
                echo "<p><strong>วิธีทำ:</strong> " . nl2br(htmlspecialchars($row['recipe'])) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p class='no-menu'>ไม่มีเมนูอาหารในระบบ</p>";
        }

        $conn->close();
        ?>
    </div>

    <footer>
        <p>&copy; 2025 แนะนำอาหารไทย</p>
    </footer>
</body>
</html>
