<?php
session_start(); // بدء الجلسة
$user_name = $_SESSION['first_name'];  // استرجاع اسم المستخدم من الجلسة
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page5(Rose and Daisy)</title>
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
    justify-content: center; /* لضمان توسيط المحتوى */
    align-items: center; /* لضمان توسيط المحتوى عموديًا */
    padding-left: 0px; /* تقليل المسافة على اليسار */
    padding-right: 0px; /* تقليل المسافة على اليمين */
    border-bottom: 4px solid #F5D0D6;
}

header img {
    height: 50px;
    width: auto;
    margin-right: 10px; /* المسافة بين الشعار والنص */
}

header h1 {
    font-size: 1.8em;
    color: #fff;
    margin: 0;
    text-align: center; /* لضمان توسيط النص */
    display: inline-block; /* لضمان عدم تمدد النص داخل المساحة */
}

 .cart {
            font-size: 0.8em;
            color: #fff;
            text-decoration: none;
            background-color: #FF1493;
            padding: 10px;
            border-radius: 20px;
            position: relative;
            top: 3x;
            transition: background-color 0.3s;
			 position: absolute; 
    right: 50px; 

        }

        .cart:hover {
            background-color: #E21383;
        }
        /* تنسيق المنتج */
        .product-container {
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            margin-top: 30px; /* لتفادي تداخل المحتوى مع الشريط العلوي */
        }

        .main-product-image {
            width: 500px;
            max-width: 500px;
            height: 400px;
            object-fit: cover;
        }

        .product-thumbnails {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        .thumbnail {
            width: 80px;
            height: 80px;
            margin: 0 10px;
            object-fit: cover;
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
        }

        .price {
            font-size: 24px;
            font-weight: bold;
            color: #FF69B4;
            margin-top: 20px;
            text-align: left;
            width: 100%;
            padding-left: 80px;
        }

        .product-title {
            text-align: center;
            font-size: 24px;
            color: #333;
            margin-top: 20px;
            font-weight: bold;
        }

        /* تنسيق العدادات */
        .counter {
            font-size: 24px;
            padding: 10px;
            text-align: center;
            margin-top: 20px;
        }

        .counter button {
            font-size: 24px;
            padding: 10px 15px;
            margin: 0 10px;
            border: 2px solid #FF69B4;
            background-color: #fff;
            color: #FF69B4;
            border-radius: 25px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        .counter button:hover {
            background-color: #FF69B4;
            color: white;
            transform: scale(1.1);
        }

        #counterValue {
            font-size: 30px;
            margin: 0 20px;
            font-weight: bold;
        }

        /* تنسيق قسم التوصيل */
        .delivery-container {
            margin-top: 30px;
            padding-left: 20px;
        }

        .delivery-title {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .delivery-select {
            width: 200px;
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #fff;
            color: #333;
            cursor: pointer;
        }

        .delivery-select:focus {
            border-color: #FF69B4;
            outline: none;
        }

        /* تنسيق النص الإضافي */
        p {
            font-size: 20px;
            color: #333;
            margin-top: 20px;
        }

        textarea {
            width: 800px;
            font-size: 18px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }

        h2 {
            font-size: 22px;
            color: #333;
        }

        .checkbox-container {
            font-size: 20px;
            color: #333;
        }

        .checkbox-container input {
            margin-right: 10px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #FF69B4;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #FF1493;
        }

        /* تنسيق العدادات */
        .counter {
            font-size: 24px;
            padding: 10px;
            text-align: left;
            padding-left: 20px;
        }

        button {
            font-size: 20px;
            padding: 10px 15px;
            margin: 5px;
            border: 2px solid #FF69B4;
            background-color: #fff;
            color: #FF69B4;
            border-radius: 25px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        button:hover {
            background-color: #FF69B4;
            color: white;
            transform: scale(1.1);
        }

        #counterValue {
            font-size: 30px;
            margin: 0 20px;
            font-weight: bold;
        }

        .footer-contact {
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #FF69B4;
            text-align: center;
            padding: 1px;
            font-size: 5px;
            color: white;
        }

        .footer-contact button {
            background-color: #fff;
            color: #FF69B4;
            border: 2px solid #FF69B4;
            border-radius: 20px;
            padding: 5px 12px;
            margin: 3px;
            cursor: pointer;
        }

        .footer-contact button:hover {
            background-color: #FF1493;
            color: white;
        }
 /* الرسالة التي تظهر عند إضافة المنتج للسلة */
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
</head>
<body>

  
	<header >
		<button class="profile-icon" onclick="toggleSidebar()">👤</button>
	    <button onclick="window.history.back()" style="background-color: transparent; border: none; color: white; font-size: 20px;
		cursor: pointer; margin-right: 2px; position: absolute; left: 60px; top: 30px; transform: translateY(-50%);">
		<a href="page4(Lily).php"	  &#8592; ><br> back<!-- السهم العكسي --></a>
    </button>
    <?session_start(); // بدء الجلسة?>
        <img src="logo.jpg" alt="Rawah Al-Ward Logo">
        <h1>Rawah Al-Ward - By Saja & Barah</h1>
        <a href="Basketpage.php " 
		class="cart" id="cart">🛒 Cart </a>
    </header>
	
	
<!-- القائمة الجانبية للمستخدم -->
    <div class="sidebar">
        <h3>Welcome  <?php echo htmlspecialchars($user_name); ?></h3>
        <a href="logout.php">Log Out</a>
    </div>
    <!-- المحتوى الرئيسي للمنتج -->
    <h1 class="product-title">Rose and Daisy</h1>
    <div class="product-container">
        <img  id="mainProductImage" src="https://cdn.salla.sa/DAzWg/aebf840e-ad0e-4838-9c91-6d80254f773e-500x500-8gzxAdIirdJfWcw0fGNIvWGIzyN0kTrPpSQ6MGrQ.jpg" 
            alt="صورة المنتج الرئيسية" class="main-product-image">
        <h1 class="product-title">These are more pictures that show the product</h1>
        <div class="product-thumbnails">
            <img src="https://i.pinimg.com/736x/95/56/0e/95560e2d331e482a6855a2c40fb5ca84.jpg" 
                alt="صورة مصغرة 1" class="thumbnail"
				onclick="changeMainImage('https://i.pinimg.com/originals/32/ff/2d/32ff2df41723dfcf061e9002f7a99a33.jpg')">
            <img src="https://juandie.oss-cn-shanghai.aliyuncs.com/images/202212/source_img/1670232671954661120.jpg" 
                alt="صورة مصغرة 2" class="thumbnail"
				onclick="changeMainImage('https://juandie.oss-cn-shanghai.aliyuncs.com/images/202212/source_img/1670232671954661120.jpg')">
            <img src="https://cdn.salla.sa/DAzWg/aebf840e-ad0e-4838-9c91-6d80254f773e-500x500-8gzxAdIirdJfWcw0fGNIvWGIzyN0kTrPpSQ6MGrQ.jpg" 
                alt="صورة مصغرة 3" class="thumbnail"
				onclick="changeMainImage('https://i.pinimg.com/736x/95/56/0e/95560e2d331e482a6855a2c40fb5ca84.jpg')">
        </div>
        <div class="price">$20.00 JOD</div>
    </div>
	
<form action="page5php.php" method="post">
   <input type="hidden" name="bouquet_id" value="1111">
<input type="hidden" name="Boiqiets_Name" value="Rose and Daisy">
    <!-- عداد المنتج -->
    <div class="counter">
        <label>Quantity:</label>
        <button type="button" id="minusButton">-</button>
        <span id="counterValue">1</span>
        <button type="button" id="plusButton">+</button>
    </div>
    <input type="hidden" name="quantity" id="quantityInput" value="1">

    

    <div class="delivery-container">
       <label class="delivery-title">Choose the color of the bouquet:</label>
        <select class="delivery-select" name="color">
            <option value="red">Red</option>
            <option value="white">White</option>
            <option value="pink">Pink</option>
        </select>
    </div> 
	
  <h2>Add Extra items:</h2>
        <div class="checkbox-container">
            <input type="checkbox" value="Add 10 flower more + 5JOD" name="addition[]" id=1231> Add 10 flower more + 5JOD <br> 
            <input type="checkbox" value="teddy bear + 10JOD"name="addition[]" id=1232> Teddy bear + 10JOD <br> 
            <input type="checkbox" value="chocolate + 25JOD" name="addition[]"id=1233> Chocolate + 25JOD <br>
        </div>

        <p style="font-size: 25px;">Message on card:</p>
        <textarea rows="6" name="message" placeholder="Enter your message..."></textarea>  

        <p><button type="submit" onclick="showSuccessMessage()">Add to cart</button></p>
</form>
<div class="success-message" id="successMessage">Product added to cart successfully!</div>
<script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
        }
    </script>
 <script>
        document.getElementById("plusButton").addEventListener("click", function() {
            let counter = document.getElementById("counterValue");
            let quantityInput = document.getElementById("quantityInput");
            let quantity = parseInt(counter.textContent);
            quantity++;
            counter.textContent = quantity;
            quantityInput.value = quantity;
        });

        document.getElementById("minusButton").addEventListener("click", function() {
            let counter = document.getElementById("counterValue");
            let quantityInput = document.getElementById("quantityInput");
            let quantity = parseInt(counter.textContent);
            if (quantity > 1) {
                quantity--;
                counter.textContent = quantity;
                quantityInput.value = quantity;
            }
        });

        function changeMainImage(imageUrl) {
            document.getElementById("mainProductImage").src = imageUrl;
        }

        function showSuccessMessage() {
            document.getElementById("successMessage").style.display = "block";
            setTimeout(function() {
                document.getElementById("successMessage").style.display = "none";
            }, 3000); // Hide message after 3 seconds
        }
    </script>

		


	 <p style="font-size: 30px;"> <strong style="color: #FF69B4;"> DESCRIPTION</strong> </p> 
		<p style="font-size: 20px;">
         <strong style="color: #FF69B4;">  Rose:</strong> One of the most popular flowers in the world of flowers,<br>
		   it represents beauty and love. Rose is known for being a romantic flower.<br>
		   Rose is considered a symbol of love and passion.<br>
        <ol>
        <li> <strong style="color: #FF69B4;"> Red roses </strong>symbolize deep love and passion.</li>
        <li> <strong style="color: #FF69B4;">Pink roses</strong>  express gratitude and appreciation.</li>
        <li> <strong style="color: #FF69B4;"> White roses </strong>  signify purity and modesty.</li>
		 </ol>
       <br>
            <strong style="color: #FF69B4;"> Daisy:</strong> Chamomile is a flower characterized by its simple and bright shape,<br>
		 consisting of white petals surrounding a yellow center.<br>
		 Chamomile is considered a symbol of purity, innocence, and renewal.<br>
		 Chamomile is considered a symbol of friendship and goodwill.<br>
       <br>
          <strong style="color: #FF69B4;">Rose and Daisy Combination: </strong><br>
       <br>
         When roses and chamomile are combined in one arrangement,<br>
		 they create a perfect balance between passion and innocence.<br>
		 While roses express strong love and passion, chamomile reflects innocence and calm,<br>
		 creating harmony between emotional feelings and inner balance.<br>
		 The combination of these two flowers shows a pure and innocent love, <br>
		 and an ability to appreciate beauty in its simplest forms..</p> 
        


	
	<p> <br><br><br>
	<strong style="font-size: 30px;color: #FF69B4; "> Terms and Conditions :</strong> <br>
Delivery Times :<br><br>

We currently offer delivery 7 days a week, and most public holidays.<br>

Standard Delivery <br> <br>

Orders placed by 2pm can be delivered on the same day to Amman and surrounding suburbs.<br><br>

Please note some distant suburbs cut off earlier in the day.<br>
We are always working hard towards expanding our range of suburbs that cut off at 2pm, <br> 
please check back for updates..<br> <br> 

Weekends<br> <br>
Orders placed by 1pm can be delivered on the same day (Friday and Saturday).<br>
	</p>
	
	
	

    <!-- شريط التواصل الثابت أسفل الصفحة -->
    <div class="footer-contact">
	 <p>Thank you for visiting us!</p>
        <button onclick="window.location.href='smslink://'">SMS</button>
        <button onclick="window.location.href='tel:+123456789'">Call Now</button>
    </div>

</body>
</html>







