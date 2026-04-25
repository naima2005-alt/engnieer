<?php
session_start();
$conn = new mysqli("localhost", "root", "", "mydatabase"); // عدل اسم القاعدة

// تحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// تنفيذ تسجيل الدخول
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // حماية ضد SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php"); // بعد الدخول يروح للوحة التحكم
        exit();
    } else {
        $error = "Username or password incorrect ❌";
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Engineers Connect</title>
    <style>
        body { font-family: Arial; background: #f2f4f7; display: flex; justify-content: center; align-items: center; height: 100vh; }
        form { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px #ccc; width: 300px; }
        input { width: 100%; padding: 10px; margin: 10px 0; }
        button { width: 100%; padding: 10px; background: #1e3a8a; color: white; border: none; border-radius: 5px; cursor: pointer; }
        p.error { color: red; text-align: center; }
    </style>
</head>
<body>
    <form method="POST">
        <h2>Login</h2>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
    </form>
</body>
</html>






