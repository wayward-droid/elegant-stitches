<?php require dirname(__DIR__) . '/config.php';
require dirname(__DIR__) . '/includes/functions.php';
$page_title = 'Shop';
$page_css = 'shop';
$active = 'shop';
$catalog = product_catalog();
require dirname(__DIR__) . '/includes/header.php'; ?>
<main>
    <section class="page-hero">
        <p class="eyebrow">Products</p>
        <h1>Shop the Collection</h1>
        <p>Discover handcrafted and ready-to-wear pieces, priced in Nigerian naira.</p>
    </section>
    <section class="content-section shop-layout">
        <aside class="filters">
            <h2>Filters</h2>
            <div class="filter-buttons">
                <?php foreach (['All', 'Traditional', 'Western', 'Casual', 'Party', 'Bridal', 'Uniform', 'Sports', 'Essentials'] as $c): ?><button
                        data-filter="<?= e($c) ?>" class="<?= $c === 'All' ? 'active' : '' ?>"><?= e($c) ?></button><?php endforeach; ?>
            </div>
        </aside>
        <div>
            <div class="toolbar"><span><?= count($catalog) ?> products</span><input id="product-search" type="search"
                    placeholder="Search styles..."></div>
            <div class="product-grid"><?php foreach ($catalog as $slug => $p):
                [$name, $price, $category, $image] = $p; ?>
                    <article class="product-card" data-category="<?= e($category) ?>"><a
                            href="product.php?slug=<?= e($slug) ?>"><img loading="lazy" src="<?= e($image) ?>"
                                alt="<?= e($name) ?>"></a>
                        <div class="product-card-body"><span class="meta"><?= e($category) ?> · Bespoke</span>
                            <h3><a href="product.php?slug=<?= e($slug) ?>"><?= e($name) ?></a></h3>
                            <p>Expertly tailored with careful finishing and a comfortable fit.</p>
                            <div class="product-price"><span>₦<?= number_format($price) ?></span>
                                <form action="cart-action.php" method="post"><?= csrf_field() ?><input type="hidden"
                                        name="action" value="add"><input type="hidden" name="slug"
                                        value="<?= e($slug) ?>"><button class="round-add"
                                        aria-label="Add <?= e($name) ?> to cart">+</button></form>
                            </div>
                        </div>
                    </article><?php endforeach; ?>
            </div>
        </div>
    </section>
</main><?php require dirname(__DIR__) . '/includes/footer.php'; ?>