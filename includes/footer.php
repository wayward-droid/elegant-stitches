<footer class="site-footer">
    <div class="footer-grid">
        <div>
            <a class="brand" href="index.php">
                <span class="logo-mark">✂</span>
                <span>Elegant Stiches</span>
            </a>
            <p>
                Connecting you with beautifully made clothing that fits you perfectly—and your story.
            </p>
            <div class="socials">
                <span>◎</span>
                <span>f</span>
                <span>𝕏</span>
                <span>p</span>
            </div>
        </div>
        <div>
            <h3>Shop</h3>
            <a href="shop.php">All Products</a>
            <a href="booking.php">Book Appointment</a>
            <a href="cart.php">Your Cart</a>
        </div>
        <div>
            <h3>Company</h3>
            <a href="about.php">About Us</a>
            <a href="our-mission.php">Our Mission</a>
            <a href="contact.php">Contact Us</a>
        </div>
        <div>
            <h3>Support</h3>
            <a href="faq.php">FAQ</a>
            <a href="help.php">Help Centre</a>
            <a href="account.php">My Account</a>
        </div>
        <div>
            <h3>Stay in the Loop</h3>
            <p>Style tips and fresh drops, straight to your inbox.</p>
            <form class="subscribe-form">
                <input type="email" aria-label="Email address" placeholder="Email address" required>
                <button aria-label="Subscribe">➤</button>
            </form>
        </div>
    </div>
    <div class="footer-bottom">
        <span>© <?=date('Y')?> Elegant Stiches. All rights reserved.</span>
        <span>Privacy &nbsp; Terms &nbsp; Refunds</span>
    </div>
</footer>
<a href="cart.php" id="floating-cart" aria-label="View cart">
    🛒
    <span id="floating-cart-count" class="cart-count"><?= array_sum($_SESSION['cart'] ?? []) ?></span>
</a>

</body>
</html>
