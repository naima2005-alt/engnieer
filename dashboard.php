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
</head>

<body style="font-family:Arial; text-align:center; background:#f4f4f4;">

    <div style="background:#0f172a; color:white; padding:20px;">
        <h1>Architect Dashboard</h1>
    </div>

    <div style="margin-top:50px;">
        <h2>Welcome 🎉</h2>
        <p>You are logged in as:</p>
        <h3><?php echo $_SESSION['email']; ?></h3>

        <br><br>

        <a href="index.html">
            <button>🏠 Home</button>
        </a>

        <a href="logout.php">
            <button>🚪 Logout</button>
        </a>
    </div>

</body>
</html>