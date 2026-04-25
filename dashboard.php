<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #f4f4f4;
        }

        header {
            background: #0f172a;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .container {
            padding: 40px;
            text-align: center;
        }

        .card {
            background: white;
            display: inline-block;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .card h2 {
            margin-bottom: 10px;
        }

        .card p {
            color: #555;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #1e3a8a;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }

        .btn:hover {
            background: #0f172a;
        }
    </style>

</head>

<body>

<header>
    <h1>Dashboard</h1>
</header>

<div class="container">

    <div class="card">
        <h2>Welcome 🎉</h2>

        <p>You are logged in as:</p>

        <h3><?php echo $_SESSION['email']; ?></h3>

        <a class="btn" href="logout.php">Logout</a>
    </div>

</div>

</body>
</html>