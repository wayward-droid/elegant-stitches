<?php require dirname(__DIR__) . '/config.php';
require dirname(__DIR__) . '/includes/functions.php';
$token = $_GET['token'] ?? $_POST['token'] ?? '';
$tokenHash = hash('sha256', $token);
$stmt = mysqli_prepare($conn, 'SELECT pr.id,pr.user_id FROM password_resets pr WHERE pr.token_hash=? AND pr.used_at IS NULL AND pr.expires_at>NOW()');
mysqli_stmt_bind_param($stmt, 's', $tokenHash);
mysqli_stmt_execute($stmt);
$reset = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $reset) {
    verify_csrf();
    $password = $_POST['password'] ?? '';
    if (strlen($password) < 8)
        $error = 'Password must contain at least 8 characters.';
    elseif ($password !== ($_POST['confirm_password'] ?? ''))
        $error = 'Passwords do not match.';
    else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        mysqli_begin_transaction($conn);
        $u = mysqli_prepare($conn, 'UPDATE users SET password=? WHERE id=?');
        mysqli_stmt_bind_param($u, 'si', $hash, $reset['user_id']);
        mysqli_stmt_execute($u);
        $r = mysqli_prepare($conn, 'UPDATE password_resets SET used_at=NOW() WHERE id=?');
        mysqli_stmt_bind_param($r, 'i', $reset['id']);
        mysqli_stmt_execute($r);
        mysqli_commit($conn);
        flash('success', 'Password changed. Please log in.');
        redirect('login.php');
    }
}
$page_title = 'Reset Password';
$page_css = 'reset-password';
require dirname(__DIR__) . '/includes/header.php'; ?>
<main>
    <section class="page-hero">
        <p class="eyebrow">Secure reset</p>
        <h1>Choose a New Password</h1>
    </section>
    <section class="content-section">
        <div class="form-card" style="max-width:600px;margin:auto;text-align:left"><?php if (!$reset): ?>
                <p class="error-list">This reset link is invalid, expired, or has already been used.</p><a
                    href="forgot-password.php">Request a new link</a><?php else: ?>
                <h2>New password</h2><?php if ($error): ?>
                    <p class="error-list"><?= e($error) ?></p><?php endif; ?>
                <form method="post"><?= csrf_field() ?><input type="hidden" name="token"
                        value="<?= e($token) ?>"><label>Password<input type="password" name="password" minlength="8"
                            required></label><label>Confirm password<input type="password" name="confirm_password"
                            minlength="8" required></label><button type="submit">Save New Password</button></form>
            <?php endif; ?>
        </div>
    </section>
</main><?php require dirname(__DIR__) . '/includes/footer.php'; ?>