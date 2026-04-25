<?php
$conn = new mysqli("localhost", "root", "", "architect");

if ($conn->connect_error) {
    die("Connection failed");
}

$result = $conn->query("SELECT * FROM engineers");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Engineers</title>

    <style>
        body {
            font-family: Arial;
            text-align: center;
            background: #f4f4f4;
        }

        .container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 15px;
            width: 250px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 10px;
        }

        .btn {
            display: block;
            margin-top: 15px;
            padding: 10px;
            background: #1e3a8a;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }
    </style>
</head>

<body>

<h1>Our Engineers 👷‍♂️</h1>

<div class="container">

<?php while($row = $result->fetch_assoc()) { ?>

    <div class="card">

        <img src="<?php echo $row['image']; ?>" alt="engineer">

        <h3><?php echo $row['name']; ?></h3>

        <p><?php echo $row['specialty']; ?></p>

        <p><?php echo $row['email']; ?></p>

        <!-- 🔥 زر واضح -->
        <a href="profile.php?id=<?php echo $row['id']; ?>" class="btn">
            View Profile
        </a>

    </div>

<?php } ?>

</div>

</body>
</html>
