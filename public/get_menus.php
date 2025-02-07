<?php
// ตั้งค่าการเชื่อมต่อฐานข้อมูล
$host = "localhost";
$user = "root";
$pass = "1234";
$db = "thai_food";

// เชื่อมต่อฐานข้อมูล
$conn = new mysqli($host, $user, $pass, $db);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ดึงข้อมูลจากตาราง menus
$sql = "SELECT * FROM menus";
$result = $conn->query($sql);

// ตรวจสอบว่ามีข้อมูลหรือไม่
$menus = array();  // สร้าง array เก็บข้อมูลเมนู

if ($result->num_rows > 0) {
    // แสดงผลข้อมูลที่ดึงมา
    while ($row = $result->fetch_assoc()) {
        $menus[] = $row;  // ใส่ข้อมูลลงใน array
    }
}

// ส่งข้อมูลออกในรูปแบบ JSON
echo json_encode($menus);

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>
