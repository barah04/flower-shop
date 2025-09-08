<?php
session_start(); // بدء الجلسة
// إعداد الاتصال بقاعدة البيانات
$conn = new mysqli("localhost", "root", "", "online_flower_store");  

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// التحقق من وجود عملية بحث
if (isset($_POST['search']) && !empty($_POST['search'])) {
    // أخذ النص المدخل في خانة البحث
    $search_term = $_POST['search'];

    // استخدام استعلام SQL للبحث عن الزهور التي تحتوي على النص المدخل
    $sql = "SELECT * FROM flowers WHERE Flower_Name LIKE '%$search_term%' OR Flower_Decripation LIKE '%$search_term%'";
    $result = $conn->query($sql);

    // التحقق من وجود نتائج
    if ($result->num_rows > 0) {
        echo "<h2>Search results:</h2>";
        
        // عرض النتائج داخل حاوية للتنسيق
        echo "<div class='flower-container'>";
        while ($row = $result->fetch_assoc()) {
            // عرض الزهور واسمائها مع رابط إلى صفحة تفاصيل الزهرة
            echo "<div class='flower-item'>";
            echo "<a href='page4(" . $row['Flower_Name'] . ").php'>";
            
            // تحديد حجم الصور عبر CSS
            echo "<img src='" . $row['image_url'] . "' alt='" . $row['Flower_Name'] . "' class='flower-img'>";
            echo "<h3>" . $row['Flower_Name'] . "</h3>";
            echo "</a>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "No results found for '$search_term'";
    }
} else {
    echo "Please enter a search term.";
}

$conn->close();
?>
<style>
    /* تنسيق الحاوية التي تحتوي على الزهور */
    .flower-container {
        display: flex; /* يجعل العناصر بترتيب أفقي */
        flex-wrap: wrap; /* يسمح بانتقال العناصر إلى السطر التالي عند امتلاء الصف */
        gap: 20px; /* المسافة بين الصور */
        background-color: #F7E1E1; /* خلفية زهري فاتح */
        padding: 20px; /* إضافة بعض الحشو حول الحاوية */
    }

    /* تنسيق كل عنصر زهرة */
    .flower-item {
        flex: 1 1 calc(33% - 20px); /* كل عنصر يشغل ثلث المساحة مع مسافة بين العناصر */
        text-align: center; /* محاذاة النص في الوسط */
    }

    /* تنسيق الصور داخل صفحة البحث */
    .flower-item img {
        width: 500; /* الصورة تأخذ عرض العنصر */
        height: 200px; /* يحدد ارتفاع الصورة */
        object-fit: cover; /* يضمن أن الصورة تملأ العنصر بشكل جيد */
        border-radius: 10px; /* إضافة حواف دائرية للصورة */
    }

    /* تنسيق النص داخل العنصر */
    .flower-item h3 {
        margin-top: 10px; /* إضافة مسافة بين الصورة والنص */
        font-size: 1.2rem; /* تغيير حجم الخط */
        color: #333; /* لون النص */
    }

    /* التأكد من أن الصورة لا تتخطى حجم العنصر */
    .flower-container a {
        text-decoration: none; /* إزالة التسطير من الرابط */
        color: inherit; /* الحفاظ على لون النص الافتراضي */
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

</style>
  <header>
        <button class="profile-icon" onclick="toggleSidebar()">👤</button>
        <button onclick="window.history.back()" style="background-color: transparent; border: none; color: white; font-size: 20px; cursor: pointer; position: absolute; left: 60px; top: 50%; transform: translateY(-50%);">
            &#8592; back
        </button>
        <img src="logo.jpg" alt="Shop Logo">
        <h1>Rawah Al-Ward By Saja & Barah</h1>
        <a href="Basketpage.php" class="cart">🛒 Cart</a>
    </header>