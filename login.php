<?php
session_start();
require_once "config.php";

if (isset($_SESSION['username'])) {
    //Already Logged in redirection
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

        if ($username === '' || $password === '') {
            $error = "Please Fill Out All Fields.";
            
        } else {
            //Find the User in DB
            $stmt = $pdo->prepare("SELECT username, password FROM users WHERE username = :uname");
        $stmt->execute(['uname' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Success
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
            exit;
        } else {
            $error = "Invalid username or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
    <h1>Login</h1>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="post" action="">
        <label>Username:
            <input type="text" name="username" required />
        </label><br><br>

        <label>Password:
            <input type="password" name="password" required />
        </label><br><br>

        <input type="submit" value="Login" />
    </form>
</body>
</html>