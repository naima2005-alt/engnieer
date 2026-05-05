<?php
// تفعيل عرض الأخطاء لمعرفة السبب الحقيقي
ini_set('display_errors', 1);
error_reporting(E_ALL);

ini_set('session.cookie_lifetime', 0);
session_start();

// الاتصال بقاعدة البيانات
$conn = new mysqli("localhost", "root", "", "architect");

// التأكد من الاتصال
if ($conn->connect_error) {
    die("خطأ في الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // فحص الجدول (تأكدي أن اسم الجدول 'users' واسم الأعمدة 'email' و 'password')
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // نجاح الدخول
        $_SESSION['user_id'] = "yes";
        header("Location: engineers.php");
        exit();
    } else {
        // فشل الدخول - سيظهر تنبيه يخبرك بالسبب
        echo "<script>
                alert('فشل الدخول! تأكدي من أن الايميل والباسورد صحيحان في جدول users');
                window.location.href='login.html';
              </script>";
    }
}
?>