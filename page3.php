<?php
session_start(); // بدء الجلسة

// التأكد من وجود قيمة 'first_name' في الجلسة قبل استخدامها
if (isset($_SESSION['first_name'])) {
    $user_name = $_SESSION['first_name'];  // استرجاع اسم المستخدم من الجلسة
} else {
    // إذا لم يكن هناك اسم مستخدم في الجلسة، يمكن تعيين قيمة افتراضية أو توجيه المستخدم إلى صفحة أخرى.
    $user_name = "Guest";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page3</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fff;
            color: #4a4a4a;
            margin: 0;
            padding: 0;
            padding-top: 120px; /* زيادة المسافة لتفادي تداخل العنوان الثابت مع المحتوى */
        }

        header {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 30px;
            background-color: #FF80CC;
            border-bottom: 4px solid #F5D0D6;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        header h1 {
            font-size: 1.8em;
            color: #fff;
            margin: 0;
            margin-left: 15px;
        }

        header img {
            height: 50px;
            width: auto;
        }

        .cart {
            font-size: 1.2em;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 20px;
            background-color: #FF1493;
            transition: 0.3s;
            position: absolute;
            right: 70px;
        }

        .cart:hover {
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

        .header .search-bar {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .search-bar input {
            width: 80%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            direction: rtl;
        }

        .search-bar input[type="submit"] {
            width: 150px;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #FF69B4;
            color: white;
            cursor: pointer;
        }

        .search-bar input[type="submit"]:hover {
            background-color: #FF1493;
        }

        .flower-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
            max-width: 1200px;
            margin: auto;
        }

        .flower-item {
            background-color: #F5D0D6;
            text-align: center;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .flower-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }

        .flower-item h3 {
            font-size: 1.2em;
            margin-top: 10px;
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

        .sidebar h3, .sidebar p {
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
    </style>
</head>

<body>
    <header>
        <button class="profile-icon" onclick="toggleSidebar()">👤</button>
        <button onclick="window.history.back()" style="background-color: transparent; border: none; color: white; font-size: 20px; cursor: pointer; position: absolute; left: 60px; top: 50%; transform: translateY(-50%);">
            &#8592; back
        </button>
        <img src="logo.jpg" alt="Shop Logo">
        <h1>Rawah Al-Ward By Saja & Barah</h1>
        <a href="Basketpage.php" class="cart">🛒 Cart</a>
    </header>

    <form action="page3_php.php" method="post">
        <div class="header">
            <div class="search-bar">
                <input type="text" name="search" placeholder="Search here...">
                <input type="submit" value="Search">
            </div>
        </div>
    </form>

    <div class="sidebar">
        <h3>Welcome <?php echo htmlspecialchars($user_name); ?></h3>
        <a href="logout.php">Log Out</a>
    </div>

   

    <section class="flower-gallery">
        <div class="flower-item">
            <a href="page4(Rose).php"><img src="https://i.pinimg.com/736x/52/17/bf/5217bf37413d750fc6833425bfd653bb.jpg" alt="Rose">
            <h3>Rose</h3></a>
        </div>

        <div class="flower-item">
            <a href="page4(tulip).php"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT6RC8ytGuuzqNEDjnfjoTIQCV7ZKRu3E4UrA&s" alt="Tulip">
            <h3>Tulip</h3></a>
        </div>

        <div class="flower-item">
            <a href="page4(Lily).php"><img src="https://images.pexels.com/photos/132466/pexels-photo-132466.jpeg?cs=srgb&dl=pexels-inspiredimages-132466.jpg&fm=jpg" alt="Lily">
            <h3>Lily</h3></a>
        </div>

        <div class="flower-item">
            <a href="flower-details.php?flower=daisy"><img src="https://upload.wikimedia.org/wikipedia/commons/9/9e/Leucanthemum_vulgare_close_up.jpg" alt="Daisy">
            <h3>Daisy</h3></a>
        </div>

        <div class="flower-item">
            <a href="flower-details.php?flower=orchid"><img src="https://www.rosepedia.com/wp-content/uploads/2016/03/29b489b621ea92a0/orchid-flower-pictures-7.jpeg" alt="Orchid">
            <h3>Orchid</h3></a>
        </div>

        <div class="flower-item">
            <a href="flower-details.php?flower=sunflower"><img src="https://images.pexels.com/photos/2651796/pexels-photo-2651796.jpeg?cs=srgb&dl=pexels-zszen-2651796.jpg&fm=jpg" alt="Sunflower">
            <h3>Sunflower</h3></a>
        </div>

        <div class="flower-item">
            <a href="flower-details.php?flower=carnation"><img src="https://cdn.pixabay.com/photo/2016/04/12/18/19/carnation-1325012_640.jpg" alt="Carnation">
            <h3>Carnation</h3></a>
        </div>

        <div class="flower-item">
            <a href="flower-details.php?flower=peony"><img src="https://thumbs.dreamstime.com/b/pink-peony-bloom-petals-leaves-light-grey-background-copy-space-generative-ai-design-instagram-facebook-wall-327469976.jpg" alt="Peony">
            <h3>Peony</h3></a>
        </div>

        <div class="flower-item">
            <a href="flower-details.php?flower=lavender"><img src="https://photozil.com/wp-content/uploads/2024/06/Fresh-Lavender-Flower-Herb-Display.jpg" alt="Lavender">
            <h3>Lavender</h3></a>
        </div>

        <div class="flower-item">
            <a href="flower-details.php?flower=marigold"><img src="https://cdn.pixabay.com/photo/2021/08/21/01/27/marigold-6561566_640.jpg" alt="Marigold">
            <h3>Marigold</h3></a>
        </div>
    </section>

    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
        }
    </script>
</body>

</html>
