<?php 

error_reporting(E_ALL);
ini_set("display_errors", "1");

require dirname(__DIR__) . '/config.php';
require dirname(__DIR__) . '/includes/functions.php';
$page_title = 'Home';
$page_css = 'index';
$active = 'home';
require dirname(__DIR__) . '/includes/header.php'; ?>
<main>
    <section class="hero">
        <div class="hero-copy reveal">
            <p class="eyebrow">Bespoke craftsmanship</p>
            <h1>Tailored to fit your story.</h1>
            <p>Discover made-to-measure Nigerian fashion, polished ready-to-wear pieces, and personal fittings crafted
                around you.</p>
            <div class="hero-actions"><a class="button primary" href="shop.php">Shop Now</a><a class="button secondary"
                    href="booking.php">Book a Tailor</a></div>
        </div>
    </section>
    <section class="trust-strip">
        <div><strong>Verified quality</strong><span>Carefully finished garments</span></div>
        <div><strong>Made for you</strong><span>Personal measurements and fit</span></div>
        <div><strong>Secure checkout</strong><span>Your information is protected</span></div>
        <div><strong>Easy booking</strong><span>Choose a date and time online</span></div>
    </section>
    <section class="content-section reveal">
        <p class="eyebrow">Curated collections</p>
        <h2>Find your perfect piece</h2>
        <div class="card-grid">
            <article class="feature-card"><img
                    src="https://images.unsplash.com/photo-1598808503746-f34c53b9323e?auto=format&fit=crop&w=900&q=85"
                    alt="Traditional menswear">
                <div>
                    <h3>Traditional Elegance</h3>
                    <p>Agbada, Ankara, Senator, Isi Agu and more—made with cultural pride.</p><a class="read-more"
                        href="shop.php?category=Traditional">Explore collection →</a>
                </div>
            </article>
            <article class="feature-card"><img
                    src="https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&w=900&q=85"
                    alt="Modern suit">
                <div>
                    <h3>Modern Classics</h3>
                    <p>Refined suits, blazers, dresses and versatile everyday clothing.</p><a class="read-more"
                        href="shop.php?category=Western">Explore collection →</a>
                </div>
            </article>
            <article class="feature-card"><img
                    src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=900&q=85"
                    alt="Bridal dress">
                <div>
                    <h3>Made for Moments</h3>
                    <p>Bridal, party and occasion wear created for unforgettable days.</p><a class="read-more"
                        href="shop.php?category=Party">Explore collection →</a>
                </div>
            </article>
        </div>
    </section>
    <section class="content-section process-band reveal">
        <div>
            <p class="eyebrow">How it works</p>
            <h2>From idea to final fitting</h2>
            <p>A simple, transparent journey from selecting your style to wearing a perfect fit.</p>
        </div>
        <div class="process-steps">
            <article><b>1</b>
                <div>
                    <h3>Choose your style</h3>
                    <p>Browse the complete collection.</p>
                </div>
            </article>
            <article><b>2</b>
                <div>
                    <h3>Book your fitting</h3>
                    <p>Tell us your preferences and schedule.</p>
                </div>
            </article>
            <article><b>3</b>
                <div>
                    <h3>Wear it proudly</h3>
                    <p>We tailor, refine, and prepare your order.</p>
                </div>
            </article>
        </div>
    </section>
</main>
<?php require dirname(__DIR__) . '/includes/footer.php'; ?>