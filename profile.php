<?php
$conn = new mysqli("localhost", "root", "", "architect");

if ($conn->connect_error) {
    die("Connection failed");
}

// نجيبو id من الرابط
$id = $_GET['id'];

// معلومات المهندس
$engineer = $conn->query("SELECT * FROM engineers WHERE id = $id");
$eng = $engineer->fetch_assoc();

// المشاريع الخاصة بهذا المهندس فقط
$projects = $conn->query("SELECT * FROM projects WHERE engineer_id = $id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Engineer Profile</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            text-align: center;
        }

        .card {
            background: white;
            width: 350px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .card img {
            width: 120px;
            border-radius: 50%;
        }

        .projects {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }

        .project {
            background: white;
            width: 250px;
            padding: 15px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .project img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }

        .btn {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 15px;
            background: #1e3a8a;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>

<!-- معلومات المهندس -->
<div class="card">

    <img src="<?php echo $eng['image']; ?>">

    <h2><?php echo $eng['name']; ?></h2>

    <p><?php echo $eng['specialty']; ?></p>

    <p><?php echo $eng['email']; ?></p>

    <!-- زر Contact خاص بالمهندس -->
    <a href="contact_engineer.php?id=<?php echo $eng['id']; ?>" class="btn">
        Contact 👤
    </a>

</div>

<h2>Projects 🏗️</h2>

<div class="projects">

<?php
// إذا ما كاش مشاريع
if($projects->num_rows == 0){
    echo "<p>No projects for this engineer ❌</p>";
}
?>

<?php while($p = $projects->fetch_assoc()) { ?>

    <div class="project">

        <img src="<?php echo $p['image']; ?>">

        <h3><?php echo $p['title']; ?></h3>

        <p><?php echo $p['description']; ?></p>

        <a href="project.php?id=<?php echo $p['id']; ?>" class="btn">
            View Details
        </a>

    </div>

<?php } ?>

</div>

</body>
</html>