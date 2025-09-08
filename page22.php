<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rawah Al-Ward - Register</title>
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
        .registration-container {
            max-width: 400px;
            width: 90%;
            margin: 50px auto;
            padding: 20px;
            background-color: #FFFFFF;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }
        .registration-container h2 {
            text-align: center;
            color: #4a4a4a;
        }
        .registration-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 2px solid #FF80CC;
            font-size: 1em;
        }
        .registration-container button {
            width: 100%;
            padding: 10px;
            background-color: #FF80CC;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            transition: 0.3s;
        }
        .registration-container button:hover {
            background-color: #E21383;
        }
        .gender-options {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }
        .gender-options input {
            margin-right: 10px;
        }
        .gender-options label {
            display: inline-block;
            margin-right: 15px;
            font-size: 1em;
            color: #4a4a4a;
            cursor: pointer;
        }
        /* جعل الصفحة تستجيب لجميع الأجهزة */
        @media (max-width: 600px) {
            header h1 {
                font-size: 1.4em;
            }
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

    <div class="registration-container">
        <h2>Register as New User</h2>
		
		
     <form action="register.php" method="post">
            <input type="text" name="first_name" placeholder="First Name" required>
            <input type="text" name="last_name" placeholder="Last Name" required>
            <input type="tel" name="numberphone" placeholder="your phone number " required
             pattern="^\+?[0-9]{10,15}$" >
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <input type="date" name="dob" placeholder="Date of Birth" required>
            
            <!-- Gender radio buttons -->
            <div class="gender-options">
                <input type="radio" id="gender_male" name="gender" value="male">
                <label for="gender_male">Male</label>
                
                <input type="radio" id="gender_female" name="gender" value="female">
                <label for="gender_female">Female</label>
            </div>

            <div class="container">
				    <button type="submit" name="register">Register</button>

            </div>
        </form>
    </div>
</body>
</html>
