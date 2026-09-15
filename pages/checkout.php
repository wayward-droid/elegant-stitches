<?php
require dirname(__DIR__) . '/config.php';
require dirname(__DIR__) . '/includes/functions.php';
[$items, $total] = cart_details();
if (!$items) {
    flash('error', 'Your cart is empty.');
    redirect('shop.php');
}
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $payment = $_POST['payment'] ?? 'bank_transfer';
    if (strlen($name) < 2 || !filter_var($email, FILTER_VALIDATE_EMAIL) || !$phone || !$address || !$city) {
        $errors[] = 'Complete all shipping fields with valid information.';
    }
    if (!$errors) {
        $userId = $_SESSION['user_id'] ?? null;
        mysqli_begin_transaction($conn);
        try {
            $stmt = mysqli_prepare($conn, 'INSERT INTO orders(user_id,customer_name,email,phone,address,city,total,payment_method) VALUES(?,?,?,?,?,?,?,?)');
            mysqli_stmt_bind_param($stmt, 'isssssds', $userId, $name, $email, $phone, $address, $city, $total, $payment);
            mysqli_stmt_execute($stmt);
            $orderId = mysqli_insert_id($conn);
            $itemStmt = mysqli_prepare($conn, 'INSERT INTO order_items(order_id,product_slug,product_name,price,quantity) VALUES(?,?,?,?,?)');
            foreach ($items as $item) {
                mysqli_stmt_bind_param($itemStmt, 'issdi', $orderId, $item['slug'], $item['name'], $item['price'], $item['qty']);
                mysqli_stmt_execute($itemStmt);
            }
            mysqli_commit($conn);
            $paymentLabel = $payment === 'pay_on_delivery' ? 'Pay at fitting' : 'Bank transfer';
            $lines = ['Hello Elegant Stiches, I have completed checkout and would like to make payment.', '', '*ORDER SUMMARY*', 'Order number: #' . $orderId];
            foreach ($items as $item) {
                $lines[] = '• ' . $item['name'] . ' × ' . $item['qty'] . ' — ₦' . number_format($item['price'] * $item['qty']);
            }
            $lines = array_merge($lines, ['', '*TOTAL: ₦' . number_format($total) . '*', 'Payment method: ' . $paymentLabel, '', '*CUSTOMER DETAILS*', 'Name: ' . $name, 'Email: ' . $email, 'Phone: ' . $phone, 'Delivery address: ' . $address . ', ' . $city, '', 'Please send me the payment details for this order.']);
            $_SESSION['cart'] = [];
            header('Location: https://wa.me/' . WHATSAPP_NUMBER . '?text=' . rawurlencode(implode("\n", $lines)));
            exit;
        } catch (Throwable $error) {
            mysqli_rollback($conn);
            $errors[] = 'We could not save your order. Please try again.';
        }
    }
}
$page_title = 'Checkout';
$page_css = 'checkout';
require dirname(__DIR__) . '/includes/header.php';
?>
<main>
    <section class="page-hero">
        <p class="eyebrow">Checkout</p>
        <h1>Complete Your Order</h1>
        <p>After placing your order, WhatsApp will open with your order summary ready to send for payment.</p>
    </section>
    <section class="content-section">
        <div class="checkout-grid">
            <form class="form-card" method="post"><?= csrf_field() ?>
                <h2>Shipping Details</h2>
                <?php if ($errors): ?>
                    <p class="error-list"><?= e($errors[0]) ?></p><?php endif; ?>
                <label>Full name<input name="name" required
                        value="<?= e($_POST['name'] ?? ($_SESSION['full_name'] ?? '')) ?>"></label>
                <label>Email address<input type="email" name="email" required
                        value="<?= e($_POST['email'] ?? '') ?>"></label>
                <label>Phone<input type="tel" name="phone" required value="<?= e($_POST['phone'] ?? '') ?>"></label>
                <label>Street address<input name="address" required value="<?= e($_POST['address'] ?? '') ?>"></label>
                <label>City<input name="city" required value="<?= e($_POST['city'] ?? '') ?>"></label>
                <h2>Payment Method</h2><label><select name="payment">
                        <option value="bank_transfer">Bank Transfer</option>
                        <option value="pay_on_delivery">Pay at Fitting</option>
                    </select></label>
                <button type="submit">Continue to WhatsApp · ₦<?= number_format($total) ?></button>
            </form>
            <aside class="summary-card">
                <h2>Order Summary</h2><?php foreach ($items as $item): ?>
                    <div class="summary-line"><span><?= e($item['name']) ?> ×
                            <?= $item['qty'] ?></span><strong>₦<?= number_format($item['price'] * $item['qty']) ?></strong>
                    </div><?php endforeach; ?>
                <div class="summary-line total"><span>Total</span><strong>₦<?= number_format($total) ?></strong></div>
                <small>WhatsApp opens only after your order has been saved successfully.</small>
            </aside>
        </div>
    </section>
</main>
<?php require dirname(__DIR__) . '/includes/footer.php'; ?>