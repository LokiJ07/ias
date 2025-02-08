<?php
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // 🚨 **Vulnerable Simulation - SQL Injection Always Works**
    if (str_contains($username, "'") || str_contains($username, "OR")) {
        $_SESSION["username"] = "Hacked Admin";
        header("Location: dashboard.php");
        exit();
    }

    // ✅ **Normal User Login**
    $users = [
        ["username" => "admin", "password" => "admin123"],
        ["username" => "user", "password" => "password"]
    ];

    foreach ($users as $user) {
        if ($user["username"] === $username && $user["password"] === $password) {
            $_SESSION["username"] = $username;
            header("Location: dashboard.php");
            exit();
        }
    }

    $message = "<p class='error'>Login Failed</p>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>SQL Injection Demo</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; flex-direction: column; }
        .container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); width: 300px; text-align: center; }
        input { width: 90%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; }
        input[type="submit"] { background: #28a745; color: white; border: none; cursor: pointer; font-size: 16px; }
        .error { color: red; font-weight: bold; }
        .sql-hint { background: #ffebcd; padding: 10px; border-radius: 5px; margin-top: 15px; }
    </style>
</head>
<body>

    <div class="container">
        <h2>Login (Vulnerable)</h2>
        <form method="POST">
            <label>Username:</label>
            <input type="text" name="username" required><br>
            <label>Password:</label>
            <input type="password" name="password"><br>
            <input type="submit" value="Login">
        </form>

        <?php echo $message; ?>

        <div class="sql-hint">
            <h3>Try SQL Injection:</h3>
            <p><b>Username:</b> <code>admin' OR '1'='1</code><br>
               <b>Password:</b> (leave blank)</p>
        </div>
    </div>

</body>
</html>
