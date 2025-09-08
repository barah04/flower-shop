<?php
session_start();

// تفعيل عرض الأخطاء
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "online_flower_store"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// الاتصال بقاعدة البيانات
if (isset($_POST['bouquet_id'])) {
    $bouquetID = $_POST['bouquet_id'];
} else {
    die("Error: 'id' parameter is missing in the form submission.");
}

// استلام البيانات من النموذج
$quantity = $_POST['quantity']; // الكمية
$color = $_POST['color']; // اللون
$message = $_POST['message']; // الرسالة
$additions = isset($_POST['addition']) ? $_POST['addition'] : []; // الحصول على الإضافات كمصفوفة
$bouquetName = isset($_POST['Boiqiets_Name']) ? $_POST['Boiqiets_Name'] : ''; // استلام اسم البوكيه
// التحقق من أن المستخدم قد قام بتسجيل الدخول
if (!isset($_SESSION['user_id'])) {
    die("Error: User is not logged in.");
}

// استرجاع user_id من الجلسة
$user_id = $_SESSION['user_id']; 

// استعلام SQL للحصول على سعر الباقة باستخدام ID
$bouquet_query = "SELECT Boiqiets_Price FROM bouquetes WHERE Boiqiets_ID = '$bouquetID'";
$result = mysqli_query($conn, $bouquet_query);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $bouquet_price = $row['Boiqiets_Price']; // تعيين السعر إلى متغير

    // حساب المجموع الفرعي بناءً على الكمية
    $subtotal = $bouquet_price * $quantity; // جمع السعر بناءً على الكمية

    // إضافة رسوم إضافية بناءً على الخيارات المحددة
    $additional_cost = 0; // تحديد تكلفة الإضافات
    $additions_string = ""; // سلسلة الإضافات التي سيتم تخزينها

    // التحقق من أن الإضافات تتطابق مع القيم الموجودة
    $valid_additions = [
        'add 10 flower more + 5jod' => 5,
        'teddy bear + 10jod' => 10,
        'chocolate + 25jod' => 25
    ];
   
    foreach ($additions as $addition) {
        // تحويل النصوص إلى حروف صغيرة للتأكد من التوافق
        $addition = strtolower($addition); // جعل النص صغيراً لجميع الأحرف

        // التحقق من أن القيمة المدخلة صالحة
        if (isset($valid_additions[$addition])) {
            // إضافة التكلفة الإضافية بناءً على الإضافة
            $additional_cost += $valid_additions[$addition];
            $additions_string .= ucfirst($addition) . ", "; // إضافة الخيار إلى السلسلة مع تغيير أول حرف إلى كبير
        }
    }

    // إزالة الفاصلة الزائدة في النهاية
    $additions_string = rtrim($additions_string, ", ");

    // إضافة التكلفة الإضافية إلى المجموع الفرعي
    $subtotal += $additional_cost;

    // إدخال البيانات إلى جدول الـ cart
    $created_at = date('Y-m-d H:i:s'); // التاريخ الحالي
    $query_insert_cart = "INSERT INTO cart (User_ID, Bouquet_ID, Boiqiets_Name,
	Quantity_item, Message_On_Card, Color, Addition, Subtotal, Created_At) 
    VALUES ('$user_id', '$bouquetID', '$bouquetName', 
	'$quantity',	'$message', '$color', '$additions_string', '$subtotal', '$created_at')";

    // تنفيذ الاستعلام والتحقق من النجاح
    if (mysqli_query($conn, $query_insert_cart)) {
        // إعادة التوجيه إلى الصفحة السابقة (التي جاء منها المستخدم)
        $previous_page = $_SERVER['HTTP_REFERER']; // الحصول على رابط الصفحة السابقة
        header("Location: $previous_page"); // إعادة التوجيه إليها
        exit(); // تأكد من أن العملية لا تستمر بعد التوجيه
    } else {
        echo "Error: " . $query_insert_cart . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Error fetching bouquet price: " . mysqli_error($conn);
}

$conn->close();
?>
