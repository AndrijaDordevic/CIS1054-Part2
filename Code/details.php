<?php
require_once __DIR__ . "/bootstrap.php";

//Get item details from menu
if (isset($_GET['id'], $_GET['name'], $_GET['price'], $_GET['image'], $_GET['ingredients'], $_GET['note'], $_GET['details'])) {
    $itemDetails = [
        'id' => $_GET['id'],
        'name' => $_GET['name'],
        'price' => $_GET['price'],
        'image' => $_GET['image'],
        'ingredients' => $_GET['ingredients'],
        'note' => $_GET['note'],
        'details' => $_GET['details']
    ];


    echo $twig->render('details.html', ['item' => $itemDetails]);
} else {
    echo "Item details not provided.";
}
?>
