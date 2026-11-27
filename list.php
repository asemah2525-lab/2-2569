<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>รายชื่อนักเรียน</title>
</head>
<body>
    <h1>รายชื่อนักเรียนที่ลงทะเบียน</h1>
    <a href="form.html">+ ลงทะเบียนเพิ่ม</a><br><br>
<?php
    try {
        $conn = new PDO("mysql:host=localhost;dbname=student_db;charset=utf8mb4", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->query("SELECT * FROM students ORDER BY id");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) == 0) {
            echo "<p>ยังไม่มีข้อมูล</p>";
        } else {
            echo "<table border='1' cellpadding='5'>";
            echo "<tr><th>ลำดับ</th><th>ชื่อ-สกุล</th><th>รหัสนักเรียน</th><th>เพศ</th><th>ระดับชั้น</th><th>อีเมล</th><th>จัดการ</th></tr>";
            foreach ($rows as $row) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . htmlspecialchars($row["fullname"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["student_id"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["gender"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["level"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                echo "<td>
                        <form action='delete.php' method='post' onsubmit=\"return confirm('ยืนยันการลบข้อมูลนี้?');\">
                            <input type='hidden' name='id' value='" . $row["id"] . "'>
                            <button type='submit'>ลบ</button>
                        </form>
                      </td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    } catch (PDOException $e) {
        echo "<p>เกิดข้อผิดพลาด: " . $e->getMessage() . "</p>";
    }
?>
</body>
</html>