<?php
global $mysqli;
include "Connection.php"; ?>

<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style/index.css">
    <title>Item Report</title>
</head>
<body>
<div class="container border">
    <?php include "sidebar.php"; ?>
    <div class="item-report">
        <h2 class="text-center display-6 heading">Item Report</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input class="btn btn-primary mb-4" type="submit" value="Generate Report">
            <?php
            // Check if the form is submitted
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                // SQL query to retrieve the item details for the report
                $sql = "SELECT item_name, item_category, item_subcategory, SUM(quantity) AS total_quantity
            FROM item
            GROUP BY item_name, item_category, item_subcategory";

                $result = $mysqli->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table class='table table-dark' >";
                    echo "<tr><th scope='col'>Item Name</th><th scope='col'>Item Category</th><th scope='col'>Item Subcategory</th><th scope='col'>Item Quantity</th></tr>";

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
        </form>
    </div>
</div>
</body>
</html>

<?php
global $mysqli;
include "Connection.php"; ?>
