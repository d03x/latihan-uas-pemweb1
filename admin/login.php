<?php
session_start();
require('../functions/functions.php');
if (isset($_SESSION['is_login'])) {
    header('location:./index.php');
    die();
}

if (isset($_POST['login'])) {
    $db = db();
    $username = $db->escape_string($_POST['username']);
    $password = $db->escape_string($_POST['password']);


    $query = $db->query("SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1");
    if ($query->num_rows > 0) {
        $_SESSION['is_login'] = true;
        $user = $query->fetch_object();
        echo "<script>alert('Selamat datang {$user->username}');window.location.href='./index.php'</script>";
        die();
    } else {
        echo "<script>alert('Username atau password salah!!');window.location.href='./login.php'</script>";
        die();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div class="login-form">
        <h2>Login</h2>
        <form method="POST" action="">
            <div class="field">
                <label for="username">Username</label>
                <input type="text" name='username' required autocomplete placeholder="Ketikan username Anda">
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input type="password" name='password' required autocomplete placeholder="Ketikan password Anda">
            </div>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>

</html>