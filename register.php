<?php

session_start();

// إعداد الاتصال بقاعدة البيانات
$conn = new mysqli("localhost", "root", "", "online_flower_store");  

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// إذا كان المستخدم قد ضغط على زر التسجيل
if (isset($_POST['register'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $user_email = $_POST['email'];
    $password = $_POST['password'];  
    $confirm_password = $_POST['confirm_password'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $user_phone = $_POST['numberphone'];  // إضافة الرقم هنا


    // تحقق إذا كانت كلمة المرور وتأكيد كلمة المرور متطابقتين
    if ($password === $confirm_password) {
        // استعلام لإدخال البيانات في قاعدة البيانات
        $sql = "INSERT INTO users (first_name, last_name, user_email, password_useremail, date_birth, gender, user_phone, created_at)
                VALUES ('$first_name', '$last_name', '$user_email', '$password', '$dob', '$gender', '$user_phone', CURRENT_TIMESTAMP)";
                
        if ($conn->query($sql) === TRUE) {
            // الحصول على الـ user_id المُضاف حديثاً
            $_SESSION['user_id'] = $conn->insert_id;  // تخزين الـ user_id في الجلسة
            $_SESSION['first_name'] = $first_name;   // تخزين اسم المستخدم في الجلسة
            $_SESSION['last_name'] = $last_name;     // تخزين اسم العائلة في الجلسة
            $_SESSION['user_email'] = $user_email;  // تخزين البريد الإلكتروني في الجلسة
            header("Location: page3.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Passwords do not match!";
    }
}

$conn->close();
?>
