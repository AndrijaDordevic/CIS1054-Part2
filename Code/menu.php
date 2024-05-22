<?php
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/dbConnection.php';

$db = new dbConnection();

//Get the menu items from the database
$menuitems = $db->select('SELECT ItemID, Price, image, ItemName, ingredients, note FROM menuitems');

//Check if there are any errors
if ($menuitems === false) {
    echo "Error fetching menu items: " . $db->error();
    exit;
}

//Give the data to the html file
echo $twig->render('menu.html', ['menuitems' => $menuitems]);
?>
