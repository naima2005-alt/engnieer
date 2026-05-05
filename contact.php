<?php
$conn = new mysqli("localhost", "root", "", "architect");

if ($conn->connect_error) {
    die("Connection failed");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO message (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Message sent successfully! ✅');
                window.location.href='contact.html';
              </script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
