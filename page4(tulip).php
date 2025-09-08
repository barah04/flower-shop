<?php
session_start(); // بدء الجلسة
$user_name = $_SESSION['first_name'];  // استرجاع اسم المستخدم من الجلسة
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page4(tulip)</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fff;
            color: #4a4a4a;
            margin: 0;
            padding: 0;
        }
        
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 30px;
            background-color: #FF80CC;
            border-bottom: 4px solid #F5D0D6;
            position: relative;
        }

        .header-left {
            display: flex;
            align-items: center;
        }

        header h1 {
            font-size: 1.8em;
            color: #fff;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-grow: 1;
            margin-left: 10px; /* المسافة بين الشعار والنص */
        }

        header img {
            height: 50px;
            width: auto;
            margin-right: 10px; /* المسافة بين الشعار والنص */
        }

        .cart {
            font-size: 0.8em;
            color: #fff;
            text-decoration: none;
            background-color: #FF1493;
            padding: 10px;
            border-radius: 20px;
            position: relative;
            top: 3px;
            transition: background-color 0.3s;
        }

        .cart:hover {
            background-color: #E21383;
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

        .sidebar a:hover {
            background-color: #E21383;
        }

        .profile-icon:hover + .sidebar,
        .sidebar:hover {
            display: block;
        }

        .flower-detail-container {
            text-align: center;
            padding: 40px;
        }

        .flower-images-gallery {
            display: flex;
            justify-content: space-around;
            margin-bottom: 40px;
        }

        .flower-image-item {
            text-align: center;
            width: 30%;
        }

        .flower-image-item img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }

        .flower-image-item p {
            margin: 5px 0;
            font-size: 1.1em;
        }

        .flower-name {
            font-weight: bold;
            margin: 10px 0;
            font-size: 1.2em;
        }

        .flower-image-item input[type="number"] {
            width: 60px;
            padding: 5px;
            font-size: 1em;
            text-align: center;
            margin: 5px 0;
        }

        .flower-image-item select {
            padding: 5px;
            font-size: 1em;
            margin: 5px 0;
        }

        .flower-image-item button {
            padding: 10px;
            background-color: #FF1493;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .flower-image-item button:hover {
            background-color: #E21383;
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

        .profile-icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.5em;
            cursor: pointer;
            color: #FF80CC;
            background-color: transparent;
            border: none;
        }

        /* تعديل زر الرجوع ليظهر بجانب الأيقونة */
        button {
            background-color: transparent;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            position: absolute;
            left: 70px;
            top: 50%;
            transform: translateY(-50%);
        }

        button a {
            text-decoration: none;
            color: white;
        }

        button a:hover {
            color: #FF1493;
        }

    </style>
</head>

<body>
    <header>
        <button class="profile-icon" onclick="toggleSidebar()">👤</button>
        <button onclick="window.history.back()" style="background-color: transparent; border: none; color: white; font-size: 20px; cursor: pointer; position: absolute; left: 70px; top: 50%; transform: translateY(-50%);">
            <a href="page3.php">&#8592; Back</a>
        </button>
        <div style="display: flex; align-items: center; justify-content: center; flex-grow: 1;">
            <h1><img src="logo.jpg" alt="Rawah Al-Ward Logo" style="height: 50px; width: auto; margin-right: 50px;">

			Rawah Al-Ward - By Saja & Barah</h1>

        </div>
        <a href="Basketpage.php" class="cart" id="cart">🛒 Cart </a>
    </header>

    <!-- القائمة الجانبية للمستخدم -->
    <div class="sidebar">
        <h3>Welcome  <?php echo htmlspecialchars($user_name); ?></h3>
        <a href="logout.php">Log Out</a>
    </div>

    <div class="flower-detail-container">
        <div class="flower-images-gallery">
            <div class="flower-image-item">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQYbnitEg9Dw3HJPKvYNDtG42MuFZ31kH-5JVrN3chi1VXZ-PwlJKaXFl6DjX2kHhnOevY&usqp=CAU" alt="Tulip">
                <p class="flower-name">tulip and Daisy</p>
                <p>Price: $20</p>
                <a href="Page5(tulip & Daisy).php" class="details-link" target="_blank">View Details</a>
            </div>

            <div class="flower-image-item">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQAS73y-wxNwGhsyS8aMT3hgQAFMp-VCODdIw&s" alt="Tulip">
                <p class="flower-name">tulip and Orchid</p>
                <p>Price: $15</p>
                <a href="tulip_details.html" class="details-link" target="_blank">View Details</a>
            </div>

            <div class="flower-image-item">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTon-z2Sg20TfYnJE8dyC8iw9Ezndb2s_cMrA&s" alt="Tulip">
                <p class="flower-name">tulip and Carnation</p>
                <p>Price: $18</p>
                <a href="lily_details.html" class="details-link" target="_blank">View Details</a>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
        }
    </script>

    <script>
        let cartCount = 0;

        function addToCart(flower, price, quantityId, colorId) {
            let quantity = document.getElementById(quantityId).value;
            let color = document.getElementById(colorId).value;

            cartCount += parseInt(quantity);
            document.getElementById("cart-count").textContent = cartCount;

            alert(`${flower} added to cart. Quantity: ${quantity}, Color: ${color}`);
        }
    </script>
</body>

</html>
