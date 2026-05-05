<?php
$conn = new mysqli("localhost", "root", "", "architect");

// التأكد من وجود ID المهندس
if(!isset($_GET['id'])){
    header("Location: engineers.php");
    exit();
}

$id = $_GET['id'];

// جلب معلومات المهندس
$engineer = $conn->query("SELECT * FROM engineers WHERE id = $id");
$eng = $engineer->fetch_assoc();

if(isset($_POST['send'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    
    // تعديل الاستعلام ليشمل ID المهندس (لتعرفي لمن الرسالة)
    // ملاحظة: تأكدي من وجود عمود engineer_id في جدول message
    $sql = "INSERT INTO message (engineer_id, name, email, message) 
        VALUES ('$id', '$name', '$email', '$message')";
    
    if($conn->query($sql)){
        echo "<script>alert('Message sent successfully to Architect " . $eng['name'] . " ✅'); window.location.href='engineers.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact <?php echo $eng['name']; ?></title>
    <style>
        body { background-color: #12141d; color: white; font-family: 'Poppins', sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .contact-box { background: #1c1f2b; padding: 40px; border-radius: 15px; border: 1px solid #d4af37; width: 400px; text-align: center; }
        h2 { color: #d4af37; margin-bottom: 20px; font-family: 'Cinzel', serif; }
        input, textarea { width: 100%; padding: 12px; margin-bottom: 15px; border-radius: 5px; border: 1px solid #333; background: #000; color: white; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: linear-gradient(135deg, #d4af37, #996515); border: none; border-radius: 5px; color: black; font-weight: bold; cursor: pointer; transition: 0.3s; }
        button:hover { transform: scale(1.02); background: white; }
        .back-link { display: block; margin-top: 15px; color: #94a3b8; text-decoration: none; font-size: 13px; }
    </style>
</head>
<body>

<div class="contact-box">
    <h2>Contact <?php echo $eng['name']; ?></h2>
    <p style="color: #94a3b8; font-size: 14px; margin-bottom: 20px;">Send a proposal or inquiry</p>
    
    <form method="POST">
        <input type="text" name="name" placeholder="Your Full Name" required>
        <input type="email" name="email" placeholder="Your Email Address" required>
        <textarea name="message" rows="5" placeholder="Write your message here..." required></textarea>
        <button type="submit" name="send">Send Message</button>
    </form>
    
    <a href="engineers.php" class="back-link">← Back to Architects</a>
</div>

</body>
</html>
