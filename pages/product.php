<?php 
require dirname(__DIR__) . '/config.php';
require dirname(__DIR__) . '/includes/functions.php';
$catalog = product_catalog();
$slug = $slug ?? ($_GET['slug'] ?? '');
$page_css = $page_css ?? 'product';
if (!isset($catalog[$slug])) {
    http_response_code(404);
    $page_title = 'Not found';
    require dirname(__DIR__) . '/includes/header.php';
    echo '<main class="content-section"><h1>Product not found</h1><a href="shop.php">Return to shop</a></main>';
    require dirname(__DIR__) . '/includes/footer.php';
    exit;
}
[$name, $price, $category, $image] = $catalog[$slug];
$page_title = $name;
$active = 'shop';
require dirname(__DIR__) . '/includes/header.php'; ?>
<main>
    <section class="content-section product-detail">
        <div><img class="product-image" src="<?= e($image) ?>" alt="<?= e($name) ?>"></div>
        <div>
            <p class="eyebrow"><?= e($category) ?> · Classic</p>
            <h1><?= e($name) ?></h1>
            <p>★★★★★ &nbsp; 4.8 · Carefully verified quality</p>
            <div class="price-large">₦<?= number_format($price) ?></div>
            <p>A carefully crafted piece made with premium materials and meticulous attention to detail. Designed for
                comfort, confidence and a polished finish.</p>
            <div class="product-facts">
                <div><small>DELIVERY</small><strong>7–14 days</strong></div>
                <div><small>SHIPPING</small><strong>Calculated at checkout</strong></div>
                <div><small>AVAILABILITY</small><strong>Made to order</strong></div>
                <div><small>CRAFTED IN</small><strong>Nigeria</strong></div>
            </div>
            <form action="cart-action.php" method="post"><?= csrf_field() ?><input type="hidden" name="action"
                    value="add"><input type="hidden" name="slug" value="<?= e($slug) ?>"><button type="submit">Add to Cart
                    · ₦<?= number_format($price) ?></button></form>
            <h2>Description</h2>
            <p>Premium fabric, precision stitching, hand-finished details and quality assurance are included with every
                order.</p>
        </div>
    </section>
</main><?php require dirname(__DIR__) . '/includes/footer.php'; ?>