<?php 
require dirname(__DIR__) . '/config.php';
require dirname(__DIR__) . '/includes/functions.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST')
    redirect('shop.php');
verify_csrf();
$slug = $_POST['slug'] ?? '';
$catalog = product_catalog();
if (!isset($catalog[$slug]))
    redirect('shop.php');
$action = $_POST['action'] ?? 'add';
$_SESSION['cart'] = $_SESSION['cart'] ?? [];
if ($action === 'remove')
    unset($_SESSION['cart'][$slug]);
elseif ($action === 'update') {
    $qty = max(0, min(20, (int) ($_POST['quantity'] ?? 1)));
    if ($qty === 0)
        unset($_SESSION['cart'][$slug]);
    else
        $_SESSION['cart'][$slug] = $qty;
} else
    $_SESSION['cart'][$slug] = min(20, ($_SESSION['cart'][$slug] ?? 0) + 1);
flash('success', 'Your cart has been updated.');
redirect($_SERVER['HTTP_REFERER'] ?? 'cart.php');
