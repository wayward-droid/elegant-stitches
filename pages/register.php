<?php 
require dirname(__DIR__) . '/config.php';
require dirname(__DIR__) . '/includes/functions.php';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $name = trim($_POST['full_name'] ?? '');
    $email = strtolower(trim($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';
    if (strlen($name) < 2)
        $errors[] = 'Enter your full name.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        $errors[] = 'Enter a valid email address.';
    if (strlen($password) < 8)
        $errors[] = 'Password must contain at least 8 characters.';
    if ($password !== $confirm)
        $errors[] = 'Passwords do not match.';
    if (!$errors) {
        $check = mysqli_prepare($conn, 'SELECT id FROM users WHERE email=?');
        mysqli_stmt_bind_param($check, 's', $email);
        mysqli_stmt_execute($check);
        if (mysqli_stmt_get_result($check)->num_rows)
            $errors[] = 'An account already uses this email.';
        else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = mysqli_prepare($conn, 'INSERT INTO users(full_name,email,password) VALUES(?,?,?)');
            mysqli_stmt_bind_param($stmt, 'sss', $name, $email, $hash);
            mysqli_stmt_execute($stmt);
            flash('success', 'Account created. You can now log in.');
            redirect('login.php');
        }
    }
}
$page_title = 'Create Account';
$page_css = 'register';
require dirname(__DIR__) . '/includes/header.php'; ?>
<main>
    <section class="page-hero">
        <p class="eyebrow">Join us</p>
        <h1>Create Account</h1>
        <p>Save your details and enjoy faster bookings and checkout.</p>
    </section>
    <section class="content-section">
        <div class="form-card" style="max-width:600px;margin:auto;text-align:left">
            <h2>Your details</h2><?php if ($errors): ?>
                <ul class="error-list"><?php foreach ($errors as $x): ?>
                        <li><?= e($x) ?></li><?php endforeach; ?>
                </ul><?php endif; ?>
            <form method="post"><?= csrf_field() ?><label>Full name<input name="full_name"
                        value="<?= e($_POST['full_name'] ?? '') ?>" required autocomplete="name"></label><label>Email
                    address<input type="email" name="email" value="<?= e($_POST['email'] ?? '') ?>" required
                        autocomplete="email"></label><label>Password<input type="password" name="password" minlength="8"
                        required autocomplete="new-password"></label><label>Confirm password<input type="password"
                        name="confirm_password" minlength="8" required autocomplete="new-password"></label><button
                    type="submit">Create Account</button></form>
            <p>Already registered? <a class="read-more" href="login.php">Log in</a></p>
        </div>
    </section>
</main><?php require dirname(__DIR__) . '/includes/footer.php'; ?>