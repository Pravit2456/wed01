<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$user = "root";
$pass = "1234";
$db = "thai_food";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    // รับข้อมูลจากฟอร์ม
    $category = $_POST['category'];
    $name = $_POST['name'];
    $ingredients = $_POST['ingredients'];
    $recipe = $_POST['recipe'];

    // กำหนดตำแหน่งที่เก็บไฟล์รูปภาพ
    $target_dir = "uploads/"; // โฟลเดอร์สำหรับเก็บรูปภาพ
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // ตรวจสอบว่าไฟล์เป็นภาพหรือไม่
    if (getimagesize($_FILES["fileToUpload"]["tmp_name"]) === false) {
        echo "<script>alert('ไฟล์ที่อัปโหลดไม่ใช่ภาพ');</script>";
        $uploadOk = 0;
    }

    // ตรวจสอบขนาดของไฟล์
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "<script>alert('ขออภัย, ขนาดไฟล์ของคุณใหญ่เกินไป');</script>";
        $uploadOk = 0;
    }

    // ตรวจสอบประเภทของไฟล์
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "<script>alert('ขออภัย, สามารถอัปโหลดเฉพาะไฟล์ JPG, JPEG, PNG หรือ GIF เท่านั้น');</script>";
        $uploadOk = 0;
    }

    // อัปโหลดไฟล์
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            // สร้างคำสั่ง SQL สำหรับการบันทึกข้อมูล
            $sql = "INSERT INTO menus (category, name, image, ingredients, recipe) 
                    VALUES ('$category', '$name', '$target_file', '$ingredients', '$recipe')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('อัปโหลดเมนูอาหารสำเร็จ!');</script>";
                header("Location: menu.php"); // หลังจากอัปโหลดเสร็จจะเปลี่ยนหน้าไปที่ menu.php
                exit();
            } else {
                echo "<script>alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล');</script>";
            }
        } else {
            echo "<script>alert('เกิดข้อผิดพลาดในการอัปโหลดไฟล์');</script>";
        }
    } 
}

$conn->close();
?>
