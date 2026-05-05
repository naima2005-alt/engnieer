<?php
// الاتصال بقاعدة البيانات
$conn = new mysqli("localhost", "root", "", "architect");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استلام البيانات من الحقول باستخدام الـ name
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // إدخال البيانات (تأكدي أن اسم الجدول users)
    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        // إذا نجح التسجيل، نرسله لصفحة تسجيل الدخول
        echo "<script>alert('Account created successfully!'); window.location.href='login.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>