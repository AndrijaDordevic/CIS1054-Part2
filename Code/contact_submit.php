<?php
// Sanitize input
function sanitize_input($input) {
    // Remove leading and trailing whitespaces
    $input = trim($input);
    // Remove HTML tags
    $input = strip_tags($input);
    // Escape special characters
    $input = htmlspecialchars($input, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    
    return $input;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $name = sanitize_input($_POST['name']);
    $email = sanitize_input($_POST['email']);
    $message = sanitize_input($_POST['message']);

    $dsn = 'mysql:host=localhost;dbname=bakery';
    $username = 'Kim';
    $password = '*81F9E2CEBE63285BC5BF55CC67DDF2C18373E851';

    try {
        $dbh = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        die();
    }

    // Prepare SQL statement with placeholders
    $stmt = $dbh->prepare("INSERT INTO  contact (Name, email, Message) VALUES (:name, :email, :message)");

    // Bind parameters
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':message', $message);

    if ($stmt->execute()) {
        $submission_message = "Thank you for contacting us";
    } else {
        $submission_message = "Error submitting message: " . implode(", ", $stmt->errorInfo());
    }

    $dbh = null;
    header("Location: contact.php?message=" . urlencode($submission_message));
    exit();
} else {
    // If form is not submitted, redirect to home page or handle appropriately
    header("Location: index.php");
    exit();
}
?>
