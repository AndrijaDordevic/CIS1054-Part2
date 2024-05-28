<?php
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/dbConnection.php';

$db = new dbConnection();

// Get the menu items from the database
$menuitems = $db->select('SELECT ItemID, CategoryID, Price, image, ItemName, ingredients, note, details FROM menuitems');

// Get the categories from the database
$categories = $db->select('SELECT CategoryID, CategoryName FROM menucategories');

// Check if there are any errors
if ($menuitems === false || $categories === false) {
    echo "Error fetching data: " . $db->error();
    exit;
}

$categoriesMap = [];
foreach ($categories as $category) {
    $categoriesMap[$category['CategoryID']] = $category['CategoryName'];
}

// Group menu items by category
$menuItemsByCategory = [];
foreach ($menuitems as $item) {
    $categoryId = $item['CategoryID'];
    if (!isset($menuItemsByCategory[$categoryId])) {
        $menuItemsByCategory[$categoryId] = [];
    }
    $menuItemsByCategory[$categoryId][] = $item;
}

// Give the data to the HTML file
echo $twig->render('menu.html', ['menuItemsByCategory' => $menuItemsByCategory, 'categoriesMap' => $categoriesMap]);
?>
