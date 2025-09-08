<?php
session_start(); // بدء الجلسة

// إنشاء الاتصال بقاعدة البيانات
$conn = new mysqli("localhost", "root", "", "online_flower_store");

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// إذا كان المستخدم قد ضغط على زر تسجيل الدخول
if (isset($_POST['login'])) {
    $User_Email = $_POST['UserEmail'];  // البريد الإلكتروني للمستخدم
    $Password_UserEmail = $_POST['password'];  // كلمة المرور

    // استخدام الاستعلام المحضر لتفادي SQL Injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE User_Email = ?");
    $stmt->bind_param("s", $User_Email);  // ربط المتغير مع الاستعلام المحضر
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // إذا تم العثور على المستخدم
        $row = $result->fetch_assoc();

        // مقارنة كلمة المرور المدخلة مع المخزنة في قاعدة البيانات
        if ($Password_UserEmail === $row['Password_UserEmail']) {
            // إذا كانت كلمة المرور صحيحة، تخزين بيانات المستخدم في الجلسة
            $_SESSION['user_id'] = $row['ID_User'];
            $_SESSION['first_name'] = $row['first_name'];

            // الانتقال إلى الصفحة الرئيسية بعد تسجيل الدخول
            header("Location: page3.php");
            exit();
        } 
		else {
            // إذا كانت كلمة المرور خاطئة
            $_SESSION['error_message'] = "Invalid password!";
            header("Location: page21.php");
            exit();
        }
    } else {
        // إذا لم يتم العثور على المستخدم
        $_SESSION['error_message'] = "No user found with this email!";
        header("Location: page21.php");
        exit();
    }

    // إغلاق الاستعلام المحضر
    $stmt->close();
}

// إغلاق الاتصال بقاعدة البيانات
$conn->close();
?>
