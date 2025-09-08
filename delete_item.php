<?php
session_start();
header('Content-Type: application/json; charset=UTF-8');

// التحقق من أن المستخدم مسجل دخوله
if (!isset($_SESSION['user_id'])) {
    echo "error"; // إذا لم يكن المستخدم مسجل الدخول
    exit();
}

// جلب الـ Item_ID من الطلب
if (isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];
    $user_id = $_SESSION['user_id'];

    // إعداد الاتصال بقاعدة البيانات
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "online_flower_store";

    // إنشاء الاتصال
    $conn = new mysqli($servername, $username, $password, $dbname);

    // التحقق من الاتصال
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // استعلام SQL لحذف المنتج من السلة بناءً على Item_ID و User_ID
    $sql = "DELETE FROM cart WHERE Item_ID = ? AND User_ID = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $item_id, $user_id);

    if ($stmt->execute()) {
        echo "success"; // إعادة نتيجة نجاح الحذف
    } else {
        echo "error"; // في حالة فشل الحذف
    }

    $stmt->close();
    $conn->close();
} else {
    echo "error"; // إذا لم يتم إرسال الـ Item_ID
}
?>
