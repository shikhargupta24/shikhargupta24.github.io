<?php
// register.php
session_start();
require_once "config.php";

if (isset($_SESSION['username'])) {
    // If user is already logged in, redirect to index.php (or wherever)
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm  = trim($_POST['confirm'] ?? '');

    if ($username === '' || $password === '' || $confirm === '') {
        $error = "Please fill in all fields.";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match.";
    } elseif (strlen($password) < 10) {
        $error = "Password must be at least 10 characters long.";
    } else {
        // Check if username already exists
        $stmt = $pdo->prepare("SELECT username FROM users WHERE username = :uname");
        $stmt->execute(['uname' => $username]);
        $existing = $stmt->fetch();

        if ($existing) {
            $error = "Username already taken. Please choose another one.";
        } else {
            // Hash and salt the password
            $hashedPass = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user into DB
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:uname, :pword)");
            $stmt->execute(['uname' => $username, 'pword' => $hashedPass]);

            // Log them in automatically
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Register</title></head>
<body>
    <h1>Register</h1>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="post" action="">
        <label>Username:
            <input type="text" name="username" required />
        </label><br><br>

        <label>Password (min 10 chars):
            <input type="password" name="password" required />
        </label><br><br>

        <label>Confirm Password:
            <input type="password" name="confirm" required />
        </label><br><br>

        <input type="submit" value="Register" />
    </form>
</body>
</html>

