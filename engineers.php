<?php
// 1. إجبار المتصفح على مسح الجلسة فور إغلاق النافذة
ini_set('session.cookie_lifetime', 0);
session_start();

// 2. القفل: إذا لم يسجل دخول، ارجعه لصفحة اللوجن
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// 3. الاتصال بقاعدة البيانات (تأكدي من المعلومات)
$conn = new mysqli("localhost", "root", "", "architect");

// 4. إصلاح خطأ السطر 233: جلب البيانات قبل عرضها
$result = $conn->query("SELECT * FROM engineers"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elite Architects | Premium Portfolio</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600&family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        :root {
            --gold: #d4af37;
            --gold-gradient: linear-gradient(135deg, #d4af37 0%, #f1d27b 50%, #996515 100%);
            /* تغيير الخلفية إلى رمادي فحمي مائل للأزرق العميق */
            --bg-color: #12141d; 
            --card-bg: #1c1f2b;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }

        body {
            background-color: var(--bg-color);
            color: #ffffff;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* إضافة لمسة فنية في الخلفية (Gradient Blobs) */
        body::before {
            content: '';
            position: fixed;
            top: -10%;
            right: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.05) 0%, transparent 70%);
            z-index: -1;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 25px 8%;
            background: rgba(28, 31, 43, 0.8);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(212, 175, 55, 0.15);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            font-family: 'Cinzel', serif;
            font-size: 24px;
            color: var(--gold);
            letter-spacing: 3px;
        }

        .logout-btn {
            color: #ff5f5f;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            border: 1.5px solid #ff5f5f;
            padding: 8px 20px;
            border-radius: 5px;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background: #ff5f5f;
            color: white;
            box-shadow: 0 0 15px rgba(255, 95, 95, 0.4);
        }

        .hero-text {
            text-align: center;
            padding: 80px 20px 60px;
        }

        .hero-text h1 {
            font-family: 'Cinzel', serif;
            font-size: 50px;
            margin-bottom: 10px;
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-text p {
            color: #94a3b8;
            letter-spacing: 4px;
            text-transform: uppercase;
            font-size: 13px;
        }

        .container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 40px;
            padding: 0 8% 80px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .engineer-card {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 40px 30px;
            text-align: center;
            border: 1px solid rgba(212, 175, 55, 0.1);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .engineer-card::after {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(180deg, transparent 0%, rgba(212, 175, 55, 0.05) 100%);
            opacity: 0;
            transition: 0.4s;
        }

        .engineer-card:hover {
            transform: translateY(-15px);
            border-color: var(--gold);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .engineer-card:hover::after { opacity: 1; }

        .img-frame {
            width: 150px;
            height: 150px;
            margin: 0 auto 30px;
            border-radius: 50%;
            padding: 5px;
            background: var(--gold-gradient);
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
        }

        .img-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid var(--card-bg);
        }

        .name {
            font-family: 'Cinzel', serif;
            font-size: 26px;
            margin-bottom: 8px;
            color: #ffffff;
        }

        .specialty {
            color: var(--gold);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            display: block;
            margin-bottom: 25px;
        }

        .contact-info {
            color: #94a3b8;
            font-size: 13px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .view-btn {
            margin-top: 30px;
            width: 100%;
            padding: 14px;
            background: var(--gold-gradient);
            border: none;
            border-radius: 5px;
            color: #000;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: 0.3s;
            position: relative;
            z-index: 2;
        }

        .view-btn:hover {
            background: #ffffff;
            transform: scale(1.02);
        }

        /* تصميم الـ Scrollbar ليناسب الألوان */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--bg-color); }
        ::-webkit-scrollbar-thumb { background: var(--gold); border-radius: 10px; }
    </style>
</head>
<body>

<nav>
    <div class="logo">ELITE<span>ARCH</span></div>
    <a href="logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> LOGOUT</a>
</nav>

<div class="hero-text">
    <h1>Our Visionaries</h1>
    <p>Premium Architectural Solutions</p>
</div>
<div class="container">
    <?php while($row = $result->fetch_assoc()): ?>
    <div class="engineer-card">
        <!-- صورة المهندس -->
        <div class="img-frame">
            <img src="<?php echo !empty($row['image']) ? $row['image'] : 'https://ui-avatars.com/api/?name='.urlencode($row['name']).'&background=d4af37&color=000'; ?>" alt="Architect">
        </div>
        
        <!-- معلومات المهندس -->
        <h3 class="name"><?php echo $row['name']; ?></h3>
        <span class="specialty"><?php echo $row['specialty']; ?></span>
        
        <div class="contact-info"><i class="far fa-envelope"></i> <?php echo $row['email']; ?></div>
        <div class="contact-info"><i class="fas fa-map-marker-alt"></i> <?php echo $row['location']; ?></div>

        <!-- الأزرار بأسلوب الكود القديم لضمان الظهور -->
        <div class="card-actions" style="margin-top: 20px; position: relative; z-index: 9999;">
    
    <!-- زر البروفايل -->
    <button type="button" 
            onclick="window.location.href='profile.php?id=<?php echo $row['id']; ?>'" 
            class="view-btn" 
            style="width: 100%; margin-bottom: 10px; cursor: pointer;">
        EXPLORE PORTFOLIO
    </button>
    
    <!-- زر التواصل المطور بنظام النقر المباشر -->
    <button type="button" 
            onclick="window.location.href='contact_engineer.php?id=<?php echo $row['id']; ?>'"
            style="width: 100%; padding: 12px; background: transparent; border: 2px solid #d4af37; color: #d4af37; border-radius: 5px; cursor: pointer; font-weight: bold; text-transform: uppercase;">
        <i class="fas fa-paper-plane"></i> CONTACT ME
    </button>

</div>
    </div> 
    <?php endwhile; ?>
</div>
</body>
</html>
