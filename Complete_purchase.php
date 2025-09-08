<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

// التحقق من وجود المتغير 'total' في الرابط
if (!isset($_GET['total'])) {
    echo '<script>window.location.href = "BasketPage.php";</script>';
    exit();
}

$totalAmount = (float) $_GET['total'];

// إعداد الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online_flower_store";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullName = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $delivery = $_POST['delivery'];
    $payment_method = $_POST['payment_method'];

    if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
        echo 'Error: User not logged in';
        exit();
    }

    $user_id = $_SESSION['user_id'];

    // التحقق من وجود المستخدم في قاعدة البيانات
    $checkUserQuery = "SELECT * FROM users WHERE ID_User = ?";
    $stmt = $conn->prepare($checkUserQuery);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo 'Error: User not found in the database.';
        exit();
    }

    // إدخال البيانات في جدول order_details
    $insertQuery = "INSERT INTO order_detail (User_ID, Full_Name, Email, PhoneNumber, Deliveryto, Subtotal, Payment_Method, Created_At)
                    VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";

    $stmt = $conn->prepare($insertQuery);
    if ($stmt === false) {
        echo 'Error preparing query: ' . $conn->error;
        exit();
    }

    $stmt->bind_param("issdsss", $user_id, $fullName, $email, $phone, $delivery, $totalAmount, $payment_method);
if (!$stmt->execute()) {
    die("Error executing query: " . $stmt->error);
}}?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete the purchase</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fff;
            color: #4a4a4a;
            margin: 0;
            padding: 0;
            padding-top: 100px; /* زيادة المسافة لتفادي تداخل العنوان الثابت مع المحتوى */
        }

        header {
            background-color: #FF80CC;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            border-bottom: 4px solid #F5D0D6;
        }

        header .back-btn {
            position: absolute;
            left: 20px;
            background-color: #ccc;
            color: white;
            border-radius: 5px;
            font-size: 16px;
            padding: 8px 15px;
            cursor: pointer;
        }

        header img {
            height: 50px;
            width: auto;
            margin-right: 10px;
        }

        header h1 {
            font-size: 1.8em;
            color: #fff;
            margin: 0;
            text-align: center;
            display: inline-block;
        }

        .checkout-container {
            width: 60%;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .checkout-details {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        label {
            font-size: 16px;
            color: #333;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .total-price {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-top: 20px;
            color: #333;
        }

        .confirm-btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #FF69B4;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            text-align: center;
            margin-top: 20px;
        }

        .confirm-btn:hover {
            background-color: #FF1493;
        }

        .payment-card-fields {
            display: none;
        }

        .success-message {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #f0f0f0;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            color: #000;
            font-size: 18px;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: none;
        }
    </style>
</head>
<body>
<header>
    <button class="back-btn" onclick="window.history.back()">Back</button>
    <div class="header-content">
        <img src="logo.jpg" alt="Rawah Al-Ward Logo">
        <h1>Rawah Al-Ward - By Saja & Barah</h1>
    </div>
</header>

<div class="checkout-container">
    <h1>Complete the purchase</h1>

    <!-- نموذج إتمام الشراء -->
    <form id="checkout-form" action="" method="POST">
        <div class="checkout-details">
            <div>
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter your full name" required>

                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" placeholder="Enter your e-mail" required>

                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>

                <label for="delivery">Delivery to:</label>
                <select class="delivery-select" id="delivery" name="delivery">
                    <option selected>Amman</option>
                    <option>Zarqa</option>
                    <option>Irbid</option>
                    <option>Aqaba</option>
                    <option>Mafraq</option>
                    <option>Karak</option>
                    <option>Ma'an</option>
                    <option>Jerash</option>
                    <option>Ajloun</option>
                    <option>Madaba</option>
                    <option>Balqa</option>
                    <option>Tafilah</option>
                </select>

                <label for="payment_method">Payment Method:</label>
                <select name="payment_method" id="payment_method" required>
                    <option value="cash">Cash</option>
                    <option value="credit_card">Bank Card</option>
                </select>
                
                <div class="payment-card-fields" id="card-fields">
                    <label for="card_number">Card Number:</label>
                    <input type="text" name="card_number" placeholder="Enter your card number" required>

                    <label for="cvv">CVV:</label>
                    <input type="text" name="cvv" placeholder="Enter CVV" required>
                </div>
            </div>
        </div>

        <div class="total-container">
            <h2>Order Summary:</h2>
            <div class="total-price">
                <label for="total">Total Price:</label>  
                <input type="text" name="total" id="total" value="<?= htmlspecialchars($totalAmount); ?>" readonly>
            </div>
            <button type="submit" class="confirm-btn" id="confirm-btn">Confirm Order</button>
        </div>
    </form>
</div>

<div class="success-message" id="successMessage">Order placed successfully!<br>
   The request will be sent tomorrow at 3pm...<br>
   Call us on the following number if the request is urgent: 0798995614</div>

<script>
    // إظهار أو إخفاء حقول بطاقة الائتمان بناءً على اختيار طريقة الدفع
    document.getElementById('payment_method').addEventListener('change', function() {
        var paymentMethod = this.value;
        var cardFields = document.getElementById('card-fields');
        if (paymentMethod === 'credit_card') {
            cardFields.style.display = 'block';
        } else {
            cardFields.style.display = 'none';
        }
    });

    // عرض رسالة النجاح عند تقديم النموذج
    document.getElementById('checkout-form').addEventListener('submit', function(event) {
        event.preventDefault();  // إيقاف إرسال النموذج في البداية
        
        // إظهار رسالة النجاح
        document.getElementById("successMessage").style.display = "block";
        
        // إخفاء رسالة النجاح بعد 3 ثوانٍ
        setTimeout(function() {
            document.getElementById("successMessage").style.display = "none";
            // بعد إخفاء الرسالة، إرسال النموذج
            document.getElementById('checkout-form').submit();
        }, 10000);
    });
</script>
</body>
</html>
