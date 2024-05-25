<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ItemID = $_POST['ItemID'];

    // Get current favorites from cookies
    $favourites = isset($_COOKIE['favourites']) ? json_decode($_COOKIE['favourites'], true) : [];

    // Add the new item if it's not already in the favorites
    if (!in_array($ItemID, $favourites)) {
        $favourites[] = $ItemID;
        setcookie('favourites', json_encode($favourites), time() + (86400 * 30), "/"); // 30 days
    }

    header('Location: menu.php');
    exit();
}
?>
