<?php 
require dirname(__DIR__) . '/config.php';
require dirname(__DIR__) . '/includes/functions.php';
[$items, $total] = cart_details();
$page_title = 'Cart';
$page_css = 'cart';
require dirname(__DIR__) . '/includes/header.php'; ?>
<main>
    <section class="page-hero">
        <p class="eyebrow">Your selection</p>
        <h1>Your Cart (<?= count($items) ?>)</h1>
        <p>Review your pieces before checkout.</p>
    </section>
    <section class="content-section checkout-grid">
        <div><?php if (!$items): ?>
                <div class="empty-state">
                    <h2>Your cart is empty</h2>
                    <p>Explore the collection and add something you love.</p><a class="button primary" href="shop.php">Shop
                        Products</a>
                </div><?php else:
            foreach ($items as $i): ?>
                    <article class="cart-row"><img src="<?= e($i['image']) ?>" alt="<?= e($i['name']) ?>">
                        <div>
                            <h3><?= e($i['name']) ?></h3>
                            <span><?= e($i['category']) ?></span><strong>₦<?= number_format($i['price']) ?></strong>
                            <form action="cart-action.php" method="post" style="margin-top:8px"><?= csrf_field() ?><input
                                    type="hidden" name="slug" value="<?= e($i['slug']) ?>"><button name="action" value="remove"
                                    class="read-more" style="border:0;background:none;padding:0">Remove</button></form>
                        </div>
                        <form action="cart-action.php" method="post" class="qty-control"><?= csrf_field() ?><input type="hidden"
                                name="action" value="update"><input type="hidden" name="slug" value="<?= e($i['slug']) ?>"><button
                                type="button" data-qty="minus">−</button><input name="quantity" type="number"
                                value="<?= $i['qty'] ?>" min="0" max="20"><button type="button" data-qty="plus">+</button></form>
                    </article><?php endforeach; endif; ?>
        </div>
        <aside class="summary-card">
            <h2>Order Summary</h2>
            <div class="summary-line"><span>Subtotal</span><strong>₦<?= number_format($total) ?></strong></div>
            <div class="summary-line"><span>Shipping</span><strong>Calculated later</strong></div>
            <div class="summary-line total"><span>Total</span><strong>₦<?= number_format($total) ?></strong></div>
            <?php if ($items): ?><a class="button primary" style="width:100%" href="checkout.php">Proceed to
                    Checkout</a><?php endif; ?>
        </aside>
    </section>
</main><?php require dirname(__DIR__) . '/includes/footer.php'; ?>