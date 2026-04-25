<?php
$conn = new mysqli("localhost", "root", "", "architect");

$id = $_GET['id'];

$project = $conn->query("SELECT * FROM projects WHERE id = $id");
$p = $project->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Project Details</title>

    <style>
        body {
            font-family: 'Segoe UI';
            background: #f4f6f9;
            margin: 0;
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);

            animation: fadeIn 1s ease-in-out;
        }

        img {
            width: 100%;
            border-radius: 10px;
        }

        h1 {
            margin-top: 20px;
        }

        p {
            color: #555;
            font-size: 16px;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #1e3a8a;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }

        /* 🔥 Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

<div class="container">

    <img src="<?php echo $p['image']; ?>">

    <h1><?php echo $p['title']; ?></h1>

    <p><?php echo $p['description']; ?></p>

    <a href="engineers.php" class="btn">⬅ Back</a>

</div>

</body>
</html>