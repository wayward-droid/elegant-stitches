<?php
declare(strict_types=1);
session_start();

$host = 'localhost';
$user = 'root';
$pass = '';
$database = 'elegant_stitches';

// WhatsApp number that receives new orders (country code, no + or spaces).
const WHATSAPP_NUMBER = '2349077509019';

$conn = mysqli_connect($host, $user, $pass, $database);
if (!$conn) {
    http_response_code(500);
    exit('Database connection failed. Import database/schema.sql in phpMyAdmin, then check config.php.');
}
mysqli_set_charset($conn, 'utf8mb4');

if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}
