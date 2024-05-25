<?php
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/dbConnection.php';

// Create a new instance of the dbConnection class
$db = new dbConnection();

// Get the menu items from the database
$menuitems = $db->select('SELECT ItemID, Price, image, ItemName, ingredients, note FROM menuitems');

// Check if there are any errors
if ($menuitems === false) {
    echo "Error fetching menu items: " . $db->error();
    exit;
}

// Initialize $favourites array
$favourites = array();

// Check if the 'favourites' cookie is set
if(isset($_COOKIE['favourites'])) {
    $favourites = json_decode($_COOKIE['favourites'], true);
    if(!empty($favourites)) {
        // Prepare and execute the SQL query to fetch favorite items
        $placeholders = implode(',', array_fill(0, count($favourites), '?'));
        $types = str_repeat('i', count($favourites));
        $stmt = $db->Connect()->prepare("SELECT ItemID, Price, image, ItemName, ingredients, note FROM menuitems WHERE ItemID IN ($placeholders)");
        $stmt->bind_param($types, ...$favourites);
        $stmt->execute();
        $result = $stmt->get_result();

        // Fetch and display favorite items
        while($row = $result->fetch_assoc()) {
            echo "<div class='menu-item'>
                    <h3>" . htmlspecialchars($row['ItemName']) . "</h3>
                  </div>";
        }

        // Close the statement and connection
        $stmt->close();
    } else {
        echo "No favorite items found.";
    }
} else {
    echo "No favorite items found.";
}

// Render the favourites page using Twig
echo $twig->render('favourites.html', ['favourites' => $favourites]);
?>
