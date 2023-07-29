<?php
global $mysqli;
include "Connection.php"; ?>


<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // SQL query to retrieve the item details for the report
    $sql = "SELECT item_name, item_category, item_subcategory, SUM(quantity) AS total_quantity
            FROM item
            GROUP BY item_name, item_category, item_subcategory";

    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Item Name</th><th>Item Category</th><th>Item Subcategory</th><th>Item Quantity</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["item_name"] . "</td>";
            echo "<td>" . $row["item_category"] . "</td>";
            echo "<td>" . $row["item_subcategory"] . "</td>";
            echo "<td>" . $row["total_quantity"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No items found in the database.";
    }

    $mysqli->close();
}
?>
<!DOCTYPE html>
<html lang="eng">
<head>
    <link rel="stylesheet" type="text/css" href="../style/index.css">
    <title>Item Report</title>
</head>
<body>
<?php include "index.php"; ?>
<div class="item-report">
    <h2>Item Report</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="submit" value="Generate Report">
    </form>
</div>
</body>
</html>
