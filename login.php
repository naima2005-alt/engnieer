<?php
session_start();

$conn = new mysqli("localhost","root","","architect");

if ($conn->connect_error) {
    die("Connection failed");
}

// باش نعرفو واش راه صاري
echo "PAGE WORKING <br>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    echo "FORM SENT <br>";

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        session_start();

      $_SESSION['email'] = $email;

     header("Location: dashboard.php");
exit();
    } else {
        echo "Email or Password incorrect";
    }
}
?>






