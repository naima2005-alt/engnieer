<?php
session_start();

// 1. منع التخزين المؤقت (الحارس الشخصي)
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// 2. القفل: التحقق من تسجيل الدخول
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// 3. الاتصال بقاعدة البيانات
$conn = new mysqli("localhost", "root", "", "architect");

// 4. جلب بيانات المشروع (حل مشكلة Undefined variable)
$project_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$sql = "SELECT * FROM projects WHERE id = $project_id";
$result = $conn->query($sql);
$project = $result->fetch_assoc(); // هذا هو المتغير الذي كان ينقصك

if (!$project) {
    die("Project not found!");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $project['title']; ?> | Project Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600&family=Poppins:wght@300;500&display=swap" rel="stylesheet">
    <style>
        :root { --gold: #d4af37; --bg: #12141d; --card: #1c1f2b; }
        body { background: var(--bg); color: white; font-family: 'Poppins', sans-serif; margin: 0; padding-bottom: 50px; }
        
        .header { text-align: center; padding: 60px 20px; background: linear-gradient(to bottom, var(--card), transparent); }
        .header h1 { font-family: 'Cinzel', serif; color: var(--gold); font-size: 38px; text-transform: uppercase; margin: 0; }
        
        .gallery { display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 30px; padding: 0 8%; }
        .img-box { background: var(--card); border-radius: 15px; overflow: hidden; border: 1px solid rgba(212, 175, 55, 0.1); }
        
        /* توحيد أحجام الصور وحل مشكلة الحمام والحديقة */
        .img-box img { width: 100%; height: 280px; object-fit: cover; display: block; }
        
        .img-title { padding: 20px; color: var(--gold); font-weight: 500; font-size: 14px; text-align: center; text-transform: uppercase; letter-spacing: 2px; border-top: 1px solid rgba(212, 175, 55, 0.1); }

        .back-btn-container { text-align: center; margin-top: 60px; }
        .back-btn { display: inline-block; padding: 12px 35px; color: var(--gold); text-decoration: none; border: 1px solid var(--gold); border-radius: 5px; font-size: 13px; letter-spacing: 2px; text-transform: uppercase; transition: 0.3s; }
        .back-btn:hover { background: var(--gold); color: black; }
    </style>
</head>
<body>

<div class="header">
    <h1><?php echo $project['title']; ?></h1>
    <p style="color: #94a3b8; letter-spacing: 1px; margin-top: 10px;">Detailed Project Overview</p>
</div>

<div class="gallery">
    <div class="img-box">
        <img src="<?php echo $project['img_living_room']; ?>" alt="Living Room">
        <div class="img-title">Luxury Living Room</div>
    </div>

    <div class="img-box">
        <img src="<?php echo $project['img_bedroom']; ?>" alt="Bedroom">
        <div class="img-title">Master Bedroom</div>
    </div>

    <div class="img-box">
        <img src="<?php echo $project['img_kitchen']; ?>" alt="Kitchen">
        <div class="img-title">Modern Kitchen Design</div>
    </div>

    <div class="img-box">
        <img src="<?php echo $project['img_bathroom']; ?>" alt="Bathroom">
        <div class="img-title">Premium Bathroom</div>
    </div>

    <div class="img-box">
        <img src="<?php echo $project['img_garden']; ?>" alt="Garden">
        <div class="img-title">Outdoor Garden & Landscape</div>
    </div>
</div>

<div class="back-btn-container">
    <a href="profile.php?id=<?php echo $project['engineer_id']; ?>" class="back-btn">
        Return to Portfolio
    </a>
</div>

</body>
</html>