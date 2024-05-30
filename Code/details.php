<?php
require_once __DIR__ . "/bootstrap.php";
require_once __DIR__ . "/dbConnection.php";

$db = new dbConnection();

//Check if the item ID is provided
if (isset($_GET['id'])) {
    $itemId = intval($_GET['id']);
    
    //Fetch item details from the database
    $query = "SELECT ItemID, ItemName, Price, image, ingredients, note, details FROM menuitems WHERE ItemID = $itemId";
    $result = $db->select($query);
    
    //Check if the query was successful and if the item exists
    if ($result !== false && count($result) > 0) {
        $itemDetails = $result[0];

        //Render the details page with the use of Twig
        echo $twig->render('details.html', ['item' => $itemDetails]);
    } else {
        echo "Item not found.";
    }
} else {
    echo "Item Details not provided.";
}
?>
