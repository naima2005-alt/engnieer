<?php
$conn = new mysqli("localhost", "root", "", "architect");

if ($conn->connect_error) {
    die("Connection failed");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO message (name, email, message)
            VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Message sent successfully ✅');</script>";
    } else {
        echo "<script>alert('Error ❌');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>
</head>

<body style="font-family:Arial; background:#f4f4f4; text-align:center;">

    <h1>Contact Us 📩</h1>

    <form method="POST" style="background:white; padding:20px; width:300px; margin:auto; border-radius:10px;">

        <input type="text" name="name" placeholder="Your Name" required
        style="width:100%; padding:10px; margin:10px 0;"><br>

        <input type="email" name="email" placeholder="Your Email" required
        style="width:100%; padding:10px; margin:10px 0;"><br>

        <textarea name="message" placeholder="Your Message" required
        style="width:100%; padding:10px; margin:10px 0;"></textarea><br>

        <button type="submit" style="padding:10px 20px; background:#1e3a8a; color:white; border:none; border-radius:5px;">
            Send
        </button>

    </form>

</body>
</html>