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

    // Now you can use $name, $email, $message safely in your application

    // Example of using sanitized input in a SQL query (assuming you're using PDO)
    $dsn = 'mysql:host=localhost;dbname=bakery';
    $username = 'Kim';
    $password = '2po';

    try {
        $dbh = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        die();
    }

    // Prepare SQL statement with placeholders
    $stmt = $dbh->prepare("INSERT INTO your_table_name (name, email, message) VALUES (:name, :email, :message)");

    // Bind parameters
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':message', $message);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Message submitted successfully!";
    } else {
        echo "Error submitting message.";
    }

    // Close connection
    $dbh = null;
} else {
    // If form is not submitted, redirect to home page or handle appropriately
    header("Location: index.php");
    exit();
}
?>
