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
            background: #f4f4f4;
            margin: 0;
            text-align: center;
        }

        h1 {
            background: #0f172a;
            color: white;
            padding: 20px;
        }

        .container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
        }

        .card {
            background: white;
            width: 250px;
            padding: 15px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 10px;
            cursor: pointer;
        }

        .btn {
            display: block;
            margin: 8px;
            padding: 8px;
            background: #1e3a8a;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn:hover {
            background: #3749a0;
        }

        /* 🔥 POPUP ZOOM */
        #popup {
            display: none;
            position: fixed;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background: rgba(0,0,0,0.8);
            justify-content:center;
            align-items:center;
        }

        #popup img {
            width: 60%;
            border-radius:10px;
        }
    </style>

    <script>
        function openImage(src){
            document.getElementById("popup").style.display = "flex";
            document.getElementById("popup-img").src = src;
        }

        function closeImage(){
            document.getElementById("popup").style.display = "none";
        }
    </script>

</head>

<body>

<h1>Our Engineers 👷‍♂️</h1>

<div class="container">

<?php while($row = $result->fetch_assoc()) { ?>

    <div class="card">

        <!-- صورة مع Zoom -->
        <img src="<?php echo $row['image']; ?>" onclick="openImage(this.src)">

        <h3><?php echo $row['name']; ?></h3>

        <p><?php echo $row['specialty']; ?></p>

        <!-- Profile -->
        <a href="profile.php?id=<?php echo $row['id']; ?>" class="btn">
            View Profile
        </a>

        <!-- Contact -->
        <a href="contact(2).php?id=<?php echo $row['id']; ?>" class="btn">
            Contact 👤
        </a>

    </div>

<?php } ?>

</div>

<!-- 🔥 Popup -->
<div id="popup" onclick="closeImage()">
    <img id="popup-img">
</div>

</body>
</html>
