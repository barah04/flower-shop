<?php
session_start(); // بدء الجلسة
$user_name = $_SESSION['first_name'];  // استرجاع اسم المستخدم من الجلسة

header('Content-Type: text/html; charset=UTF-8');

// التحقق من أن الجلسة تحتوي على user_id
if (!isset($_SESSION['user_id'])) {
    echo '<p>من فضلك قم بتسجيل الدخول أولاً.</p>';
    exit();
}
 if (!isset($_SESSION['cartProducts'])) {
        $_SESSION['cartProducts'] = []; // إذا لم تكن السلة موجودة في الجلسة، نقوم بإنشائها
    }

// جلب user_id من الجلسة
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

// استعلام SQL لدمج البيانات من جدول cart و bouquetes بناءً على User_ID
$sql = "
    SELECT 
        c.Item_ID, 
        c.Quantity_item, 
        c.Message_On_Card,
        c.color, 
        c.Addition, 
        c.Subtotal, 
        b.Boiqiets_Name,
        b.bouquete_img
    FROM 
        cart c
    JOIN 
        bouquetes b 
    ON 
        c.Bouquet_ID = b.Boiqiets_ID
    WHERE 
        c.User_ID = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$cartProducts = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cartProducts[] = array(
            'Item_ID' => $row['Item_ID'],
            'Quantity_item' => $row['Quantity_item'],
            'Message_On_Card' => $row['Message_On_Card'],
            'color' => $row['color'],
            'Addition' => $row['Addition'],
            'Subtotal' => $row['Subtotal'],
            'Boiqiets_Name' => $row['Boiqiets_Name'],
            'bouquete_img' => $row['bouquete_img']
        );
    }
} else {
    $cartProducts = null; // إذا لم تكن هناك منتجات في السلة
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping cart</title>
     <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            margin: 0;
        }

        .header {
            background-color: #FF1493;
            color: black;
            padding: 20px;
            text-align: center;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .header img {
            height: 50px;
            width: 50px;
            margin-right: 10px;
        }

        .header h1 {
            font-size: 1.8em;
            color: #fff;
            margin: 0;
            text-align: center;
            display: inline-block;
        }

        .back-btn {
            background-color: white;
            color: #FF69B4;
            padding: 10px;
            border: none;
            cursor: pointer;
            position: absolute;
            left: 55px;
            top: 24px;
        }

        .back-btn:hover {
            background-color: #fff;
        }

        .cart-container {
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
            padding: 10px;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .cart-item img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            margin-right: 10px;
        }

        .cart-item .details {
            flex-grow: 1;
            margin-left: 10px;
        }

        .cart-item .details div {
            margin: 5px 0;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
        }

        .checkbox-container input {
            margin-left: 10px;
        }

        /* تعديل الشريط السفلي */
        .total-container {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            display: flex;
            justify-content: space-between;
            padding: 10px 20px; 
            background-color: #ffffff;
            font-size: 18px;
            border-top: 2px solid #ddd;
            z-index: 1000;
        }

        .total-text {
            margin-right: -870px; /* تقليل المسافة بين كلمة Total Price والسعر */
            font-weight: bold;
        }

        .total-price {
            font-weight: normal;
            margin-left: 1px; /* تقليل المسافة بين السعر و زر تأكيد الطلب */
        }

        .confirm-order {
            display: flex;
            justify-content: center;
            padding: 20px;
            background-color: #ffffff;
        }

        #confirm-btn {
            padding: 10px 20px;
            background-color: #FF69B4;
            color: white;
            border: none;
            cursor: pointer;
        }

        #confirm-btn:hover {
            background-color: #FF1493;
        }

        .no-products-message {
            text-align: center;
            font-size: 18px;
            color: #FF1493;
            margin-top: 20px;
        }

        /* تنسيق سلة المهملات */
  .delete-icon {
    cursor: pointer;
    font-size: 24px;  /* يمكن تعديل الحجم حسب الحاجة */
    color: #FF1493;  /* اختيار اللون المناسب */
    margin-left: 10px;
}

.delete-icon:hover {
    color: #FF69B4;  /* لون عند المرور فوق الأيقونة */
}

        /* نافذة التأكيد */
        .confirmation-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .confirmation-box {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        .confirmation-box button {
            padding: 10px 20px;
            background-color: #FF1493;
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 20px;
        }

        .confirmation-box button:hover {
            background-color: #FF69B4;
        }
			
		
		.sidebar {
            position: fixed;
            left: 0;
            top: 100px;
            width: 250px;
            background-color: #FF80CC;
            padding: 20px;
            display: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            transition: 0.3s;
            text-align: center;
        }

        .sidebar.active {
            display: block;
        }

        .sidebar h3,
        .sidebar p {
            color: white;
            margin-bottom: 10px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            background-color: #FF1493;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            display: block;
            margin-top: 10px;
            font-weight: bold;
            text-transform: uppercase;
            transition: 0.3s;
        }

     .profile-icon {
            position: absolute;
            left: 10px;
            top: 40px;
            transform: translateY(-50%);
            font-size: 1.5em;
            cursor: pointer;
            color: #FF80CC;
            background-color: transparent;
            border: none;
        }
        .sidebar a:hover {
            background-color: #E21383;
        }

        .profile-icon:hover + .sidebar,
        .sidebar:hover {
            display: block;
        }
		 .details-link {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #FF1493;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: 0.3s;
        }

        .details-link:hover {
            background-color: #E21383;
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>

    <!-- شريط علوي مع زر الرجوع -->
    <div class="header">
        <button class="profile-icon" onclick="toggleSidebar()">👤</button>
        <button class="back-btn" onclick="window.history.back()">back</button>
        <img src="logo.jpg" alt="Rawah Al-Ward Logo">
        <h1>Rawah Al-Ward - By Saja & Barah</h1>
    </div>

    <!-- القائمة الجانبية للمستخدم -->
    <div class="sidebar">
        <h3>Welcome  <?php echo htmlspecialchars($user_name); ?></h3>
        <a href="logout.php">Log Out</a>
    </div>

    <!-- عرض السلة والمنتجات -->
    <div class="cart-container">
        <?php if ($cartProducts): ?>
            <?php foreach ($cartProducts as $product): ?>
                <div class="cart-item" id="cart-item-<?= $product['Item_ID']; ?>">
                    <img src="<?= $product['bouquete_img']; ?>" alt="<?= $product['Boiqiets_Name']; ?>">
                    <div class="details">
                        <div><strong>Bouquet name:</strong> <?= $product['Boiqiets_Name']; ?></div>
                        <div><strong>Quantity:</strong> <?= $product['Quantity_item']; ?></div>
                        <div><strong>Color:</strong> <?= $product['color']; ?></div>
                        <div><strong>Additions:</strong> <?= $product['Addition']; ?></div>
                        <div><strong>Message on card:</strong> <?= $product['Message_On_Card']; ?></div>
                        <div><strong>Price:</strong> <?= $product['Subtotal']; ?> JD</div>
                    </div>
                    <div class="checkbox-container">
                        <input type="checkbox" data-price="<?= $product['Subtotal']; ?>" onclick="updateTotal()">
                    </div>
                    <!-- صورة سلة المهملات -->
                    <i class="fas fa-trash delete-icon" onclick="confirmDelete(<?= $product['Item_ID']; ?>)"></i>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-products-message">
                <p>There are no products in the cart.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- السعر النهائي -->
    <div class="total-container">
        <div class="total-text">Total Price:</div>
        <div class="total-price" id="total-price">0.00</div>
        <button id="confirm-btn" onclick="confirmOrder()">Confirm order</button>
    </div>

    <!-- نافذة التأكيد -->
    <div class="confirmation-overlay" id="confirmation-overlay">
        <div class="confirmation-box">
            <p>Are you sure you want to delete this bouquet?</p>
            <button onclick="deleteItemConfirmed()">Yes</button>
            <button onclick="closeConfirmation()">No</button>
        </div>
    </div>
<script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
        }
    </script>
<script>
    let totalPrice = 0;
    let itemToDelete = null;

    // تحديث السعر الإجمالي عند تحديد المربعات
    function updateTotal() {
        totalPrice = 0;
        const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
        checkboxes.forEach(function (checkbox) {
            totalPrice += parseFloat(checkbox.getAttribute('data-price'));
        });
        document.getElementById('total-price').innerText = totalPrice.toFixed(2);
    }

    // فتح نافذة التأكيد
    function confirmDelete(itemId) {
        itemToDelete = itemId;
        document.getElementById('confirmation-overlay').style.display = 'flex';
    }

    // إغلاق نافذة التأكيد
    function closeConfirmation() {
        document.getElementById('confirmation-overlay').style.display = 'none';
    }

    // حذف العنصر من السلة باستخدام AJAX
    function deleteItemConfirmed() {
        if (itemToDelete !== null) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "delete_item.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("item_id=" + itemToDelete);

            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = xhr.responseText;
                    if (response === "success") {
                        // إزالة العنصر من واجهة المستخدم (HTML)
                        document.getElementById('cart-item-' + itemToDelete).remove();
                        closeConfirmation();
                        alert('Item has been deleted.');
                    } else {
                        alert('Error deleting item from database.');
                    }
                } else {
                    alert('AJAX request failed.');
                }
            };
        }
    }

    // تأكيد الطلب والانتقال إلى صفحة "Complete_purchase.php"
    function confirmOrder() {
    // تجميع السعر الإجمالي
    let totalAmount = totalPrice.toFixed(2);

    // جمع الـ item IDs
    let selectedItems = [];
    const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
    checkboxes.forEach(function (checkbox) {
        selectedItems.push(checkbox.closest('.cart-item').getAttribute('id').replace('cart-item-', ''));
    });

    // تحويل الـ array إلى string عبر فاصل الفواصل
    let itemsString = selectedItems.join(',');

    // التوجيه إلى صفحة 'Complete_purchase.php' مع تمرير السعر والـ items عبر URL
    window.location.href = 'Complete_purchase.php?total=' + totalAmount + '&items=' + itemsString;
}

</script>

</body>
</html>
