<?php
require __DIR__ . '/includes/auth.php';
if (is_logged_in()) { header('Location: dashboard.php'); exit; }

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_valid($_POST['csrf'] ?? '')) {
        $error = 'Sesi formulir tidak valid. Silakan coba lagi.';
    } else {
        require __DIR__ . '/db.php';
        $username = trim((string)($_POST['username'] ?? ''));
        $password = (string)($_POST['password'] ?? '');
        $s = $pdo->prepare('SELECT id, username, password_hash FROM users WHERE username = ?');
        $s->execute([$username]);
        $user = $s->fetch();
        if ($user && password_verify($password, $user['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = (int)$user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: dashboard.php');
            exit;
        }
        usleep(400000); // perlambat percobaan tebak password
        $error = 'Username atau password salah.';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-body">
    <div class="login-box">
        <div class="sidebar-header">Admin Page</div>
        <form method="post" action="login.php" class="login-form" autocomplete="off">
            <?php if ($error): ?><div class="alert alert-error" style="display:block"><?= e($error) ?></div><?php endif; ?>
            <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
            <div class="form-group">
                <label for="username" class="form-label">Username:</label>
                <input type="text" id="username" name="username" class="form-input" required autofocus>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-input" required>
            </div>
            <button type="submit" class="btn btn-success" style="width:100%">Login</button>
        </form>
    </div>
</body>
</html>
