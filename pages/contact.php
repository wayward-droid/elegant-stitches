<?php 
require dirname(__DIR__) . '/config.php';
require dirname(__DIR__) . '/includes/functions.php';
$sent = false;
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    if (strlen($name) < 2 || !filter_var($email, FILTER_VALIDATE_EMAIL) || !$subject || strlen($message) < 10)
        $error = 'Please complete every field. Your message should contain at least 10 characters.';
    else {
        $stmt = mysqli_prepare($conn, 'INSERT INTO messages(full_name,email,subject,message) VALUES(?,?,?,?)');
        mysqli_stmt_bind_param($stmt, 'ssss', $name, $email, $subject, $message);
        mysqli_stmt_execute($stmt);
        $sent = true;
    }
}
$page_title = 'Contact';
$page_css = 'contact';
require dirname(__DIR__) . '/includes/header.php'; ?>
<main>
    <section class="page-hero">
        <p class="eyebrow">Get in touch</p>
        <h1>Contact Us</h1>
        <p>Questions about an order, fitting or custom design? We would love to help.</p>
    </section>
    <section class="content-section form-grid">
        <div class="info-card">
            <h2>Visit or call</h2>
            <p><strong>Studio:</strong><br>Nigeria</p>
            <p><strong>Phone:</strong><br>+234 800 000 0000</p>
            <p><strong>Email:</strong><br>hello@elegantstitches.test</p>
            <p><strong>Hours:</strong><br>Monday–Saturday, 9am–6pm</p>
        </div>
        <div class="form-card"><?php if ($sent): ?>
                <div class="success-box">Thank you. Your message has been saved.</div><?php else: ?>
                <h2>Send a Message</h2><?php if ($error): ?>
                    <p class="error-list"><?= e($error) ?></p><?php endif; ?>
                <form method="post"><?= csrf_field() ?><label>Name<input name="name" required></label><label>Email<input
                            type="email" name="email" required></label><label>Subject<input name="subject"
                            required></label><label>Message<textarea name="message" required></textarea></label><button
                        type="submit">Send Message</button></form><?php endif; ?>
        </div>
    </section>
</main><?php require dirname(__DIR__) . '/includes/footer.php'; ?>