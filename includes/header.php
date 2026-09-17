<?php
$page_title = $page_title ?? 'Elegant Stiches';
$active = $active ?? '';
$page_css = $page_css ?? 'general';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= e($page_title) ?> | Elegant Stiches</title>
    <meta name="description" content="Bespoke Nigerian tailoring and ready-to-wear fashion.">
    <link rel="stylesheet" href="../assets/css/pages/<?= e($page_css) ?>.css">
    <script defer src="../assets/js/app.js"></script>
</head>

<body>

    <header class="site-header">
        <a class="brand" href="index.php">
            <span class="logo-mark">✂</span><span>Elegant Stiches</span>
        </a>
        <button class="menu-toggle" type="button" aria-label="Open menu" aria-expanded="false">☰</button>
        <nav class="nav-links">
            <a class="<?= $active === 'home' ? 'active' : '' ?>" href="index.php">
                Home
            </a>
            <a class="<?= $active === 'shop' ? 'active' : '' ?>" href="shop.php">
                Products

            </a>
            <a href="booking.php">
                Book Appointment
            </a>
            <a class="<?= $active === 'about' ? 'active' : '' ?>" href="about.php">
                About
            </a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="account.php"><?= e(explode(' ', $_SESSION['full_name'])[0]) ?></a>
                <a class="login-button" href="logout.php">Logout</a>
            <?php else: ?>
                <a class="login-button" href="login.php">Login</a>
            <?php endif; ?>
        </nav>
    </header>
        <?php if (isset($_SESSION['flash'])):
            [$ft, $fm] = $_SESSION['flash'];
            unset($_SESSION['flash']); ?>
        <div class="flash <?= e($ft) ?>"><?= e($fm) ?></div><?php endif; ?>