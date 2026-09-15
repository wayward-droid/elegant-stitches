<?php 
require dirname(__DIR__) . '/config.php';
require dirname(__DIR__) . '/includes/functions.php';
if (!isset($_SESSION['user_id'])) {
    flash('error', 'Please log in to view your account.');
    redirect('login.php');
}
$uid = (int) $_SESSION['user_id'];
$b = mysqli_prepare($conn, 'SELECT service,appointment_date,appointment_time,status FROM bookings WHERE user_id=? ORDER BY created_at DESC LIMIT 10');
mysqli_stmt_bind_param($b, 'i', $uid);
mysqli_stmt_execute($b);
$bookings = mysqli_stmt_get_result($b);
$o = mysqli_prepare($conn, 'SELECT id,total,status,created_at FROM orders WHERE user_id=? ORDER BY created_at DESC LIMIT 10');
mysqli_stmt_bind_param($o, 'i', $uid);
mysqli_stmt_execute($o);
$orders = mysqli_stmt_get_result($o);
$page_title = 'My Account';
$page_css = 'account';
require dirname(__DIR__) . '/includes/header.php'; ?>
<main>
    <section class="page-hero">
        <p class="eyebrow">My account</p>
        <h1>Hello, <?= e($_SESSION['full_name']) ?></h1>
        <p>See your recent orders and appointments.</p>
    </section>
    <section class="content-section account-grid">
        <div class="form-card">
            <h2>Bookings</h2><?php if (!$bookings->num_rows): ?>
                <p>No bookings yet.</p><?php endif;
            while ($x = $bookings->fetch_assoc()): ?>
                <div class="summary-line">
                    <span><?= e($x['service']) ?><br><small><?= e($x['appointment_date'] . ' ' . $x['appointment_time']) ?></small></span><strong><?= e(ucfirst($x['status'])) ?></strong>
                </div><?php endwhile; ?><a class="button primary" href="booking.php">New Booking</a>
        </div>
        <div class="summary-card">
            <h2>Orders</h2><?php if (!$orders->num_rows): ?>
                <p>No orders yet.</p><?php endif;
            while ($x = $orders->fetch_assoc()): ?>
                <div class="summary-line"><span>Order
                        #<?= $x['id'] ?><br><small><?= e($x['created_at']) ?></small></span><strong>₦<?= number_format((float) $x['total']) ?><br><?= e($x['status']) ?></strong>
                </div><?php endwhile; ?>
        </div>
    </section>
</main><?php require dirname(__DIR__) . '/includes/footer.php'; ?>