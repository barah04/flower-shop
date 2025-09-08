<?php
$storeName = "Rawah Al-Ward - By Saja & Baraa";
$welcomeMessage = "Welcome to the most beautiful flower shop in the world!";
$aboutStore = "We offer you the finest flowers with special stories and meanings. We are here to help you choose and customize the most beautiful bouquets for any occasion.";
$loginButtonText = "start";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page1</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-align: center;
            background-image: linear-gradient(to bottom right, #FFE4E1, #FF1493);
            color: #4a4a4a;
            margin: 0;
            padding: 0;
        }
        section {
            padding: 40px;
            background-color: #F7D1C8;
            margin: 30px auto;
            width: 80%;
            max-width: 800px;
            border-radius: 15px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            color: #4a4a4a;
			
        }
        section img {
            width: 300px;
            height: auto;
            margin-bottom: 20px;
            border-radius: 15px;
            overflow: hidden;
        }
        .login-button {
            margin-top: 20px;
            padding: 15px 30px;
            background-color: #FF1493;
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            border-radius: 30px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .login-button:hover {
            background-color: #E21383;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <section>
        <img src="logo.jpg" alt="Rawah Al-Ward Logo">
        <p><?php echo $welcomeMessage; ?></p>
        <p><?php echo $aboutStore; ?></p>
        <a href="page21.php" class="login-button"><?php echo $loginButtonText; ?></a>
    </section>
</body>
</html>
