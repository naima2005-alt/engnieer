<?php
// 1. يجب أن يكون هذا في أول السطر لتفعيل خاصية "النسيان عند الإغلاق"
ini_set('session.cookie_lifetime', 0); 
session_start();

// --- كود الاتصال بقاعدة البيانات ---
$conn = new mysqli("localhost", "root", "", "architect");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // --- كود التأكد من قاعدة البيانات (SQL Query) ---
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // !!! هنا تضعين السطر الذي سألتِ عنه !!!
        // هذا السطر يعني: "خلاص، المستخدم مسموح له بالدخول"
        $_SESSION['user_id'] = $email; 

        // توجيهه للصفحة الرئيسية
        header("Location: index.php");
        exit();
    } else {
        echo "الايميل أو كلمة السر خطأ";
    }
}
?>





