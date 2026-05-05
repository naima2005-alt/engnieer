<?php
session_start();
session_unset();
session_destroy(); // تدمير الجلسة تماماً
header("Location: login.html"); // العودة لصفحة الدخول
exit();
?>