<?php
    require_once __DIR__ . "/bootstrap.php";
    echo $twig->render('details.html');

//Get item details
if (isset($_GET['id'], $_GET['name'], $_GET['price'], $_GET['image'], $_GET['ingredients'], $_GET['note'], $_GET['details'])) {
    $itemId = $_GET['id'];
    $itemName = $_GET['name'];
    $itemPrice = $_GET['price'];
    $itemImage = $_GET['image'];
    $itemIngredients = $_GET['ingredients'];
    $itemNote = $_GET['note'];
    $itemDetails = $_GET['details'];

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/styles.css">
        <title><?php echo 'Baked Gold - ' . $itemName; ?></title>
    </head>
    <body>
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3><?php echo $itemName; ?></h3>
                </div>
                <div class="card-body">
                    <img src="<?php echo $itemImage; ?>" class="img" alt="<?php echo $itemName; ?>" style="width: 200px; height: auto;">
                    <p id="black-text">Ingredients: <?php echo $itemIngredients; ?></p>
                    <p id="black-text">Price: $<?php echo $itemPrice; ?></p>
                    <?php if (!empty($itemNote)): ?>
                        <p id="black-text">Note: <?php echo $itemNote; ?></p>
                    <?php endif; ?>
                    <?php if (!empty($itemDetails)): ?>
                        <p id="black-text">Details: <?php echo $itemDetails; ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </body>
    </html>
    <?php
} else {
    echo "Item details not provided.";
}

?>

