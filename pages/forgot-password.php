<?php 
require dirname(__DIR__) . '/config.php';
require dirname(__DIR__) . '/includes/functions.php';
$resetLink = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $email = strtolower(trim($_POST['email'] ?? ''));
    $stmt = mysqli_prepare($conn, 'SELECT id FROM users WHERE email=?');
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    if ($row) {
        $token = bin2hex(random_bytes(32));
        $hash = hash('sha256', $token);
        $expires = date('Y-m-d H:i:s', time() + 1800);
        $uid = (int) $row['id'];
        $stmt = mysqli_prepare($conn, 'INSERT INTO password_resets(user_id,token_hash,expires_at) VALUES(?,?,?)');
        mysqli_stmt_bind_param($stmt, 'iss', $uid, $hash, $expires);
        mysqli_stmt_execute($stmt);
        $resetLink = 'reset-password.php?token=' . $token;
    }
}
$page_title = 'Forgot Password';
$page_css = 'forgot-password';
require dirname(__DIR__) . '/includes/header.php'; ?>
<main>
    <section class="page-hero">
        <p class="eyebrow">Account recovery</p>
        <h1>Forgot Password</h1>
        <p>Enter the email connected to your account.</p>
    </section>
    <section class="content-section">
        <div class="form-card" style="max-width:600px;margin:auto;text-align:left">
            <h2>Request a reset link</h2>
            <form method="post"><?= csrf_field() ?><label>Email address<input type="email" name="email"
                        required></label><button type="submit">Generate Reset Link</button></form>
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                <div class="success-box"><strong>Request received.</strong>
                    <p>For this local XAMPP version, the secure link appears here only when the email exists.</p>
                    <?php if ($resetLink): ?><a class="button primary" href="<?= e($resetLink) ?>">Reset
                            Password</a><?php endif; ?>
                </div><?php endif; ?>
        </div>
    </section>
</main><?php require dirname(__DIR__) . '/includes/footer.php'; ?>