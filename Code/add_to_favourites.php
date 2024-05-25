<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_id = $_POST['item_id'];

    // Get current favorites from cookies
    $favourites = isset($_COOKIE['favourites']) ? json_decode($_COOKIE['favourites'], true) : [];

    // Add the new item if it's not already in the favorites
    if (!in_array($item_id, $favourites)) {
        $favourites[] = $item_id;
        setcookie('favourites', json_encode($favourites), time() + (86400 * 30), "/"); // 30 days
    }

    header('Location: menu.php');
    exit();
}
?>
