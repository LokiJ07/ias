<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; flex-direction: column; }
        .container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); text-align: center; }
        h2 { color: #333; }
        .logout { margin-top: 20px; padding: 10px 15px; background: #dc3545; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>

    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h2>
        <a class="logout" href="logout.php">Logout</a>
    </div>

</body>
</html>
