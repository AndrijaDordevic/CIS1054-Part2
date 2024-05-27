<?php
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/dbConnection.php';

// Create a new instance of the dbConnection class
$db = new dbConnection();

// Initialize $favourites array
$favourites = array();

// Check if the 'favourites' cookie is set
if (isset($_COOKIE['favourites'])) {
    $favouriteItemIds = json_decode($_COOKIE['favourites'], true);
    if (!empty($favouriteItemIds)) {
        // Prepare and execute the SQL query to fetch favorite items
        $placeholders = implode(',', array_fill(0, count($favouriteItemIds), '?'));
        $types = str_repeat('i', count($favouriteItemIds));
        $conn = $db->Connect();
        $stmt = $conn->prepare("SELECT ItemID, Price, image, ItemName, ingredients, note, details FROM menuitems WHERE ItemID IN ($placeholders)");

        // Bind parameters dynamically
        $stmt->bind_param($types, ...$favouriteItemIds);
        $stmt->execute();
        $result = $stmt->get_result();

        // Fetch and store favorite items
        while ($row = $result->fetch_assoc()) {
            $favourites[] = $row;
        }

        // Close the statement
        $stmt->close();
    } 
} else {
    echo "No favorite items found.";
}

// Render the favourites page using Twig
echo $twig->render('favourites.html', ['favourites' => $favourites]);
?>
