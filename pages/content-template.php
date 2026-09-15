<?php
require dirname(__DIR__) . '/config.php';
require dirname(__DIR__) . '/includes/functions.php';
$content_key = $content_key ?? 'about';
$pages = [
    'about' => ['About Us', 'The story behind Elegant Stiches', 'We believe everyone deserves clothes that fit beautifully and tell their story. Our studio connects thoughtful design, skilled hands and personal service.'],
    'faq' => ['Frequently Asked Questions', 'Answers before you order', 'Find quick guidance about measurements, production time, delivery, bookings and custom orders.'],
    'feedback' => ['Customer Feedback', 'Your experience matters', 'Tell us what worked well and where we can improve. Your feedback helps us make every fitting and delivery better.'],
    'help' => ['Help Centre', 'How can we help?', 'Get support with your account, cart, order, appointment or custom garment.'],
    'help-contact' => ['Help Contact', 'Speak with support', 'Send our support team the details of the problem and we will help you find the next step.'],
    'chat-with-customer-support' => ['Customer Support', 'Chat with our team', 'Our support team can assist with sizing, bookings, orders and account questions.'],
    'made-to-order' => ['Made to Order', 'Created around you', 'Choose a style, share your measurements and preferences, then let us create a piece with a personal fit.'],
    'traditional-african-wears' => ['Traditional / African Wears', 'Culture, crafted beautifully', 'Explore Agbada, Ankara, Adire, Aso Oke, Kaftan, Kente, Lace, Senator and other enduring styles.'],
    'english-western-wears' => ['English / Western Wears', 'Modern wardrobe essentials', 'Discover suits, blazers, dresses, shirts, trousers, jeans and versatile casual pieces.'],
    'other-categories' => ['Other Categories', 'Made for every purpose', 'Browse uniforms, sportswear, sleepwear, underwear, party wear and special commissions.'],
    'our-mission' => ['Our Mission', 'Clothing with meaning', 'Our mission is to make excellent tailoring easier to discover, order and enjoy while celebrating skilled Nigerian craftsmanship.'],
    'our-production' => ['Our Production', 'Care in every stitch', 'Each garment moves through consultation, pattern preparation, cutting, construction, fitting and careful quality inspection.'],
    'our-stores' => ['Our Stores', 'Visit the studio', 'Meet with us for measurements, fabric consultation, fitting, collection and aftercare.'],
];
[$page_title, $heading, $copy] = $pages[$content_key] ?? $pages['about'];
$page_css = $page_css ?? $content_key;
$active = $content_key === 'about' ? 'about' : '';
require dirname(__DIR__) . '/includes/header.php';
?>
<main>
    <section class="page-hero">
        <p class="eyebrow"><?= e($page_title) ?></p>
        <h1><?= e($page_title) ?></h1>
        <p><?= e($copy) ?></p>
    </section>
    <section class="content-section story-layout reveal"><img
            src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=1100&q=85"
            alt="Tailoring workspace">
        <div>
            <p class="eyebrow">Elegant Stiches</p>
            <h2><?= e($heading) ?></h2>
            <p><?= e($copy) ?></p>
            <p>We combine personal attention, reliable service and careful workmanship so every customer knows what to
                expect from first conversation to final fitting.</p>
            <div class="inline-actions"><a class="button primary" href="shop.php">Explore Products</a><a
                    class="button secondary" href="contact.php">Contact Us</a></div>
        </div>
    </section>
    <section class="content-section">
        <p class="eyebrow">Our values</p>
        <h2>What we stand for</h2>
        <div class="value-grid">
            <article class="value-card">
                <h3>Craftsmanship</h3>
                <p>Every piece is handled with care and professional finishing.</p>
            </article>
            <article class="value-card">
                <h3>Quality First</h3>
                <p>We pay attention to fabric, structure, seams and fit.</p>
            </article>
            <article class="value-card">
                <h3>Community</h3>
                <p>We celebrate local creativity and the people behind each stitch.</p>
            </article>
            <article class="value-card">
                <h3>Care & Support</h3>
                <p>We stay available from your first question through delivery.</p>
            </article>
        </div>
    </section>
</main>
<?php require dirname(__DIR__) . '/includes/footer.php'; ?>