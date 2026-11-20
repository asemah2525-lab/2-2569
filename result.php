<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ผลการลงทะเบียน</title>
</head>
<body>
    <h1>ผลการลงทะเบียน</h1>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fullname   = $_POST["fullname"];
        $student_id = $_POST["student_id"];
        $gender     = $_POST["gender"];
        $level      = $_POST["level"];
        $email      = $_POST["email"];

        try {
            $conn = new PDO("mysql:host=localhost;dbname=student_db;charset=utf8mb4", "root", "");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO students (fullname, student_id, gender, level, email)
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$fullname, $student_id, $gender, $level, $email]);

            echo "<p>ชื่อ-สกุล: " . htmlspecialchars($fullname) . "</p>";
            echo "<p>รหัสนักเรียน: " . htmlspecialchars($student_id) . "</p>";
            echo "<p>เพศ: " . htmlspecialchars($gender) . "</p>";
            echo "<p>ระดับชั้น: " . htmlspecialchars($level) . "</p>";
            echo "<p>อีเมล: " . htmlspecialchars($email) . "</p>";
            echo "<p><strong>บันทึกข้อมูลลงฐานข้อมูลเรียบร้อยแล้ว</strong></p>";
        } catch (PDOException $e) {
            echo "<p>บันทึกไม่สำเร็จ: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p>กรุณากรอกข้อมูลจากหน้าแบบฟอร์ม</p>";
    }
?>
    <a href="form.html">กลับไปหน้าแบบฟอร์ม</a>
</body>
</html>