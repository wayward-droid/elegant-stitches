<?php 
require dirname(__DIR__) . '/config.php';
require dirname(__DIR__) . '/includes/functions.php';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $email = strtolower(trim($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';
    $stmt = mysqli_prepare($conn, 'SELECT id,full_name,password FROM users WHERE email=?');
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $user = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = (int) $user['id'];
        $_SESSION['full_name'] = $user['full_name'];
        flash('success', 'Welcome back, ' . $user['full_name'] . '!');
        redirect('account.php');
    }
    $error = 'The email address or password is incorrect.';
}
$page_title = 'Login';
$page_css = 'login';
require dirname(__DIR__) . '/includes/header.php'; ?>
<main>
    <section class="page-hero">
        <p class="eyebrow">Welcome back</p>
        <h1>Login</h1>
        <p>Access your account, bookings and order history.</p>
    </section>
    <section class="content-section">
        <div class="form-card" style="max-width:560px;margin:auto;text-align:left">
            <h2>Sign into your account</h2><?php if ($error): ?>
                <p class="error-list"><?= e($error) ?></p><?php endif; ?>
            <form method="post"><?= csrf_field() ?><label>Email address<input type="email" name="email" required
                        autocomplete="email"></label><label>Password<input type="password" name="password" required
                        autocomplete="current-password"></label><button type="submit">Login</button></form>
            <p><a class="read-more" href="forgot-password.php">Forgot your password?</a></p>
            <p>New here? <a class="read-more" href="register.php">Create an account</a></p>
        </div>
    </section>
</main><?php require dirname(__DIR__) . '/includes/footer.php'; ?>