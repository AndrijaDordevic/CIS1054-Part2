<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'Kim');
define('DB_PASSWORD', '2po');
define('DB_DATABASE', 'bakery');

// Connect to MySQL database
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query menu items
$sql = "SELECT CategoryName, ItemName, Price FROM MenuCategories 
        INNER JOIN MenuItems ON MenuCategories.CategoryID = MenuItems.CategoryID";
$result = mysqli_query($conn, $sql);

// Display menu items
if (mysqli_num_rows($result) > 0) {
    $current_category = "";
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row["CategoryName"] != $current_category) {
            echo "<div class='menu-category'>";
            echo "<h3>" . $row["CategoryName"] . "</h3>";
            echo "<ul>";
            $current_category = $row["CategoryName"];
        }
        echo "<li>" . $row["ItemName"] . " - $" . $row["Price"] . "</li>";
    }
    echo "</ul>";
    echo "</div>";
} else {
    echo "0 results";
}

// Close connection
mysqli_close($conn);
?>
