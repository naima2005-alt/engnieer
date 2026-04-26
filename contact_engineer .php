<?php
$conn = new mysqli("localhost", "root", "", "architect");

$id = $_GET['id'];

// نجيبو معلومات المهندس
$engineer = $conn->query("SELECT * FROM engineers WHERE id = $id");
$eng = $engineer->fetch_assoc();

if(isset($_POST['send'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $conn->query("INSERT INTO message(name,email,message) VALUES('$name','$email','$message')");
    echo "<script>alert('Message sent to ".$eng['name']." ✅');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Contact Engineer</title>
</head>

<body style="text-align:center; font-family:Arial;">

<h2>Contact <?php echo $eng['name']; ?> 👷‍♂️</h2>

<form method="POST">
<input type="text" name="name" placeholder="Your Name" required><br><br>
<input type="email" name="email" placeholder="Your Email" required><br><br>
<textarea name="message" placeholder="Your Message"></textarea><br><br>

<button name="send">Send</button>
</form>

</body>
</html>
