<?php 
require dirname(__DIR__) . '/config.php';
require dirname(__DIR__) . '/includes/functions.php';
$errors = [];
$saved = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $service = trim($_POST['service'] ?? '');
    $date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? '';
    $notes = trim($_POST['notes'] ?? '');
    if (strlen($name) < 2 || !filter_var($email, FILTER_VALIDATE_EMAIL) || !$phone || !$service || !$date || !$time)
        $errors[] = 'Please complete all required booking fields.';
    elseif (strtotime($date) < strtotime(date('Y-m-d')))
        $errors[] = 'Choose today or a future date.';
    else {
        $uid = $_SESSION['user_id'] ?? null;
        $stmt = mysqli_prepare($conn, 'INSERT INTO bookings(user_id,full_name,email,phone,service,appointment_date,appointment_time,notes) VALUES(?,?,?,?,?,?,?,?)');
        mysqli_stmt_bind_param($stmt, 'isssssss', $uid, $name, $email, $phone, $service, $date, $time, $notes);
        mysqli_stmt_execute($stmt);
        $saved = true;
    }
}
$page_title = 'Book Appointment';
$page_css = 'booking';
require dirname(__DIR__) . '/includes/header.php'; ?>
<main>
    <section class="page-hero">
        <p class="eyebrow">Booking</p>
        <h1>Book an Appointment</h1>
        <p>Reserve a private fitting or consultation.</p>
    </section>
    <section class="content-section"><?php if ($saved): ?>
            <div class="success-box">
                <h2>Booking request received</h2>
                <p>We will contact you within 24 hours to confirm your appointment.</p>
            </div><?php else: ?>
            <div class="form-grid">
                <form class="form-card" method="post"><?= csrf_field() ?>
                    <h2>Choose Your Service</h2><?php if ($errors): ?>
                        <p class="error-list"><?= e($errors[0]) ?></p><?php endif; ?><label>Full name<input name="name" required
                            value="<?= e($_SESSION['full_name'] ?? '') ?>"></label><label>Email<input type="email" name="email"
                            required></label><label>Phone<input type="tel" name="phone"
                            required></label><label>Service<select name="service" required>
                            <option value="">Select a service</option>
                            <option>Made-to-measure clothing</option>
                            <option>Fitting and alterations</option>
                            <option>Bridal consultation</option>
                            <option>Style consultation</option>
                        </select></label><label>Pick a Date<input type="date" name="date" min="<?= date('Y-m-d') ?>"
                            required></label>
                    <h3>Choose a Time Slot</h3>
                    <div class="time-grid">
                        <?php foreach (['08:00', '09:30', '11:00', '12:30', '14:00', '15:30', '17:00', '18:30'] as $t): ?><label><input
                                    type="radio" name="time" value="<?= $t ?>"
                                    required><span><?= date('h:i A', strtotime($t)) ?></span></label><?php endforeach; ?></div>
                    <label style="margin-top:20px">Special Requests<textarea name="notes"
                            placeholder="Measurements, fabric preferences, occasion notes..."></textarea></label><button
                        type="submit">Confirm Booking</button>
                </form>
                <aside>
                    <div class="info-card">
                        <h2>How bookings work</h2>
                        <p>Your request is saved immediately. We will contact you within 24 hours to confirm availability.
                        </p>
                    </div>
                    <div class="info-card" style="margin-top:18px">
                        <h2>No prepayment required</h2>
                        <p>For this local version, payment arrangements are confirmed after your booking.</p>
                    </div>
                </aside>
            </div><?php endif; ?>
    </section>
</main><?php require dirname(__DIR__) . '/includes/footer.php'; ?>