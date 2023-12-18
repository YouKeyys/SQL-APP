<?php
include 'connection.php';

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Create connection
    $conn = new mysqli('localhost', 'root', '', 'banking_system');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // what's added Before Vulnerable -start-
    // Prepare and bind parameters to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM Users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);

    // Execute the prepared statement
    $stmt->execute();
    $result = $stmt->get_result();
    // -end-

    
    $sql = "SELECT * FROM Users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Start the session
        session_start();
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
    } else {
        echo "<script>alert('Invalid username or password');</script>";
    }

    // added before vulnerable
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            width: 400px;
            padding: 40px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .input-field {
            margin-bottom: 20px;
        }

        .input-field input[type=text], .input-field input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .input-field input[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        .input-field input[type=submit]:hover {
            background-color: #45a049;
        }

        .github-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #333;
            color: white;
            width: 100%;
            padding: 12px 20px;
            border: none;
            cursor: pointer;
        }

        .github-icon i {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <h2>Login</h2>
            <form method="post" action="login.php">
                <div class="input-field">
                    <input type="text" name="username" placeholder="Username">
                </div>
                <div class="input-field">
                    <input type="password" name="password" placeholder="Password">
                </div>
                <div class="input-field">
                    <input type="submit" name="login" value="Login">
                </div>
                <div class="input-field">
                    <button class="github-icon">
                        <i class="fa fa-github" aria-hidden="true"></i>
                        Login with GitHub
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

