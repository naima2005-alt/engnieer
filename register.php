<?php

$conn = new mysqli("localhost","root","","architect");
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT INTO users (email, password) VALUES ('$email', '$hashed_password')";
if ($conn->connect_error) {
    die("Connection failed");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (email,password) VALUES ('$email','$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Account created successfully ✅";
    } else {
        echo "Error: " . $conn->error;
    }
}

?>