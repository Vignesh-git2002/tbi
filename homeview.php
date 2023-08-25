
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            width: 300px;
            margin: 0 auto;
            margin-top: 100px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            text-align: center;
        }

        .container form {
            margin-top: 20px;
        }

        .container form label {
            display: block;
            margin-bottom: 8px;
        }

        .container form input[type="text"],
        .container form input[type="password"] {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .container form input[type="submit"] {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: none;
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
        }

        .container form input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <br><br><br><div class="container">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required><br><br>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required><br><br>

            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
