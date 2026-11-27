<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
        $id = $_POST["id"];

        try {
            $conn = new PDO("mysql:host=localhost;dbname=student_db;charset=utf8mb4", "root", "");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
            $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo "ลบไม่สำเร็จ: " . $e->getMessage();
            exit;
        }
    }

    header("Location: list.php");
    exit;
?>