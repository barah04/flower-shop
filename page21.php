<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rawah Al-Ward - Login / Register</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #FFFFFF;
            margin: 0;
            padding: 0;
        }
        header {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background-color: #FF80CC;
            border-bottom: 4px solid #F5D0D6;
        }
        header img {
            width: 120px;
            height: auto;
            margin-right: 15px;
        }
        header h1 {
            font-size: 1.8em;
            color: #fff;
            font-family: 'Georgia', serif;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
        }
        .login-container {
            max-width: 400px;
            width: 90%;
            margin: 50px auto;
            padding: 20px;
            background-color: #FFFFFF;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }
        .login-container h2 {
            text-align: center;
            color: #4a4a4a;
        }
        .login-container input {
            width: 95%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 2px solid #FF80CC;
            font-size: 1em;
        }
        .login-container input:focus {
            border-color: #E21383;
            outline: none;
        }
        .login-container button {
            width:  165px;
            padding: 10px;
            background-color: #FF80CC;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            transition: 0.3s;
        }
        .login-container button:hover {
            background-color: #E21383;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
        .button-link {
            display: inline-block;
            padding: 10px 60px;
            font-size: 16px;
            color: white;
            background-color: #FF80CC;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .button-link:hover {
            background-color: #E21383;
        }
        /* إضافة مسافة بين الأزرار */
        .spacer {
            margin-top: 20px;
        }
        /* جعل الصفحة تستجيب لجميع الأجهزة */
        @media (max-width: 600px) {
            header h1 {
                font-size: 1.4em;
            }
        }
		        .error-message {
            color: red;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <button onclick="window.history.back()" style="background-color: transparent; border: none; color: white; font-size: 20px; cursor: pointer; margin-right: 20px;">
            &#8592; Back
        </button>
        <img src="logo.jpg" alt="Rawah Al-Ward Logo">
        <h1>Rawah Al-Ward</h1>
    </header>


    <?php

    if (isset($_SESSION['error_message'])) {
        echo '<div class="error-message">' . $_SESSION['error_message'] . '</div>';
        unset($_SESSION['error_message']); // مسح الرسالة بعد عرضها
    }
    ?>	
	
    <!-- نموذج تسجيل الدخول -->
    <div class="login-container">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <input type="email" name="UserEmail" placeholder="UserEmail" required>
            <input type="password" name="password" placeholder="Password" required>
            <div class="container">
         <button type="submit" name="login">Login</button>
            </div>
        </form>

        <!-- إضافة مسافة بين الأزرار -->
        <div class="spacer"></div>

        <!-- رابط للتسجيل كمستخدم جديد -->
        <div class="container">
            <a href="page22.php" class="button-link">sign in</a>
        </div>
    </div>
</body>
</html>

