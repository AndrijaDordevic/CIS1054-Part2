<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ItemID = $_POST['ItemID'];

    // Get current favorites from cookies
    $favourites = isset($_COOKIE['favourites']) ? json_decode($_COOKIE['favourites'], true) : [];

    // Remove the item if it's in the favorites
    if (($key = array_search($ItemID, $favourites)) !== false) {
        unset($favourites[$key]);
        // Reindex array to prevent gaps in indices
        $favourites = array_values($favourites);
        setcookie('favourites', json_encode($favourites), time() + (86400 * 30), "/"); // 30 days
    }

    header('Location: favourites.php');
    exit();
}
?>
