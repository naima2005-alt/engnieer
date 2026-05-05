<?php
session_start();

// 1. منع التخزين المؤقت لضمان عمل القفل
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

// 4. جلب بيانات المهندس والمشاريع (هذا الجزء هو حل المشكلة)
$eng_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// جلب بيانات المهندس للعنوان والصورة الشخصية
$eng_sql = "SELECT * FROM engineers WHERE id = $eng_id";
$eng_res = $conn->query($eng_sql);
$engineer = $eng_res->fetch_assoc();

// جلب مشاريع هذا المهندس لعرضها في Masterpieces
$proj_sql = "SELECT * FROM projects WHERE engineer_id = $eng_id";
$projects = $conn->query($proj_sql);

if (!$engineer) {
    die("Engineer not found!");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $engineer['name']; ?> | Portfolio</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600&family=Poppins:wght@300;500&display=swap" rel="stylesheet">
    <style>
        :root { --gold: #d4af37; --bg: #12141d; --card: #1c1f2b; }
        body { background: var(--bg); color: white; font-family: 'Poppins', sans-serif; margin: 0; }
        .profile-header { text-align: center; padding: 50px; background: var(--card); border-bottom: 2px solid var(--gold); }
        .profile-header img { width: 130px; height: 130px; border-radius: 50%; border: 3px solid var(--gold); object-fit: cover; }
        .section-title { text-align: center; margin: 50px 0; font-family: 'Cinzel', serif; color: var(--gold); letter-spacing: 3px; font-size: 28px; }
        .projects-container { display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 30px; padding: 0 10%; }
        .project-card { background: var(--card); border-radius: 15px; overflow: hidden; border: 1px solid rgba(212, 175, 55, 0.1); transition: 0.3s; }
        .project-card:hover { border-color: var(--gold); transform: translateY(-5px); }
        .project-card img { width: 100%; height: 250px; object-fit: cover; }
        .project-info { padding: 20px; }
        .project-info h3 { color: var(--gold); margin: 0 0 10px 0; font-family: 'Cinzel', serif; font-size: 18px; }
        .view-link { color: white; text-decoration: none; font-size: 12px; border-bottom: 1px solid var(--gold); padding-bottom: 2px; }
    </style>
</head>
<body>

<div class="profile-header">
    <img src="<?php echo $engineer['image']; ?>" alt="Engineer">
    <h2 style="font-family: 'Cinzel'; color: var(--gold); margin-top: 15px;"><?php echo $engineer['name']; ?></h2>
    <p style="letter-spacing: 1px; color: #ccc;"><?php echo $engineer['specialty']; ?></p>
</div>

<h2 class="section-title">MASTERPIECES</h2>

<div class="projects-container">
    <?php if ($projects && $projects->num_rows > 0): ?>
        <?php while($p = $projects->fetch_assoc()): ?>
        <div class="project-card">
            <img src="<?php echo $p['image']; ?>" alt="Project">
            <div class="project-info">
                <h3><?php echo $p['title']; ?></h3>
                <p style="color: #888; font-size: 13px; line-height: 1.6;"><?php echo $p['description']; ?></p>
                <a href="project.php?id=<?php echo $p['id']; ?>" class="view-link">VIEW PROJECT DETAILS →</a>
            </div>
        </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p style="text-align: center; grid-column: 1/-1; color: #666;">No projects found for this engineer.</p>
    <?php endif; ?>
</div>

<div style="text-align: center; padding: 60px;">
    <a href="engineers.php" style="color: var(--gold); text-decoration: none; font-size: 14px; letter-spacing: 1px;">← BACK TO ENGINEERS</a>
</div>

</body>
</html>