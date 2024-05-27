<?php
require 'vendor/autoload.php';  // Make sure this path is correct
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/dbConnection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Sanitize input
function sanitize_input($input) {
    $input = trim($input);
    $input = strip_tags($input);
    $input = htmlspecialchars($input, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    return $input;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitize_input($_POST['email']);

    // Get current favorites from cookies
    $favourites = isset($_COOKIE['favourites']) ? json_decode($_COOKIE['favourites'], true) : [];

    if (!empty($favourites)) {
        $dsn = 'mysql:host=localhost;dbname=bakery';
        $username = 'Kim';
        $password = '*81F9E2CEBE63285BC5BF55CC67DDF2C18373E851';

        try {
            $dbh = new PDO($dsn, $username, $password);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            die();
        }

        // Prepare and execute the SQL query to fetch favorite items
        $placeholders = implode(',', array_fill(0, count($favourites), '?'));
        $sql = "SELECT ItemID, Price, image, ItemName, ingredients, note FROM menuitems WHERE ItemID IN ($placeholders)";
        $stmt = $dbh->prepare($sql);
        $stmt->execute($favourites);

        $items = '';
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $items .= "<h3>" . htmlspecialchars($row['ItemName']) . "</h3>";
            $items .= "<p>Price: $" . htmlspecialchars($row['Price']) . "</p>";
            $items .= "<p>Ingredients: " . htmlspecialchars($row['ingredients']) . "</p>";
            if (!empty($row['note'])) {
                $items .= "<p>Note: " . htmlspecialchars($row['note']) . "</p>";
            }
            $items .= "<hr>";
        }

        // Send email
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = ''; // Set your SMTP server here
            $mail->SMTPAuth = true;
            $mail->Username = 'your-email@example.com'; // SMTP username
            $mail->Password = 'your-email-password'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('your-email@example.com', 'Baked Gold');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Your Favourite Items from Baked Gold';
            $mail->Body = $items;

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        $dbh = null;
    } else {
        echo "No favourite items found.";
    }
}
?>
